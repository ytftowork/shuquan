<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '修改密码';
$this->params['breadcrumbs'][] = $this->title;
?>
			<div id="portfolio">
				<div id="filters_container" style="margin-left:3%;margin-right:30%">
					<div class="container">
								<!-- <div class="input-group">
									<span class="input-group-btn">
										<button class="btn dropdown-toggle" data-toggle="dropdown">
										  Action
										  <span class="caret"></span>
										</button>
										<ul class="dropdown-menu">
										  ...
										</ul>
									</span>
									<input id="search" type="text" placeholder="Search" class="form-control input-large">
									<span class="input-group-btn">
										<button class="btn" type="button"><i class="icon-search"></i> 搜索</button>
									</span>
								</div> -->
							<div class="inf">
								<a href="<?php echo Yii::$app->homeUrl;?>/userinfo/index" > <strong>个人信息</strong></a> |
								<a href="<?php echo Yii::$app->homeUrl;?>/user/recovery/request" > <strong  class="picked">修改密码</strong></a>  |
								<a href="<?php echo Yii::$app->homeUrl;?>/userinfo/pickaddress"> <strong>收货地址</strong></a>
								
							</div>	
						</div>

					</div>
				</div>

			<div class="blog-content container" style="margin-left:1%">
			<?php $form = ActiveForm::begin([  
			'action' => ['userinfo/changepassword'], //提交地址(*可省略*)  
			'method'=>'post',    //提交方法(*可省略默认POST*)  
			'id' => 'login-form', //设置ID属性  
			'options' => [  
					'class' => 'form-horizontal', //设置class属性  
			],  
		]); ?>  
					 <div class="form-group">
					  <label for="oldpas" class="pull-left  control-label">旧&nbsp&nbsp密&nbsp码:</label>
					  <div class="pull-left" style="margin-left:10px;">
						 <input type="text" class="form-control" id="oldpas" name="oldpas">
					  </div>
				   </div>
				   <div class="form-group">
					  <label for="newpas" class="pull-left  control-label">新&nbsp&nbsp密&nbsp码:</label>
					  <div class="pull-left" style="margin-left:10px;">
						 <input type="text" class="form-control" id="nickname" name="newpas">
					  </div>
				   </div>
				    <div class="form-group">
					  <label for="repas" class="pull-left  control-label">重复密码:</label>
					  <div class="pull-left" style="margin-left:10px;">
						 <input type="text" class="form-control" id="nickname" name="repas">
					  </div>
				   </div>
				   <div class="form-group">
					  <div style="margin-left:4.3%;">
						 <button type="submit" class="btn btn-danger  btn-lg">保存</button>
					</div>
				</div>
			</div>
			<?php ActiveForm::end(); ?>  
		</div>