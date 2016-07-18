<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PickinfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '取货点管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pickinfo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建取货点', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'layout' => '{items}{pager}{summary}',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'pickaddress',
            'pickpeople',
			[
				'label'=>'学校',  
				'attribute' => 'schoolid',  
				'value' => function ($model) {
				 return $model->school->name;
				},
				'headerOptions' => ['width' => '120'] 
			],
            ['class' => 'yii\grid\ActionColumn',
			'template' => '{view} {update}',
			],
        ],
    ]); ?>

</div>
