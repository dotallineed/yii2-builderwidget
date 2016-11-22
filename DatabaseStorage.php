<?php
/**
 * @link https://www.github.com/dotallineed/yii2-builderwidget
 * @copyright Copyright (c) 2016 dotallineed.com
 * @license http://www.yiiframework.com/license/
 */

namespace dotallineed\widget;

use Yii;
use yii\di\Instance;
use yii\db\Query;

/**
 * DatabaseStorage is extended from Storage Class
 *
 * It's specialty for handling read and write widget data into database
 *
 * Usage:
 * Configuration in block component look like this
 *        'widget' => [
 *            'class' => 'dotallineed\widget\BuilderWidget',
 *            'storage' => [
 *                'class' => 'dotallineed\widget\DatabaseStorage',
 *                'table'    => 'widget',
 *            ]
 *        ],
 *
 * @author Kinggeorge Magaga <magagageorge@dotallineed.com>
 * @since 1.0
 *
 */
class DatabaseStorage extends Storage
{
	public $db = 'db';

	public $table = 'builder_widgets';

	/**
	 *
	 */
	public function init()
	{
		parent::init();
		$this->db = Instance::ensure($this->db, 'yii\db\Connection');
	}

	public function read(BuilderWidget $widget)
	{
		if ($data = $this->select($widget)) {
			$this->unserialize($data['content'], $widget);
		}
	}

	public function write(BuilderWidget $widget)
	{
		if ($this->select($widget)) {
			$this->update($widget);
		} else {
			$this->insert($widget);
		}
	}

	public function lock($drop, BuilderWidget $widget)
	{
		if ($data = $this->select($widget)) {
			if ($drop) {
				$this->db->createCommand()->update($this->table, [
						'and',
						['or',
							['userid' => Yii::$app->user->id],
							['id' => Yii::$app->session->getId()],
						],
						['name' 	=> $widget->id],
						['status' 	=> 0]
					]
				)->execute();
			} else {
				$this->db->createCommand()->update($this->table, [
						'status' => 1
					],
					[
						'and',
						['or',
							['userid' => Yii::$app->user->id],
							['id' => Yii::$app->session->getId()],
						],
						['name' 	=> $widget->id],
						['status' 	=> 0]
					]
				)->execute();
				Yii::$app->session->regenerateID(true);
			}
			$this->db->createCommand($qry)->execute();
		}
	}

	/**
	 * @param BuilderWidget $widget
	 * @return array|bool
	 */
	public function select(BuilderWidget $widget)
	{
		return (new Query())
			->select('*')
			->from($this->table)
			->where(['or', 'userid = ' . Yii::$app->user->id, 'id = \'' . Yii::$app->session->getId() . '\''])
			->andWhere([
				'name' => $widget->id,
				'status' => 0,
			])
			->orderBy(['id' => SORT_DESC])
			->limit(1)
			->one($this->db);
	}

	/**
	 * @param BuilderWidget $widget
	 */
	public function insert(BuilderWidget $widget)
	{
		$this->db->createCommand()->insert($this->table, [
			'id' => Yii::$app->session->getId(),
			'userid' => Yii::$app->user->id,
			'name' => $widget->id,
			'content' => $this->serialize($widget),
			'status' => 0,
		])->execute();
	}

	/**
	 * @param BuilderWidget $widget
	 */
	public function update(BuilderWidget $widget)
	{
		$this->db->createCommand()->update($this->table, [
				'content' => $this->serialize($widget)
			],
			[
				'and',
				['or',
					['userid' => Yii::$app->user->id],
					['id' => Yii::$app->session->getId()],
				],
				['name' 	=> $widget->id],
				['status' 	=> 0]
			]
		)->execute();
	}
}