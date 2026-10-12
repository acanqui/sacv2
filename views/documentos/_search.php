<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documentos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_documento') ?>

    <?= $form->field($model, 'codigo') ?>

    <?= $form->field($model, 'destinatario_titulo') ?>

    <?= $form->field($model, 'destinatario_nombres') ?>

    <?= $form->field($model, 'destinatario_cargo') ?>

    <?php // echo $form->field($model, 'destinatario_institucion') ?>

    <?php // echo $form->field($model, 'remitente_nombres') ?>

    <?php // echo $form->field($model, 'remitente_cargo') ?>

    <?php // echo $form->field($model, 'remitente_institucion') ?>

    <?php // echo $form->field($model, 'referencia') ?>

    <?php // echo $form->field($model, 'contenido') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'hora') ?>

    <?php // echo $form->field($model, 'adjuntos') ?>

    <?php // echo $form->field($model, 'copias') ?>

    <?php // echo $form->field($model, 'via_nombres') ?>

    <?php // echo $form->field($model, 'via_cargo') ?>

    <?php // echo $form->field($model, 'nro_hojas') ?>

    <?php // echo $form->field($model, 'gestion') ?>

    <?php // echo $form->field($model, 'fecha_registro') ?>

    <?php // echo $form->field($model, 'hora_registro') ?>

    <?php // echo $form->field($model, 'fk_usuario') ?>

    <?php // echo $form->field($model, 'fk_tipo_documento') ?>

    <?php // echo $form->field($model, 'fk_estado_documento') ?>

    <?php // echo $form->field($model, 'fk_area') ?>

    <?php // echo $form->field($model, 'fk_documento') ?>

    <?php // echo $form->field($model, 'ruta_documento') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <?php // echo $form->field($model, 'usuario_destino') ?>

    <?php // echo $form->field($model, 'grupo_destino') ?>

    <?php // echo $form->field($model, 'nombre_grupo') ?>

    <?php // echo $form->field($model, 'fk_motivo') ?>

    <?php // echo $form->field($model, 'observado') ?>

    <?php // echo $form->field($model, 'enlace_nube') ?>

    <?php // echo $form->field($model, 'fk_regional_suic') ?>

    <?php // echo $form->field($model, 'fk_taller_suic') ?>

    <?php // echo $form->field($model, 'fk_orden_pago_suic') ?>

    <?php // echo $form->field($model, 'carpeta_pago') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
