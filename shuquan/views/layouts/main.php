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
			<li><?= Html::a("<i class='icon-star icon-2x'></i> <br/>华中科技大学",['/book/index?BookSearch[schoolid]=1']); ?></li>
			<li><?= Html::a("<i class='icon-star icon-2x'></i> <br/>武汉大学",['/book/index?BookSearch[schoolid]=2']); ?></li>
			<li><?= Html::a("<i class='icon-refresh icon-2x'></i> <br/>教材换购",['/package/index']); ?></li>
			<li><?= Html::a("<i class='icon-folder-close  icon-2x'></i> <br/>我的书包",['/package/index']); ?></li>
			<li><?= Html::a("<i class='icon-user icon-2x'></i> <br/>个人信息",['/userinfo/index']); ?></li>
			<li><?= Html::a("<i class='icon-info icon-2x'></i> <br/>关于我们",['/userinfo/index']); ?></li>
	    	</ul>
		<div class="content-area">
			<div class="login-strip">
			<?php 
			if(Yii::$app->user->isGuest)
			{
			?>
				<?= Html::a("<i class='icon-plus'></i> 注 册",['/user/registration/register']); ?> |
				<?= Html::a("<i class='icon-signin'></i> 登 录",['/user/security/login']); ?>
			<?php
			}
			else
			{
			?>
			<?= Html::a("<i class='icon-signout'></i> 退出",['/user/security/logout']); ?>
			<?php
			}
			?>
			</div>
			<div class="page-header">
				<div class="container">
					<h3 style="font-weight:blod;">
						<small class="pull-right hidden-xs">
							<a href="<?php if(isset($this->params['titleurl'])){echo $this->params['titleurl'];}else{echo "./";}?>"><?php if(isset($this->params['titleinfo'])){echo $this->params['titleinfo'];}else{echo "首页";}?></a> <?php if(isset($this->params['aboutLittle'])){echo ">";}?>
							<a class="active" href=<?php if(isset($this->params['abouturl'])){echo $this->params['abouturl'];}?>><?php if(isset($this->params['aboutLittle'])){echo $this->params['aboutLittle'];}?>
							</a>
						</small>
					</h3>
					<small class="visible-xs">
						<a href="./">Home</a> >
						<a class="active" href="#">Portfolio</a>
					</small>
				
				</div>			
			</div>
        <?= $content ?>
		
		</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
