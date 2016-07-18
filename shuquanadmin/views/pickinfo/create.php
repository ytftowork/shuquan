<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pickinfo */

$this->title = '创建取货地点';
$this->params['breadcrumbs'][] = ['label' => 'Pickinfos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pickinfo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'school' => $school,
    ]) ?>

</div>
