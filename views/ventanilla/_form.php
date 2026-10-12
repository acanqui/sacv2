<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ventanilla */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ventanilla-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'correlativo')->textInput() ?>

    <?= $form->field($model, 'gestion')->textInput() ?>

    <?= $form->field($model, 'fk_usuario')->textInput() ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <?= $form->field($model, 'fk_regional')->textInput() ?>

    <?= $form->field($model, 'sigla')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
