<?php

use app\models\Device;
use app\models\RepairStatus;
use dektrium\user\models\User;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Repair */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="repair-form">

    <?php $form = ActiveForm::begin();?>

    <?=$form->field($model, 'comment')->textarea(['rows' => 3])?>

    <?=$form->field($model, 'divice_id')->widget(Select2::classname(), [
	'data' => ArrayHelper::map(Device::find()->where([
		'status_id' => [1, 2],
	])->orderBy('name')->all(), 'id', 'name'),
	'options' => ['placeholder' => '-- เลือกครุภัณฑ์ --'],
	'pluginOptions' => [
		'allowClear' => true,
	],
]);?>

    <?=$form->field($model, 'user_id')->widget(Select2::classname(), [
	'data' => ArrayHelper::map(User::find()->joinWith('profile')->orderBy('profile.firstname, profile.lastname')->all(), 'id', 'profile.fullname'),
	'options' => ['placeholder' => '-- เลือกผู้แจ้งซ่อม --'],
	'pluginOptions' => [
		'allowClear' => true,
	],
]);?>

    <?=$form->field($model, 'code')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'date')->widget(DatePicker::classname(), [
	'options' => ['placeholder' => '-- เลือกวันที่ --'],
	'pluginOptions' => [
		'format' => 'yyyy-mm-dd',
		// 'daysOfWeekDisabled' => [0, 6],
		'autoclose' => true,
		'todayBtn' => true,
		'todayHighlight' => true,
	],
]);?>

    <?=$form->field($model, 'cost')->textInput()?>

    <?=$form->field($model, 'status_id')->widget(Select2::classname(), [
	'data' => ArrayHelper::map(RepairStatus::find()->orderBy('name')->all(), 'id', 'name'),
	'options' => ['placeholder' => '-- เลือกสถานะ --'],
	'pluginOptions' => [
		'allowClear' => true,
	],
]);?>

    <?=$form->field($model, 'receiver_user_id')->widget(Select2::classname(), [
	'data' => ArrayHelper::map(User::find()->joinWith('profile')->orderBy('profile.firstname, profile.lastname')->all(), 'id', 'profile.fullname'),
	'options' => ['placeholder' => '-- เลือกผู้แจ้งซ่อม --'],
	'pluginOptions' => [
		'allowClear' => true,
	],
]);?>

    <?=$form->field($model, 'return_user_id')->widget(Select2::classname(), [
	'data' => ArrayHelper::map(User::find()->joinWith('profile')->orderBy('profile.firstname, profile.lastname')->all(), 'id', 'profile.fullname'),
	'options' => ['placeholder' => '-- เลือกผู้แจ้งซ่อม --'],
	'pluginOptions' => [
		'allowClear' => true,
	],
]);?>

    <?=$form->field($model, 'return_date')->widget(DatePicker::classname(), [
	'options' => ['placeholder' => '-- เลือกวันที่ --'],
	'pluginOptions' => [
		'format' => 'yyyy-mm-dd',
		// 'daysOfWeekDisabled' => [0, 6],
		'autoclose' => true,
		'todayBtn' => true,
		'todayHighlight' => true,
	],
]);?>

    <div class="form-group">
        <?=Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
