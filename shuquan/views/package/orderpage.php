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
				<tr ><td colspan="4"><?php echo date('Y-m-d H:i:s',$v->time);?><strong style="margin-left:15px;">订单号：<?=$v->id?></strong></td><td class="operation"><?= Html::a("确认付款",['pay/pay', 'id' => $v->id],['class' => 'delete btn btn-xs btn-primary']); ?></td>  </tr>
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

		</div>