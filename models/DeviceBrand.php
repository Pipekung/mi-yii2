<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "device_brand".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Device[] $devices
 */
class DeviceBrand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device_brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อยี่ห้อ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevices()
    {
        return $this->hasMany(Device::className(), ['brand_id' => 'id']);
    }
}
