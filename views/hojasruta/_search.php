<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HojasrutaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hojasruta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_hoja_ruta') ?>

    <?= $form->field($model, 'nur') ?>

    <?= $form->field($model, 'codigo') ?>

    <?= $form->field($model, 'nro') ?>

    <?= $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'hora') ?>

    <?php // echo $form->field($model, 'proceso') ?>

    <?php // echo $form->field($model, 'fecha_registro') ?>

    <?php // echo $form->field($model, 'hora_registro') ?>

    <?php // echo $form->field($model, 'fk_usuario') ?>

    <?php // echo $form->field($model, 'gestion') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <?php // echo $form->field($model, 'fk_documento') ?>

    <?php // echo $form->field($model, 'oficial') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
