<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '首页';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="portfolio">
	<?php $form = ActiveForm::begin([
		'action' => ['book/index'],
		'method' => 'get',
		'id' => 'cateadd-form',
	]); ?>
	<div id="filters_container">
		<form class="sq-home-search-form">
			<div class="sq-home-search">
				<select name="kind" class="search-select" style="background:#C7C7C7; color: #000;">
					<option value=1 <?php if($kind==1){echo "selected='select'";}?>>
						书&nbsp;&nbsp&nbsp;名
					</option>
					<option value=2 <?php if($kind==2){echo "selected='select'";}?>>
						出版社
					</option>
					<option value=3 <?php if($kind==3){echo "selected='select'";}?>>
						作&nbsp;&nbsp;&nbsp;&nbsp;者
					</option>
					<option value=4 <?php if($kind==4){echo "selected='select'";}?>>
						IS&nbsp;&nbsp;&nbsp;BN
					</option>
				</select>
				<input id="search" type="text" placeholder="搜索" name="text"
					   class="" value=<?php echo $text;?>>
				<input  type="text" name="BookSearch[schoolid]" hidden
						value='<?php echo $schoolid;?>' >
				<button class="btn searchBtn"  type="submit">
					<i class="icon-search"></i> 搜索</button>
			</div>
		</form>

	</div>
	<?php ActiveForm::end(); ?>
	<div class="blog-content container">
		<?= ListView::widget([
			'id' => 'postList',
			'dataProvider' => $dataProvider,
			'itemView' => '_view',//子视图
			'layout'=>'{items}{pager}{summary}',
			'pager'=>[
				'maxButtonCount'=>10,
				'nextPageLabel'=>Yii::t('app','下一页'),
				'prevPageLabel'=>Yii::t('app','上一页'),
			],
		]);
		?>
	</div>


	<div id="footer-bottom">
		&copy; 2013 QuickSite. All rights reserved.
	</div>
</div>