<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RepairSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Repairs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repair-index">

    <h1><?=Html::encode($this->title)?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=Html::a('Create Repair', ['create'], ['class' => 'btn btn-success'])?>
    </p>
    <?=GridView::widget([
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],

		// 'id',
		'divice.name',
		'user.profile.fullname',
		'code',
		'date',
		// 'cost',
		'status.name',
		// 'comment:ntext',
		// 'receiver_user_id',
		// 'return_user_id',
		// 'return_date',

		['class' => 'yii\grid\ActionColumn'],
	],
]);?>
</div>
