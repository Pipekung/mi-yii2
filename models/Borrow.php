<?php

namespace app\models;

use app\models\Device;
use Yii;

/**
 * This is the model class for table "borrow".
 *
 * @property integer $id
 * @property integer $device_id
 * @property integer $user_id
 * @property string $code
 * @property string $borrow_date
 * @property integer $borrow_user_id
 * @property string $return_date
 * @property integer $return_user_id
 * @property string $comment
 */
class Borrow extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'borrow';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['device_id', 'user_id', 'borrow_date', 'borrow_user_id'], 'required'],
			[['device_id', 'user_id', 'borrow_user_id', 'return_user_id'], 'integer'],
			[['borrow_date', 'return_date'], 'safe'],
			[['comment'], 'string'],
			[['code'], 'string', 'max' => 20],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id' => 'ID',
			'device_id' => 'ครุภัณฑ์',
			'user_id' => 'ผู้ยืม',
			'code' => 'เลขที่การยืม',
			'borrow_date' => 'วันที่ยืม',
			'borrow_user_id' => 'ผู้ดำเนินการยืม',
			'return_date' => 'วันที่คืน',
			'return_user_id' => 'ผู้ดำเนินการคืน',
			'comment' => 'หมายเหตุ',
		];
	}

	public function afterSave($insert, $changedAttributes) {
		$model = Device::findOne($this->device_id);
		if (empty($this->return_date)) {
			$model->status_id = 3;
		} else {
			$model->status_id = 1;
		}
		$model->save();
		parent::afterSave($insert, $changedAttributes);
	}

}
