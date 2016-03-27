<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
<head>
    <meta charset="<?=Yii::$app->charset?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?=Html::csrfMetaTags()?>
    <title><?=Html::encode($this->title)?></title>
    <?php $this->head()?>
</head>
<body>
<?php $this->beginBody()?>

<div class="wrap">
    <?php
NavBar::begin([
	'brandLabel' => 'My Company',
	'brandUrl' => Yii::$app->homeUrl,
	'options' => [
		'class' => 'navbar-inverse navbar-fixed-top',
	],
]);
echo Nav::widget([
	'options' => ['class' => 'navbar-nav navbar-right'],
	'items' => [
		['label' => 'Home', 'url' => ['/site/index']],
		// ['label' => 'About', 'url' => ['/site/about']],
		// ['label' => 'Contact', 'url' => ['/site/contact']],
		['label' => 'Device', 'items' => [
			['label' => 'Device', 'url' => ['/device/index']],
			['label' => 'Type', 'url' => ['/device-type/index']],
			['label' => 'Brand', 'url' => ['/device-brand/index']],
			['label' => 'Status', 'url' => ['/device-status/index']],
		]],
		['label' => 'Repair', 'items' => [
			['label' => 'Repair', 'url' => ['/repair/index']],
			['label' => 'Status', 'url' => ['/repair-status/index']],
		]],
		['label' => 'Admin', 'url' => ['/user/admin/index']],
		['label' => 'Profile', 'url' => ['/user/settings/profile']],
		Yii::$app->user->isGuest ? (
			['label' => 'Login', 'url' => ['/user/security/login']]
		) : (
			'<li>' . Html::a('Logout (' . Yii::$app->user->identity->username . ')', Url::to(['/user/security/logout']), ['data-method' => 'POST']) . '</li>'
		),
	],
]);
NavBar::end();
?>

    <div class="container">
        <?=Breadcrumbs::widget([
	'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
])?>
        <?=$content?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?=date('Y')?></p>

        <p class="pull-right"><?=Yii::powered()?></p>
    </div>
</footer>

<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
