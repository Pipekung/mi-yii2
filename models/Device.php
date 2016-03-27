<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "device".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $sn
 * @property integer $brand_id
 * @property string $register_date
 * @property integer $status_id
 * @property integer $type_id
 *
 * @property DeviceType $type
 * @property DeviceBrand $brand
 * @property DeviceStatus $status
 */
class Device extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'device';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['brand_id', 'register_date', 'status_id', 'type_id', 'code', 'name', 'sn'], 'required'],
			[['brand_id', 'status_id', 'type_id'], 'integer'],
			[['register_date'], 'safe'],
			[['code', 'sn'], 'string', 'max' => 20],
			[['name'], 'string', 'max' => 30],
			[['code'], 'unique'],
			[['image'], 'file', 'extensions' => 'png, jpg'],
			[['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeviceType::className(), 'targetAttribute' => ['type_id' => 'id']],
			[['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeviceBrand::className(), 'targetAttribute' => ['brand_id' => 'id']],
			[['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeviceStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id' => 'ID',
			'code' => 'รหัสครุภัณฑ์',
			'name' => 'ชื่อครุภัณฑ์',
			'sn' => 'Serial Number',
			'brand_id' => 'ยี่ห้อ',
			'register_date' => 'วันที่ลงทะเบียน',
			'status_id' => 'สถานะ',
			'type_id' => 'ประเภทครุภัณฑ์',
			'image' => 'รูปภาพ',
		];
	}

	public function beforeSave($insert) {
		if (parent::beforeSave($insert)) {
			$this->image = UploadedFile::getInstance($this, 'image');
			$imgName = $this->image->baseName . '_' . md5(time()) . '.' . $this->image->extension;
			$this->image->saveAs('uploads/' . $imgName);
			$this->image = $imgName;
			return true;
		} else {
			return false;
		}
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getType() {
		return $this->hasOne(DeviceType::className(), ['id' => 'type_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getBrand() {
		return $this->hasOne(DeviceBrand::className(), ['id' => 'brand_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getStatus() {
		return $this->hasOne(DeviceStatus::className(), ['id' => 'status_id']);
	}
}
