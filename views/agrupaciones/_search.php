<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AgrupacionesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agrupaciones-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_agrupacion') ?>

    <?= $form->field($model, 'nur_padre') ?>

    <?= $form->field($model, 'nur_hijo') ?>

    <?= $form->field($model, 'oficial') ?>

    <?= $form->field($model, 'fk_seguimiento_padre') ?>

    <?php // echo $form->field($model, 'fk_seguimiento_hijo') ?>

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
