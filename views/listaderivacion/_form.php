<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Listaderivacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="listaderivacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <?= $form->field($model, 'usuario_origen')->textInput() ?>

    <?= $form->field($model, 'usuario_destino')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
