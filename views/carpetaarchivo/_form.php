<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Carpetaarchivo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carpetaarchivo-form" style="width: 80%;">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre_carpeta')->textInput() ?>

    <?php //= $form->field($model, 'fk_area')->textInput() ?>

    <?php //= $form->field($model, 'fk_usuario')->textInput() ?>

    <?php //= $form->field($model, 'fecha_registro')->textInput() ?>

    <?php //= $form->field($model, 'hora_registro')->textInput() ?>

    <?php //= $form->field($model, 'activo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? "<span class='glyphicon glyphicon-floppy-disk'></span> Guardar Registro" : "<span class='glyphicon glyphicon-floppy-disk'></span> Modificar Registro", ['class' => 'btn btn-primary', 'id'=>'mybotonsave2' ]) ?>
        <?=Html::a("<i class='glyphicon glyphicon-ban-circle'></i> <span style='font-size:9pt;'> Cancelar</span>", ['index'], ['class' => 'btn btn-danger']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
