<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Derivaciontemporal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="derivaciontemporal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fk_seguimiento')->textInput() ?>

    <?= $form->field($model, 'nuri')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fk_usuario')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
