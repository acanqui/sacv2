<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SeguimientosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seguimientos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_seguimiento') ?>

    <?= $form->field($model, 'codigo') ?>

    <?= $form->field($model, 'derivado_por') ?>

    <?= $form->field($model, 'derivado_a') ?>

    <?= $form->field($model, 'proveido') ?>

    <?php // echo $form->field($model, 'fecha_derivacion') ?>

    <?php // echo $form->field($model, 'hora_derivacion') ?>

    <?php // echo $form->field($model, 'fecha_recepcion') ?>

    <?php // echo $form->field($model, 'hora_recepcion') ?>

    <?php // echo $form->field($model, 'fk_accion') ?>

    <?php // echo $form->field($model, 'fk_estado') ?>

    <?php // echo $form->field($model, 'padre') ?>

    <?php // echo $form->field($model, 'oficial') ?>

    <?php // echo $form->field($model, 'hijo') ?>

    <?php // echo $form->field($model, 'fecha_registro') ?>

    <?php // echo $form->field($model, 'hora_registro') ?>

    <?php // echo $form->field($model, 'gestion') ?>

    <?php // echo $form->field($model, 'confirmado') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <?php // echo $form->field($model, 'fk_grupo_derivacion') ?>

    <?php // echo $form->field($model, 'fk_principal_agrupacion') ?>

    <?php // echo $form->field($model, 'numero_copia') ?>

    <?php // echo $form->field($model, 'observado') ?>

    <?php // echo $form->field($model, 'accion_archivo') ?>

    <?php // echo $form->field($model, 'correlativo_copia') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
