<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
		<ul id="sidemenu" class="sidemenu hidden-xs">
			<li  class="sidemenu-brand"><?= Html::a("书圈",['/book/index'],['class' => 'icon-book']); ?></li>
			<li><?= Html::a("<i class='icon-home icon-2x'></i> <br/>首页",['/book/index']); ?></li>
			<li><?= Html::a("<i class='icon-folder-close icon-2x'></i> <br/>待收书",['/package/waitbook']); ?></li>
			<li><?= Html::a("<i class='icon-folder-close icon-2x'></i> <br/>已收书",['/package/getbook']); ?></li>
			<li><?= Html::a("<i class='icon-folder-close icon-2x'></i> <br/>已还书",['/package/backbook']); ?></li>		
			<li><?= Html::a("<i class='icon-folder-close icon-2x'></i> <br/>取货点管理",['/pickinfo/index']); ?></li>		
	    	</ul>
		<div class="content-area">
		
        <?= $content ?>
		
		</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
