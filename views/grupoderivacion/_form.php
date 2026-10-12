<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Grupoderivacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="grupoderivacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre_grupo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fk_area')->textInput() ?>

    <?= $form->field($model, 'fk_usuario')->textInput() ?>

    <?= $form->field($model, 'fk_regional')->textInput() ?>

    <?= $form->field($model, 'fecha_registro')->textInput() ?>

    <?= $form->field($model, 'hora_registro')->textInput() ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
