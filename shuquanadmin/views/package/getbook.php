<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;  
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PackageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '待收书';
$this->params['breadcrumbs'][] = $this->title;
?>
<script>
function selectAll(){
 var checklist = document.getElementsByName ("packageid[]");
   if(document.getElementById("controlAll").checked)
   {
   for(var i=0;i<checklist.length;i++)
   {
      checklist[i].checked = 1;
   } 
 }else{
  for(var j=0;j<checklist.length;j++)
  {
     checklist[j].checked = 0;
  }
 }
}
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
								<?= Html::a("<strong >待收书</strong>",['/package/waitbook']); ?>|
								<?= Html::a("<strong  class='picked'>已收书</strong>",['/package/getbook']); ?>|
								<?= Html::a("<strong>已还书</strong>",['/package/backbook']); ?>
								
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
		<?php $form = ActiveForm::begin([  
			'action' => ['package/backall'], //提交地址(*可省略*)  
			'method'=>'post',    //提交方法(*可省略默认POST*)  
			'id' => 'login-form', //设置ID属性  
			'options' => [  
					'class' => 'form-horizontal', //设置class属性  
			],  
		]); ?>  
			<table class="table" style="width:65%">  
				<thead>  
					<tr>  
						<th style="width:60px;"><label> <input type="checkbox" onclick="selectAll()" id="controlAll">全选</label></th>  
						<th style="width:200px;"><label>产品信息</label></th>
						<th style="width:100px;"><label></label></th>						
						<th style="width:100px;"><label>剩余押金(元)</label></th>  
						<th style="width:120px;"><label>归还截止日期</label></th>   
						<th style="width:40px;"><label><label><button type="submit" class="delete btn btn-xs btn-primary">我要还书</button> </label></th>    
					</tr>  
				</thead>  
				<tbody style="border:#dddddd solid 1px;">
				<?php foreach($data as $v){?>
				<tr ><td colspan="6"><?php echo date('Y-m-d H:i:s',$v->time);?><strong style="margin-left:15px;">订单号：<?=$v->id?></strong></td></tr>
				<?php foreach($v->orderpackage as $b){?>
				<?php if($b->package->status==3){?>
					<tr style="background-color:;">  
						<td ><input class="check-one check" type="checkbox" name="packageid[]" value=<?=$b->packageid?> /> </td>  
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
						<td class="number small-bold-red"><span><?php $time = $b->package->time; echo ($b->package->resdeposit-(floor((time()-$time)/24/3600)>365?floor((floor((time()-$time)/24/3600)-365)/7):0)*0.01*$b->package->book->oldprice)>0?round(($b->package->resdeposit-(floor((time()-$time)/24/3600)>365?floor((floor((time()-$time)/24/3600)-365)/7):0)*0.01*$b->package->book->oldprice),1):0; ?></span></td> 
						<td class="subtotal number small-bold-red" style="font-size:12px;"><?php $time =$b->package->time;$endtime = $time+365*24*3600;echo date('Y-m-d',$endtime);?></br>还剩<strong class="text-danger"><?php $time = $b->package->time; echo $day = (365-floor((time()-$time)/24/3600))>0?(365-floor((time()-$time)/24/3600)):0; ?></strong>天</td>  
						<td class="operation"><?= Html::a("我要还书",['package/back', 'id' => $b->packageid],['class' => 'delete btn btn-xs btn-primary']); ?></td>  
					</tr> 
				<?php }?>					
				<?php }?>
				<?php }?>
				</tbody>  
			</table>  
			<?php ActiveForm::end(); ?>  
			  <div class="pull-left">
<?=\yii\widgets\LinkPager::widget([
	'pagination' => $pagination,
	'options' => [
		'class' => 'pagination',
		]
]);?>
</div>
			</div>
