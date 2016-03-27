<?php

namespace app\models;

use app\models\Device;
use app\models\RepairStatus;
use dektrium\user\models\User;
use Yii;

/**
 * This is the model class for table "repair".
 *
 * @property integer $id
 * @property integer $divice_id
 * @property integer $user_id
 * @property string $code
 * @property string $date
 * @property double $cost
 * @property integer $status_id
 * @property string $comment
 * @property integer $receiver_user_id
 * @property integer $return_user_id
 * @property string $return_date
 */
class Repair extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'repair';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['comment', 'code', 'user_id', 'date', 'status_id', 'receiver_user_id'], 'required'],
			[['divice_id', 'user_id', 'status_id', 'receiver_user_id', 'return_user_id'], 'integer'],
			[['date', 'return_date'], 'safe'],
			[['cost'], 'number'],
			[['comment'], 'string'],
			[['code'], 'string', 'max' => 15],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id' => 'ID',
			'divice_id' => 'ครุภัณฑ์',
			'user_id' => 'ผู้แจ้งซ่อม',
			'code' => 'รหัสการแจ้งซ่อม',
			'date' => 'วันที่แจ้งซ่อม',
			'cost' => 'ค่าใช้จ่าย',
			'status_id' => 'สถานะ',
			'comment' => 'เรื่องแจ้งซ่อม',
			'receiver_user_id' => 'ผู้รับเรื่อง',
			'return_user_id' => 'ผู้ส่งคืน',
			'return_date' => 'วันที่ส่งคืน',
		];
	}

	public function afterSave($insert, $changedAttributes) {
		// $model = Device::findOne($this->divice_id);
		// $model->status_id = 4;
		// $model->save();
		// parent::afterSave($insert, $changedAttributes);
		$model = Device::findOne($this->divice_id);
		if (empty($this->return_date)) {
			$model->status_id = 4;
		} else {
			$model->status_id = 1;
		}
		$model->save();
		parent::afterSave($insert, $changedAttributes);
	}

	public function getDivice() {
		// inner join divice on (divice.id = repair.divice_id)
		return $this->hasOne(Device::className(), ['id' => 'divice_id']);
	}

	public function getUser() {
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

	public function getStatus() {
		return $this->hasOne(RepairStatus::className(), ['id' => 'status_id']);
	}

	public function getReceiverUser() {
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

	public function getReturnUser() {
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}
}
