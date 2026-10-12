<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GrupoderivacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="grupoderivacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_grupo_derivacion') ?>

    <?= $form->field($model, 'nombre_grupo') ?>

    <?= $form->field($model, 'fk_area') ?>

    <?= $form->field($model, 'fk_usuario') ?>

    <?= $form->field($model, 'fk_regional') ?>

    <?php // echo $form->field($model, 'fecha_registro') ?>

    <?php // echo $form->field($model, 'hora_registro') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
