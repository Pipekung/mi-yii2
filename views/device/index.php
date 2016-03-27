<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DeviceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Devices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-index">

    <h1><?=Html::encode($this->title)?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=Html::a('Create Device', ['create'], ['class' => 'btn btn-success'])?>
    </p>
    <?=GridView::widget([
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'summary' => '',
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],

		// 'id',
		[
			'format' => 'html',
			'attribute' => 'image',
			'value' => function ($model) {
				return Html::img('uploads/' . $model->image, ['width' => '100']);
			},
		],
		'code',
		'name',
		'sn',
		'brand.name',
		'status.name',
		'type.name',
		'register_date',

		['class' => 'yii\grid\ActionColumn'],
	],
]);?>
</div>
