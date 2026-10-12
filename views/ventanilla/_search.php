<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VentanillaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ventanilla-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_ventanilla') ?>

    <?= $form->field($model, 'correlativo') ?>

    <?= $form->field($model, 'gestion') ?>

    <?= $form->field($model, 'fk_usuario') ?>

    <?= $form->field($model, 'activo') ?>

    <?php // echo $form->field($model, 'fk_regional') ?>

    <?php // echo $form->field($model, 'sigla') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
