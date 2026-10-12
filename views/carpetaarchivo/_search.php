<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CarpetaarchivoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carpetaarchivo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_carpeta_archivo') ?>

    <?= $form->field($model, 'nombre_carpeta') ?>

    <?= $form->field($model, 'fk_area') ?>

    <?= $form->field($model, 'fk_usuario') ?>

    <?= $form->field($model, 'fecha_registro') ?>

    <?php // echo $form->field($model, 'hora_registro') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
