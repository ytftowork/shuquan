<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pickinfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pickinfo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pickaddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pickpeople')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'schoolid')->dropDownList($school) ?>

   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
