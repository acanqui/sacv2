<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegionalesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="regionales-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_regional') ?>

    <?= $form->field($model, 'regional') ?>

    <?= $form->field($model, 'sigla') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'activo') ?>

    <?php // echo $form->field($model, 'id_regional_suic') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
