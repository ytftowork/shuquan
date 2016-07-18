<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->title = '修改: ' . ' ' . $model->bookname;
$this->params['breadcrumbs'][] = ['label' => '书籍管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bookname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="book-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		 'school' => $school,
		 'file' => $file,
    ]) ?>

</div>
