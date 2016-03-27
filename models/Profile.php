<?php

namespace app\models;

use app\models\Department;
use dektrium\user\models\User;
use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property integer $user_id
 * @property integer $officer_code
 * @property string $title
 * @property string $firstname
 * @property string $lastname
 * @property string $nickname
 * @property integer $department_id
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'profile';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['user_id', 'officer_code', 'department_id'], 'required'],
			[['user_id', 'officer_code', 'department_id'], 'integer'],
			[['title'], 'string', 'max' => 15],
			[['firstname'], 'string', 'max' => 25],
			[['lastname'], 'string', 'max' => 40],
			[['nickname'], 'string', 'max' => 20],
			[['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'user_id' => 'User ID',
			'officer_code' => 'รหัสเจ้าหน้าที่',
			'title' => 'คำนำหน้า',
			'firstname' => 'ชื่อ',
			'lastname' => 'นามสกุล',
			'nickname' => 'ชื่อเล่น',
			'department_id' => 'แผนก',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser() {
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

	public function getDepartment() {
		return $this->hasOne(Department::className(), ['id' => 'department_id']);
	}

	// $this->fullname;
	// Profile::FullName;
	public function getFullName() {
		return "{$this->title}{$this->firstname} {$this->lastname}";
	}
}
