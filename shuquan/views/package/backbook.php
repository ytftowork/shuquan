<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;  

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
							<?= Html::a("<strong>我的书包</strong>",['/package/index']); ?>|
							<?= Html::a("<strong>待付款订单</strong>",['/package/waitpay']); ?>|
							<?= Html::a("<strong >待收书</strong>",['/package/waitbook']); ?>|
							<?= Html::a("<strong>已收书</strong>",['/package/getbook']); ?>|
							<?= Html::a("<strong class='picked'>已还书</strong>",['/package/backbook']); ?>
								
							</div>	
						</div>

					</div>
				</div>

				<div class="container">
				<div id="gallery_container" style="width:1250px;">
				<?= ListView::widget([  
					'id' => 'postList',
				    'dataProvider' => $dataProvider,  
				    'itemView' => '_backview',//子视图  
					'layout'=>'{items}{pager}',
					'pager'=>[
							'maxButtonCount'=>10,
							'nextPageLabel'=>Yii::t('app','下一页'),
							'prevPageLabel'=>Yii::t('app','上一页'),
					],
				]); 
				?>

					
				</div>
				</div>

