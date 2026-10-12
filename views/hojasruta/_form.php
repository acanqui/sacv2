<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Hojasruta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hojasruta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nur')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nro')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'hora')->textInput() ?>

    <?= $form->field($model, 'proceso')->textInput() ?>

    <?= $form->field($model, 'fecha_registro')->textInput() ?>

    <?= $form->field($model, 'hora_registro')->textInput() ?>

    <?= $form->field($model, 'fk_usuario')->textInput() ?>

    <?= $form->field($model, 'gestion')->textInput() ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <?= $form->field($model, 'fk_documento')->textInput() ?>

    <?= $form->field($model, 'oficial')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
