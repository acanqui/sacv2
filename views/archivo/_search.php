<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ArchivoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="archivo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_archivo') ?>

    <?= $form->field($model, 'nuri') ?>

    <?= $form->field($model, 'acciones') ?>

    <?= $form->field($model, 'nombre_carpeta') ?>

    <?= $form->field($model, 'fecha_archivo') ?>

    <?php // echo $form->field($model, 'tipo_tramite') ?>

    <?php // echo $form->field($model, 'observaciones') ?>

    <?php // echo $form->field($model, 'terminado') ?>

    <?php // echo $form->field($model, 'gestion') ?>

    <?php // echo $form->field($model, 'fecha_registro') ?>

    <?php // echo $form->field($model, 'hora_registro') ?>

    <?php // echo $form->field($model, 'fk_usuario') ?>

    <?php // echo $form->field($model, 'fk_seguimiento') ?>

    <?php // echo $form->field($model, 'fk_regional') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <?php // echo $form->field($model, 'oficial') ?>

    <?php // echo $form->field($model, 'fk_area') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
