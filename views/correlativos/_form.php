<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Correlativos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="correlativos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'correlativo')->textInput() ?>

    <?= $form->field($model, 'gestion')->textInput() ?>

    <?= $form->field($model, 'fk_correlativo')->textInput() ?>

    <?= $form->field($model, 'fk_area')->textInput() ?>

    <?= $form->field($model, 'fk_regional')->textInput() ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <?= $form->field($model, 'fk_tipo_documento')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
