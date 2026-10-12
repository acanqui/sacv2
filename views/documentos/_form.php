<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Documentos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documentos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'destinatario_titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'destinatario_nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'destinatario_cargo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'destinatario_institucion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remitente_nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remitente_cargo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remitente_institucion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'referencia')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'contenido')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'hora')->textInput() ?>

    <?= $form->field($model, 'adjuntos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'copias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'via_nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'via_cargo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nro_hojas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gestion')->textInput() ?>

    <?= $form->field($model, 'fecha_registro')->textInput() ?>

    <?= $form->field($model, 'hora_registro')->textInput() ?>

    <?= $form->field($model, 'fk_usuario')->textInput() ?>

    <?= $form->field($model, 'fk_tipo_documento')->textInput() ?>

    <?= $form->field($model, 'fk_estado_documento')->textInput() ?>

    <?= $form->field($model, 'fk_area')->textInput() ?>

    <?= $form->field($model, 'fk_documento')->textInput() ?>

    <?= $form->field($model, 'ruta_documento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <?= $form->field($model, 'usuario_destino')->textInput() ?>

    <?= $form->field($model, 'grupo_destino')->textInput() ?>

    <?= $form->field($model, 'nombre_grupo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fk_motivo')->textInput() ?>

    <?= $form->field($model, 'observado')->textInput() ?>

    <?= $form->field($model, 'enlace_nube')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fk_regional_suic')->textInput() ?>

    <?= $form->field($model, 'fk_taller_suic')->textInput() ?>

    <?= $form->field($model, 'fk_orden_pago_suic')->textInput() ?>

    <?= $form->field($model, 'carpeta_pago')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
