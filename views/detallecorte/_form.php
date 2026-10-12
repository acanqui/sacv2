<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Detallecorte */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detallecorte-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'derivado_por')->textInput() ?>

    <?= $form->field($model, 'derivado_a')->textInput() ?>

    <?= $form->field($model, 'proveido')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fecha_derivacion')->textInput() ?>

    <?= $form->field($model, 'hora_derivacion')->textInput() ?>

    <?= $form->field($model, 'fecha_recepcion')->textInput() ?>

    <?= $form->field($model, 'hora_recepcion')->textInput() ?>

    <?= $form->field($model, 'fk_accion')->textInput() ?>

    <?= $form->field($model, 'fk_estado')->textInput() ?>

    <?= $form->field($model, 'padre')->textInput() ?>

    <?= $form->field($model, 'oficial')->textInput() ?>

    <?= $form->field($model, 'hijo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_registro')->textInput() ?>

    <?= $form->field($model, 'hora_registro')->textInput() ?>

    <?= $form->field($model, 'gestion')->textInput() ?>

    <?= $form->field($model, 'confirmado')->textInput() ?>

    <?= $form->field($model, 'fk_corte')->textInput() ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
