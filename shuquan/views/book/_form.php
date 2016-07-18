<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bookname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'publishing')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'publictime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'printtime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'printrun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'binding')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'edition')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'booksize')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pagenumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wordnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'deposit')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
