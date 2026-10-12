<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ListaderivacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="listaderivacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_lista_derivacion') ?>

    <?= $form->field($model, 'activo') ?>

    <?= $form->field($model, 'usuario_origen') ?>

    <?= $form->field($model, 'usuario_destino') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
