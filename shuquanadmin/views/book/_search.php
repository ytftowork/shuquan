<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BookSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'bookname') ?>

    <?= $form->field($model, 'author') ?>

    <?= $form->field($model, 'publishing') ?>

    <?= $form->field($model, 'publictime') ?>

    <?php // echo $form->field($model, 'printtime') ?>

    <?php // echo $form->field($model, 'printrun') ?>

    <?php // echo $form->field($model, 'binding') ?>

    <?php // echo $form->field($model, 'edition') ?>

    <?php // echo $form->field($model, 'booksize') ?>

    <?php // echo $form->field($model, 'pagenumber') ?>

    <?php // echo $form->field($model, 'wordnumber') ?>

    <?php // echo $form->field($model, 'isbn') ?>

    <?php // echo $form->field($model, 'info') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'deposit') ?>

    <?php // echo $form->field($model, 'oldprice') ?>

    <?php // echo $form->field($model, 'schoolid') ?>

    <?php // echo $form->field($model, 'isshow') ?>

    <?php // echo $form->field($model, 'number') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
