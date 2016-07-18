<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;  
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PackageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '已收书';
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
							<?= Html::a("<strong >待收书</strong>",['/package/waitbook']); ?>|
							<?= Html::a("<strong>已收书</strong>",['/package/getbook']); ?>|
							<?= Html::a("<strong class='picked'>已还书</strong>",['/package/backbook']); ?>
								
							</div>	
						</div>

					</div>
				</div>

			<div class="blog-content container" style="margin-left:1%">
			<?php $form = ActiveForm::begin([  
			
			'method'=>'post',    //提交方法(*可省略默认POST*)  
			'id' => 'login-form', //设置ID属性  
			'options' => [  
					'class' => 'form-horizontal', //设置class属性  
			],  
		]); ?> 
		<div class="row">
							<div class="col-sm-6 hidden-xs">
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
								<form class="form-inline">
								<div class="input-group">
								<span class="input-group-btn" style="width:100px;color:#555;">
										<select name="kind" class="form-control" style="background:#C7C7C7; color: #000;">
										<option value=1 <?php if($kind==1){echo "selected='select'";}?>>订单号</option>
										<option value=2 <?php if($kind==2){echo "selected='select'";}?>>姓名</option>
										</select>
									</span>
								  <input id="search" type="text" placeholder="Search" name="text" class="form-control input-large" value=<?=$text?>>
								  <span class="input-group-btn">
										<button class="btn" style="color: #ffffff;background-color:#272727;" type="submit"><i class="icon-search"></i> 搜索</button>
									</span>
								</div>
								</form>
								
							</div>
							
						</div>
				<?php ActiveForm::end(); ?>  		
			<table class="table" style="width:65%">  
				<thead>  
					<tr>  
						<th style="width:60px;"><label> </label></th>  
						<th style="width:200px;"><label>产品信息</label></th>
						<th style="width:100px;"><label></label></th>						
						<th style="width:100px;"><label>剩余押金(元)</label></th>  
						<th style="width:120px;"><label>借书人</label></th>   
						<th style="width:40px;"><label>手机号</th>    
					</tr>  
				</thead>  
				<tbody style="border:#dddddd solid 1px;">
				<?php foreach($data as $v){?>
				<tr ><td colspan="6"><?php echo date('Y-m-d H:i:s',$v->time);?><strong style="margin-left:15px;">订单号：<?=$v->id?></strong></td></tr>
				<?php foreach($v->orderpackage as $b){?>
				<?php if($b->package->status==4){?>
					<tr style="background-color:;">  
						<td > </td>  
						<td class="goods">
						<div class="row">
							<div class="col-md-3" style="margin-left:-35px;">
								<a href="#"><img src="http://shuquan.53.haitou.cc/img<?=$b->package->book->bookimg->localurl?>" style="width:90px;height:120px;" alt=""></a>
							</div>
							<div class="col-md-9">
								<h4><strong><?=$b->package->book->bookname?></strong></h4>
								<div class="blog-post-metadata">
									<div class="book">作&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp者：<strong><?=$b->package->book->author?></strong></div>
									<div class="book">出&nbsp&nbsp&nbsp&nbsp版社：<strong><?=$b->package->book->publishing?></strong></div>
									<div class="book">IS&nbsp&nbsp&nbsp&nbsp&nbsp&nbspBN：<strong><?=$b->package->book->isbn?></strong></div>
								</div>
							</div>
						</div>
						</td>  
						<td></td>  
						<td class="number small-bold-red"><span><?=$b->package->resdeposit?></span></td> 
						<td class="subtotal number small-bold-red" style="font-size:12px;"><?=$v->userinfo->realname?></td>  
						<td class="operation"><?=$v->userinfo->phone?></td>  
					</tr> 
				<?php }?>					
				<?php }?>
				<?php }?>
				</tbody>  
			</table>  
			  <div class="pull-left">
<?=\yii\widgets\LinkPager::widget([
	'pagination' => $pagination,
	'options' => [
		'class' => 'pagination',
		]
]);?>
</div>
			</div>