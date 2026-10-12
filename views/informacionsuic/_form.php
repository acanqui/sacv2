<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Informacionsuic */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="informacionsuic-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fk_documento_sac')->textInput() ?>

    <?= $form->field($model, 'nuri')->textInput() ?>

    <?= $form->field($model, 'fk_regional')->textInput() ?>

    <?= $form->field($model, 'fk_taller')->textInput() ?>

    <?= $form->field($model, 'fk_orden_pago')->textInput() ?>

    <?= $form->field($model, 'fk_usuario')->textInput() ?>

    <?= $form->field($model, 'fecha_registro')->textInput() ?>

    <?= $form->field($model, 'hora_registro')->textInput() ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
