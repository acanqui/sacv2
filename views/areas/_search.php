<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AreasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="areas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_area') ?>

    <?= $form->field($model, 'area') ?>

    <?= $form->field($model, 'sigla') ?>

    <?= $form->field($model, 'cite') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'dependencia') ?>

    <?php // echo $form->field($model, 'fk_regional') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <?php // echo $form->field($model, 'carta') ?>

    <?php // echo $form->field($model, 'circular') ?>

    <?php // echo $form->field($model, 'informe') ?>

    <?php // echo $form->field($model, 'instructivo') ?>

    <?php // echo $form->field($model, 'memorandum') ?>

    <?php // echo $form->field($model, 'nota') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
