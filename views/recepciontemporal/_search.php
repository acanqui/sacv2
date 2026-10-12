<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RecepciontemporalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recepciontemporal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_recepcion_temporal') ?>

    <?= $form->field($model, 'fk_seguimiento') ?>

    <?= $form->field($model, 'nuri') ?>

    <?= $form->field($model, 'fk_usuario') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
