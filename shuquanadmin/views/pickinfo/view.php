<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pickinfo */

$this->title = "查看详情".$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pickinfos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pickinfo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
       
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'pickaddress',
            'pickpeople',
			 [
				'attribute' => 'schoolid',  
				'value' => $model->school->name,
			],
        ],
    ]) ?>

</div>
