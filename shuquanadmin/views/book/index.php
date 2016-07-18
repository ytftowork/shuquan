<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '书籍列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加书籍', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'layout' => '{items}{pager}{summary}',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'bookname',
            'author',
            // 'publishing',
            // 'publictime',
            // 'printtime',
            // 'printrun',
            // 'binding',
            // 'edition',
            // 'booksize',
            // 'pagenumber',
            // 'wordnumber',
            'isbn',
            // 'info:ntext',
            // 'price',
            // 'deposit',
            // 'oldprice',
            // 'schoolid',
          //  'isshow',
            'number',
			[
				'label'=>'是否显示',  
				'attribute' => 'isshow',  
				'value' => function ($model) {
					$state = [
						'1' => '显示',
						'0' => '不显示',
					];
				 return $state[$model->isshow];
				},
				'headerOptions' => ['width' => '120'] 
			],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
