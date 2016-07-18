<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pickinfo */

$this->title = '修改取货地点: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pickinfos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pickinfo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'school' => $school,
    ]) ?>

</div>
