<?php

use app\models\DeviceBrand;
use app\models\DeviceStatus;
use app\models\DeviceType;
use kartik\widgets\DatePicker;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Device */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="device-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>

    <?=$form->field($model, 'code')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'name')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'sn')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'brand_id')->widget(Select2::classname(), [
	'data' => ArrayHelper::map(DeviceBrand::find()->orderBy('name')->all(), 'id', 'name'),
	'options' => ['placeholder' => '-- เลือกยี่ห้อ --'],
	'pluginOptions' => [
		'allowClear' => true,
	],
]);?>

    <?=$form->field($model, 'register_date')->widget(DatePicker::classname(), [
	'options' => ['placeholder' => '-- เลือกวันที่ --'],
	'pluginOptions' => [
		'format' => 'yyyy-mm-dd',
		// 'daysOfWeekDisabled' => [0, 6],
		'autoclose' => true,
		'todayBtn' => true,
		'todayHighlight' => true,
	],
]);?>

    <?=$form->field($model, 'status_id')->widget(Select2::classname(), [
	'data' => ArrayHelper::map(DeviceStatus::find()->all(), 'id', 'name'),
	'options' => ['placeholder' => '-- เลือกสถานะ --'],
	'pluginOptions' => [
		'allowClear' => true,
	],
]);?>

    <?=$form->field($model, 'type_id')->widget(Select2::classname(), [
	'data' => ArrayHelper::map(DeviceType::find()->orderBy('name')->all(), 'id', 'name'),
	'options' => ['placeholder' => '-- เลือกประเภท --'],
	'pluginOptions' => [
		'allowClear' => true,
	],
]);?>

    <?=$form->field($model, 'image')->widget(FileInput::classname(), [
	'options' => ['multiple' => true],
	'pluginOptions' => ['previewFileType' => 'any'],
]);?>

    <div class="form-group">
        <?=Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
