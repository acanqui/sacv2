<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Regionales;
use app\models\Areas;

/* @var $this yii\web\View */
/* @var $model app\models\Areas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="areas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'area')->textInput(['maxlength' => true])->label('Área/Unidad') ?>

    <?= $form->field($model, 'sigla')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cite')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'dependencia')->textInput() ?>
    <?= $form->field($model, 'dependencia')->widget(Select2::classname(), [
                                'data'=> ArrayHelper::map(Areas::find()->where(['dependencia'=>0])->all(), 'id_area', 'area'),
                                'language' => 'es',
                                'options' => ['placeholder' => 'Seleccione Unidad'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])-> label('Oficina Área'); ?>

    <?php //= $form->field($model, 'fk_regional')->textInput() ?>
    <?= $form->field($model, 'fk_regional')->widget(Select2::classname(), [
                                'data'=> ArrayHelper::map(Regionales::find()->all(), 'id_regional', 'regional'),
                                'language' => 'es',
                                'options' => ['placeholder' => 'Seleccione Oficina Regional'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])-> label('Oficina Regional'); ?>
    
    <?= $form->field($model, 'descripcion')->textarea(['rows' => 3])->label('Descripción') ?>

    <?php //= $form->field($model, 'activo')->textInput() ?>

    <?php //= $form->field($model, 'carta')->textInput() ?>

    <?php //= $form->field($model, 'circular')->textInput() ?>

    <?php //= $form->field($model, 'informe')->textInput() ?>

    <?php //= $form->field($model, 'instructivo')->textInput() ?>

    <?php //= $form->field($model, 'memorandum')->textInput() ?>

    <?php //= $form->field($model, 'nota')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? "<span class='glyphicon glyphicon-floppy-disk'></span> Guardar Registro" : "<span class='glyphicon glyphicon-floppy-disk'></span> Modificar Registro", ['class' => 'btn btn-primary', 'id'=>'mybotonsave2' ]) ?>
        <?=Html::a("<i class='glyphicon glyphicon-ban-circle'></i> <span style='font-size:9pt;'> Cancelar</span>", ['index'], ['class' => 'btn btn-danger']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
