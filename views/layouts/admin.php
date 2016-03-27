<?php
use yii\helpers\Url;
?>
<?php $this->beginContent('@app/views/layouts/main.php');?>
<div class="row">
	<div class="col-xs-2">
		<div class="list-group">
			<a href="<?=Url::to(['/user/admin'])?>" class="list-group-item">Manage User</a>
			<a href="<?=Url::to(['/admin'])?>" class="list-group-item">Manage Permission</a>
		</div>
	</div>
	<div class="col-xs-10"><?=$content?></div>
</div>
<?php $this->endContent();?>