<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->title = '添加书籍';
$this->params['breadcrumbs'][] = ['label' => '书籍管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'school' => $school,
		'file' => $file,
    ]) ?>

</div>
