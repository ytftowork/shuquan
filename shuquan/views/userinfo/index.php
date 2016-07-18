<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '个人信息';
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="<?php echo Yii::getAlias('@web'); ?>/css/js/jquery-2.1.4.min.js"></script>
<script language="javascript" type="text/javascript"> 
$(document).ready(function(){ 
$('#school').change(function(){ 
 $.ajax({
       url: '<?php echo Yii::$app->request->baseUrl. '/userinfo/changevalue' ?>',
       cache:false,  
		dataType:'json', 
		data:{  
               school : $("#school").val(),  
      },  
       success: function (data) {
          var pick = $("#pick");
			pick.empty();
			 var pickname = $("#pickname");
		  var pickpeople = data['data'][0]['pickpeople'];
		  pickname.text(pickpeople);
			//alert(data[0]['id']);
			//console.log(data['data']);
			for(var i=0;i<data['data'].length;i++) {
				var option = $("<option>").text(data['data'][i]['pickaddress']).val(data['data'][i]['id']);
				//alert(option);
				pick.append(option);
			}
			
       }
  });
})
$('#pick').change(function(){ 
 $.ajax({
       url: '<?php echo Yii::$app->request->baseUrl. '/userinfo/changepick' ?>',
       cache:false,  
		dataType:'json', 
		data:{  
               pick : $("#pick").val(),  
      },  
       success: function (data) {
          var pickname = $("#pickname");
		  var pickpeople = data['data'][0]['pickpeople'];
			pickname.text(pickpeople);
			//console.log(pickname.text());
		
       }
  });
})  
}) 
</script> 
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
							<?= Html::a("<strong class='picked'>个人信息</strong>",['/userinfo/index']); ?>|
							<?= Html::a("<strong>修改密码</strong>",['/user/recovery/request']); ?>
								<!--<a href="<?php echo Yii::$app->homeUrl;?>/userinfo/pickaddress"> <strong>收货地址</strong></a> -->
								
							</div>	
						</div>

					</div>
				</div>

			<div class="blog-content container" style="margin-left:1%">
			<?php $form = ActiveForm::begin([  
			'action' => ['userinfo/index'], //提交地址(*可省略*)  
			'method'=>'post',    //提交方法(*可省略默认POST*)  
			'id' => 'login-form', //设置ID属性  
			'options' => [  
					'class' => 'form-horizontal', //设置class属性  
			],  
		]); ?>  
					<div class="form-group">
					  <label for="username" class="pull-left  control-label">用户名:</label>
					  <div class="pull-left" style="margin-left:10px;">
						<p class="form-control-static"><?=$data1->username?></p>
					  </div>
				   </div>
				  <!-- <div class="form-group">
					  <label for="nickname" class="pull-left  control-label">昵&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp称:</label>
					  <div class="pull-left" style="margin-left:10px;width:300px;">
						 <input type="text" class="form-control" id="nickname" 
							placeholder="请输入昵称" name="Userinfo[nickname]" value="<?=$data->nickname?>">
					  </div>
				   </div>-->
				   <div class="form-group">
					  <label class="pull-left  control-label">学&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp校:</label>
					  <div class="pull-left" style="margin-left:10px; width:300px;">
					  <select  class="form-control pull-left"  name="Userinfo[school]" id="school">
					  <?php foreach($schooldata as $v){?>
						<option value =<?=$v->id?> <?php if($v->id==$data->school){?>selected="selected"<?php }?>><?=$v->name?></option>
						<?php }?>
						</select>
					  </div>
				   </div>
				   <div class="form-group">
					   <label class="pull-left  control-label">院系&nbsp&nbsp&nbsp名称:</label>
						<div class="pull-left" style="margin-left:10px; width:300px;">
						<select  class="form-control pull-left" style="width:50%" name="Userinfo[departmentid]">
					  <?php foreach($departmentdata as $v){?>
						<option value =<?=$v->id?> <?php if($v->id==$data->departmentid){?>selected="selected"<?php }?>><?=$v->name?></option>
						<?php }?>
						</select>
							<input type="text" class="form-control pull-left"  style="width:50%"id="firstname" name="Userinfo[departmentname]" 
							placeholder="请输入院系" value="<?=$data->departmentname?>">
						 </div>
					 </div>
					<div class="form-group">
					  <label for="name" class="pull-left  control-label">收货人姓名:</label>
					  <div class="pull-left" style="margin-left:10px; width:300px;">
						 <input type="text" class="form-control" id="name" name="Userinfo[realname]"
							placeholder="请输入收货人姓名" value="<?=$data->realname?>">
					  </div>
				   </div>
				   <div class="form-group">
					  <label for="number" class="pull-left  control-label">手机&nbsp&nbsp&nbsp号码:</label>
					  <div class="pull-left" style="margin-left:10px; width:300px;">
						 <input type="text" class="form-control" id="number" 
							placeholder="请输入手机号" name="Userinfo[phone]" value="<?=$data->phone?>">
					  </div>
				   </div>
				    <div class="form-group">
					  <label class="pull-left  control-label">取&nbsp&nbsp&nbsp货&nbsp&nbsp&nbsp点:</label>
					  <div class="pull-left" style="margin-left:10px; width:300px;">
					<select   class="form-control pull-left" name="Userinfo[pickid]" id="pick">
					  <?php foreach($pickinfodata as $v){?>
						<option value =<?=$v->id?> <?php if($v->id==$data->pickid){?>selected="selected"<?php }?>><?=$v->pickaddress?></option>
						<?php }?>
						</select>
					  </div>
				   </div>
				   <div class="form-group">
					  <label for="username" class="pull-left  control-label">取货联系人:</label>
					  <div class="pull-left" style="margin-left:10px; width:300px;">
						<p class="form-control-static" id="pickname"><?=$data->pickinfo[0]->pickpeople?></p>
					  </div>
				   </div>
							   <div class="form-group">
					  <div style="margin-left:2.5%;">
						 <button type="submit" class="btn btn-danger  btn-lg">保存</button>
					</div>
			</div>
			<?php ActiveForm::end(); ?>  
		</div>