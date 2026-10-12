<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Institucionremitente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="institucionremitente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'institucion_remitente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <?= $form->field($model, 'nombre_remitente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cargo_remitente')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
