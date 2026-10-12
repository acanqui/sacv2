<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Niveles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="niveles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nivel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 3])->label('Descripción') ?>

    <?php //= $form->field($model, 'activo')->textInput() ?>

    <div class="form-group">
        <?=Html::submitButton($model->isNewRecord ? "<span class='glyphicon glyphicon-floppy-disk'></span> Guardar Registro" : "<span class='glyphicon glyphicon-floppy-disk'></span> Modificar Registro", ['class' => 'btn btn-primary', 'id'=>'mybotonsave2' ]) ?>
        <?=Html::a("<i class='glyphicon glyphicon-ban-circle'></i> <span style='font-size:9pt;'> Cancelar</span>", ['index'], ['class' => 'btn btn-danger']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
