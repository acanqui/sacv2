<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ArchivadosdigitalesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="archivadosdigitales-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_archivado_digital') ?>

    <?= $form->field($model, 'codigo') ?>

    <?= $form->field($model, 'fecha_archivo') ?>

    <?= $form->field($model, 'hora_archivo') ?>

    <?= $form->field($model, 'lugar') ?>

    <?php // echo $form->field($model, 'observaciones') ?>

    <?php // echo $form->field($model, 'fk_usuario') ?>

    <?php // echo $form->field($model, 'fk_seguimiento') ?>

    <?php // echo $form->field($model, 'fecha_registro') ?>

    <?php // echo $form->field($model, 'hora_registro') ?>

    <?php // echo $form->field($model, 'gestion') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <?php // echo $form->field($model, 'fk_regional') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
