<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsuariosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_usuario') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'cargo') ?>

    <?= $form->field($model, 'usuario') ?>

    <?= $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'correo') ?>

    <?php // echo $form->field($model, 'mosca') ?>

    <?php // echo $form->field($model, 'fk_perfil') ?>

    <?php // echo $form->field($model, 'fk_regional') ?>

    <?php // echo $form->field($model, 'fk_area') ?>

    <?php // echo $form->field($model, 'fk_nivel') ?>

    <?php // echo $form->field($model, 'fecha_registro') ?>

    <?php // echo $form->field($model, 'hora_registro') ?>

    <?php // echo $form->field($model, 'update_password') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <?php // echo $form->field($model, 'area_sad') ?>

    <?php // echo $form->field($model, 'usuario_archivo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
