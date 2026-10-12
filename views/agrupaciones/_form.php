<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Agrupaciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agrupaciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nur_padre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nur_hijo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oficial')->textInput() ?>

    <?= $form->field($model, 'fk_seguimiento_padre')->textInput() ?>

    <?= $form->field($model, 'fk_seguimiento_hijo')->textInput() ?>

    <?= $form->field($model, 'fk_usuario')->textInput() ?>

    <?= $form->field($model, 'fecha_registro')->textInput() ?>

    <?= $form->field($model, 'hora_registro')->textInput() ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
