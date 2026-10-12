<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CorrelativosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="correlativos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_correlativo') ?>

    <?= $form->field($model, 'correlativo') ?>

    <?= $form->field($model, 'gestion') ?>

    <?= $form->field($model, 'fk_correlativo') ?>

    <?= $form->field($model, 'fk_area') ?>

    <?php // echo $form->field($model, 'fk_regional') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <?php // echo $form->field($model, 'fk_tipo_documento') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
