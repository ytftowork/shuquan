<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;  
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PackageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '待付款';
$this->params['breadcrumbs'][] = $this->title;
?>
<script>
function fomatFloat(src,pos){ 
return Math.round(src*Math.pow(10, pos))/Math.pow(10, pos); 
} 
function selectAll(){
	var count = 0;
	var deposit = 0;
	var price = 0;
 var checklist = document.getElementsByName ("orderid[]");
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
 for(var i=0;i<checklist.length;i++)
   {
      if(checklist[i].checked==1)
	  {
		  count = count+1;
		   var tr = checklist[i].parentNode.parentNode;  
            var tds = tr.cells;  
			deposit = deposit+parseFloat(tds[2].innerHTML);  
			price = price+parseFloat(tds[3].innerHTML);  
           
	  }
   }
     price = fomatFloat(price,1);
   deposit = fomatFloat(deposit,1);
   var total = price+deposit;
   total =  fomatFloat(total,1);
    document.getElementById("count").innerHTML=count;
	 document.getElementById("deposit").innerHTML=deposit;
	  document.getElementById("price").innerHTML=price;
	    document.getElementById("totalprice").innerHTML=total;
}
function change()
{
	var count = 0;
	var deposit = 0;
	var price = 0;
	var checklist = document.getElementsByName ("orderid[]");
	for(var i=0;i<checklist.length;i++)
   {
      if(checklist[i].checked==1)
	  {
		  count = count+1;
		   var tr = checklist[i].parentNode.parentNode;  
            var tds = tr.cells;  
			deposit = deposit+parseFloat(tds[2].innerHTML);  
			price = price+parseFloat(tds[3].innerHTML);  
           
	  }
   }
     price = fomatFloat(price,1);
   deposit = fomatFloat(deposit,1);
   var total = price+deposit;
   total =  fomatFloat(total,1);
    document.getElementById("count").innerHTML=count;
	 document.getElementById("deposit").innerHTML=deposit;
	  document.getElementById("price").innerHTML=price;
	    document.getElementById("totalprice").innerHTML=total;
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
							<?= Html::a("<strong>我的书包</strong>",['/package/index']); ?>|
								<?= Html::a("<strong  class='picked'>待付款订单</strong>",['/package/waitpay']); ?>|
								<?= Html::a("<strong >待收书</strong>",['/package/waitbook']); ?>|
								<?= Html::a("<strong >已收书</strong>",['/package/getbook']); ?>|
								<?= Html::a("<strong>已还书</strong>",['/package/backbook']); ?>
								
							</div>	
						</div>

					</div>
				</div>
<?php $form = ActiveForm::begin([  
			'action' => ['package/payall'], //提交地址(*可省略*)  
			'method'=>'post',    //提交方法(*可省略默认POST*)  
			'id' => 'login-form', //设置ID属性  
			'options' => [  
					'class' => 'form-horizontal', //设置class属性  
			],  
		]); ?>  
		<div class="blog-content container" style="margin-left:1%">
			<table class="table" style="width:65%">  
				<thead>  
					<tr>  
					 
						<th style="width:200px;"><label>产品信息</label></th>  
						<th style="width:100px;"><label>押金(元)</label></th>  
						<th style="width:120px;"><label>租金(元)</label></th>  
						<th style="width:100px;"><label>应付(元)</label></th>  
						<th style="width:40px;"><label>操作</label></th>    
					</tr>  
				</thead>  
				<tbody style="border:#dddddd solid 1px;">
				<?php foreach($data as $v){?>
				<tr ><td colspan="4"><?php echo date('Y-m-d H:i:s',$v->time);?><strong style="margin-left:15px;">订单号：<?=$v->id?></strong></td><td class="operation"><?= Html::a("确认付款",['pay/pay', 'id' => $v->id],['class' => 'delete btn btn-xs btn-primary','target'=>'_blank']); ?></td>  </tr>
				<?php foreach($v->orderpackage as $b){?>
					<tr>  
						 
						<td class="goods" style="padding-left:50px;">
						<div class="row">
							<div class="col-md-3" style="margin-left:-35px;">
								<a href="#"><img src="<?php echo Yii::getAlias('@web'); ?>/img<?=$b->package->book->bookimg->localurl?>" style="width:90px;height:120px;" alt=""></a>
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
						<td ><?= $b->package->book['deposit'];?></td>  
						<td ><?= $b->package->book['price'];?></td>  
						<td><?= $b->package->book['price']+$b->package->book['deposit'];?></td>  
						<td></td>
					</tr> 				
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
</div>			</div>