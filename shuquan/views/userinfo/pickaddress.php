<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '个人信息';
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
								<a href="<?php echo Yii::$app->homeUrl;?>/user/recovery/request"> <strong>修改密码</strong></a>  |
								<!--<a href="<?php echo Yii::$app->homeUrl;?>/userinfo/pickaddress"> <strong  class="picked">收货地址</strong></a>-->
								
							</div>	
						</div>

					</div>
				</div>

			<div class="blog-content container" style="margin-left:1%">
			<?php $form = ActiveForm::begin([  
			'action' => ['userinfo/pickaddress'], //提交地址(*可省略*)  
			'method'=>'post',    //提交方法(*可省略默认POST*)  
			'id' => 'login-form', //设置ID属性  
			'options' => [  
					'class' => 'form-horizontal', //设置class属性  
			],  
		]); ?>  
				<div class="form-group">
					  <label for="name" class="pull-left  control-label">收货人姓名:</label>
					  <div class="pull-left" style="margin-left:10px;">
						 <input type="text" class="form-control" id="name" name="Userinfo[realname]"
							placeholder="请输入收货人姓名" value="<?=$data->realname?>">
					  </div>
				   </div>
				   <div class="form-group">
					  <label for="number" class="pull-left  control-label">手机&nbsp&nbsp&nbsp号码:</label>
					  <div class="pull-left" style="margin-left:10px;">
						 <input type="text" class="form-control" id="number" 
							placeholder="请输入手机号" name="Userinfo[phone]" value="<?=$data->phone?>">
					  </div>
				   </div>
				    <div class="form-group">
					  <label class="pull-left  control-label">取&nbsp&nbsp&nbsp货&nbsp&nbsp&nbsp点:</label>
					  <div class="pull-left" style="margin-left:10px;">
					<select  class="form-control pull-left" name="Userinfo[pickid]">
					  <?php foreach($pickinfodata as $v){?>
						<option value =<?=$v->id?> <?php if($v->id==$data->pickid){?>selected="selected"<?php }?>><?=$v->pickaddress?></option>
						<?php }?>
						</select>
					  </div>
				   </div>
				   <div class="form-group">
					  <label for="username" class="pull-left  control-label">取货联系人:</label>
					  <div class="pull-left" style="margin-left:10px;">
						<p class="form-control-static"><?=$data->pickinfo[0]->pickpeople?></p>
					  </div>
				   </div>
				   <div class="form-group">
					  <div style="margin-left:5%;">
						 <button type="submit" class="btn btn-danger  btn-lg">保存</button>
						</div>
					</div>
			</div>
			<?php ActiveForm::end(); ?>  
		</div>