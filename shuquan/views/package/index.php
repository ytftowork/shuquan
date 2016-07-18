<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;  
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PackageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '我的书包';
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
	var checklist = document.getElementsByName ("packageid[]");
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
							<?= Html::a("<strong class='picked'>我的书包</strong>",['/package/index']); ?>|
							<?= Html::a("<strong>待付款订单</strong>",['/package/waitpay']); ?>|
							<?= Html::a("<strong>待收书</strong>",['/package/waitbook']); ?>|
							<?= Html::a("<strong>已收书</strong>",['/package/getbook']); ?>|
							<?= Html::a("<strong>已还书</strong>",['/package/backbook']); ?>
								
							</div>	
						</div>

					</div>
				</div>

		<div class="blog-content container" style="margin-left:1%">
			<table class="table" style="width:65%">  
				<thead>  
					<tr>  
						<th style="width:60px;"><label> <input type="checkbox" onclick="selectAll()" id="controlAll">全选</label></th>  
						<th style="width:200px;"><label>产品信息</label></th>  
						<th style="width:100px;"><label>押金(元)</label></th>  
						<th style="width:120px;"><label>租金(元)</label></th>  
						<th style="width:100px;"><label>应付(元)</label></th>  
						<th style="width:100px;"><label>库存</label></th>  
						<th style="width:40px;"><label>操作</label></th>    
					</tr>  
				</thead>  
				<tbody style="border:#dddddd solid 1px;">
				<?php $form = ActiveForm::begin([  
			'action' => ['package/alipay'], //提交地址(*可省略*)  
			'method'=>'post',    //提交方法(*可省略默认POST*)  
			'id' => 'login-form', //设置ID属性  
			'options' => [  
					'class' => 'form-horizontal', //设置class属性  
			],  
		]); ?> 
	<?php foreach($data as $v){?>
			<tr style="background-color:;">  
						<td ><input class="check-one check" type="checkbox" name="packageid[]" value=<?= $v->id;?> onclick="change();"/> </td>  
						<td class="goods">
						<div class="row">
							<div class="col-md-3" style="margin-left:-35px;">
								<a href="#"><img src="<?php echo Yii::getAlias('@web'); ?>/img<?= $v->book->bookimg['localurl'];?>" style="width:90px;height:120px;" alt=""></a>
							</div>
							<div class="col-md-9">
								<h4><strong><?= $v->book['bookname'];?></strong></h4>
								<div class="blog-post-metadata">
									<div class="book">作&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp者：<strong><?= $v->book['author'];?></strong></div>
									<div class="book">出&nbsp&nbsp&nbsp&nbsp版社：<strong><?= $v->book['publishing'];?></strong></div>
									<div class="book">IS&nbsp&nbsp&nbsp&nbsp&nbsp&nbspBN：<strong><?= $v->book['isbn'];?></strong></div>
								</div>
							</div>
						</div>
						</td>  
						<td class="number small-bold-red"><?= $v->book['deposit'];?></td>  
						<td class="subtotal number small-bold-red"><?= $v->book['price'];?></td>  
						<td class="subtotal number small-bold-red"><?= $v->book['price']+$v->book['deposit'];?></td>  
						<td class="subtotal number small-bold-red"><?= $v->book['number'];?></td>  
						<td class="operation"><?= Html::a("删除",['package/delete', 'id' => $v->id],['class' => 'delete btn btn-xs btn-primary']); ?></td>  
					</tr>  
	<?php }?>	

					
				</tbody>  
			</table>  
  
				<div class="navbar-fixed-bottom" style="margin-left:12%;width:55%;border:1px solid #808080;background-color:#C7C7C7;">  
					<div class="col-md-12 col-lg-12 col-sm-12"> 
						<div style="margin-left:20px;" class="pull-left total">  
								<label>已选择书籍:<span class="text-danger" id="count">0</span>本</label>  
						</div>  
						<div style="margin-left:20px;" class="pull-left total">  
							<label>租金:<span class="currency">￥</span><span class="text-danger" id="price">0.00</span>元</label>  
						</div>  
						<div style="margin-left:20px;" class="pull-left total">  
							<label>押金:<span class="currency">￥</span><span id="deposit">0.00</span>元</label>  
						</div>  
						<div style="margin-left:20px;" class="pull-left total">  
							<label>合计:<span class="currency">￥</span><span id="totalprice">0.00</span>元</label>  
						</div> 
					</div>
						<div class="pull-right">  
							<button type="submit" class="btn btn-danger ">结算</button> 
						</div>  					
				</div>  
			</div>
<?php ActiveForm::end();?>  