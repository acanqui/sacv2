<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InformacionsuicSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="informacionsuic-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_informacion_suic') ?>

    <?= $form->field($model, 'fk_documento_sac') ?>

    <?= $form->field($model, 'nuri') ?>

    <?= $form->field($model, 'fk_regional') ?>

    <?= $form->field($model, 'fk_taller') ?>

    <?php // echo $form->field($model, 'fk_orden_pago') ?>

    <?php // echo $form->field($model, 'fk_usuario') ?>

    <?php // echo $form->field($model, 'fecha_registro') ?>

    <?php // echo $form->field($model, 'hora_registro') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
