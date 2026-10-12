<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Perfiles;
use app\models\Niveles;
use app\models\Areas;
use app\models\Regionales;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>

<div class="row">
  <div class="col-md-10">
      <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? "<span class='glyphicon glyphicon-floppy-disk'></span> Guardar Usuario" : "<span class='glyphicon glyphicon-floppy-disk'></span> Modificar Usuario", ['class' => 'btn btn-primary', 'id'=>'mybotonsave2' ]) ?>
        <?=Html::a("<i class='glyphicon glyphicon-ban-circle'></i> <span style='font-size:9pt;'> Cancelar</span>", ['usuarios/index'], ['class' => 'btn btn-danger']); ?>
    </div>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cargo')->textInput(['maxlength' => true]) ?>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
      <?= $form->field($model, 'usuario')->textInput(['maxlength' => true])->label('Usuario (La contraseña asignada por defecto es: qwerty )') ?>
  </div>
  <div class="col-md-5">
      <?= $form->field($model, 'mosca')->textInput(['maxlength' => true]) ?>
  </div>  
</div>

<div class="row">
  <div class="col-md-10">
      
      <?php //= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    <?php //= $form->field($model, 'correo')->textInput(['maxlength' => true]) ?>
    <?php //= $form->field($model, 'fk_perfil')->textInput() ?>
    
    <?= $form->field($model, 'fk_perfil')->widget(Select2::classname(), [
                                'data'=> ArrayHelper::map(Perfiles::find()->all(), 'id_perfil', 'perfil'),
                                'language' => 'es',
                                'options' => ['placeholder' => 'Seleccione Perfil de usuario'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])-> label('Perfil de usuario'); ?>

    <?php //= $form->field($model, 'fk_regional')->textInput() ?>
    <?= $form->field($model, 'fk_regional')->widget(Select2::classname(), [
                                'data'=> ArrayHelper::map(Regionales::find()->all(), 'id_regional', 'regional'),
                                'language' => 'es',
                                'options' => ['placeholder' => 'Seleccione Oficina Regional'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])-> label('Oficina Regional'); ?>

    <?php //= $form->field($model, 'fk_area')->textInput() ?>
    <?= $form->field($model, 'fk_area')->widget(Select2::classname(), [
                                'data'=> ArrayHelper::map(Areas::find()->all(), 'id_area', 'area'),
                                'language' => 'es',
                                'options' => ['placeholder' => 'Seleccione Area/Unidad'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])-> label('Area/Unidad Organizacional'); ?>

    <?php //= $form->field($model, 'fk_nivel')->textInput() ?>
    <?= $form->field($model, 'fk_nivel')->widget(Select2::classname(), [
                                'data'=> ArrayHelper::map(Niveles::find()->all(), 'id_nivel', 'nivel'),
                                'language' => 'es',
                                'options' => ['placeholder' => 'Seleccione nivel de usuario'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])-> label('Nivel de usuario'); ?>

    <?php //= $form->field($model, 'fecha_registro')->textInput() ?>

    <?php //= $form->field($model, 'hora_registro')->textInput() ?>

    <?php //= $form->field($model, 'update_password')->textInput() ?>

    <?php //= $form->field($model, 'activo')->textInput() ?>

    <?php //= $form->field($model, 'area_sad')->textInput() ?>
    
    <?= $form->field($model, 'area_sad')->widget(Select2::classname(), [
                                'data'=> [1=>'Archivo habilitado', 0=>'Archivo deshabilitado'],
                                'language' => 'es',
                                'options' => ['placeholder' => 'Seleccione', 'value' => $model->isNewRecord ? 0: $model->area_sad,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])->label('Archivo'); ?>

    <?php //= $form->field($model, 'usuario_archivo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? "<span class='glyphicon glyphicon-floppy-disk'></span> Guardar Usuario" : "<span class='glyphicon glyphicon-floppy-disk'></span> Modificar Usuario", ['class' => 'btn btn-primary', 'id'=>'mybotonsave2' ]) ?>
        <?=Html::a("<i class='glyphicon glyphicon-ban-circle'></i> <span style='font-size:9pt;'> Cancelar</span>", ['usuarios/index'], ['class' => 'btn btn-danger']); ?>
    </div>
  </div>
</div>

<?php ActiveForm::end(); ?>


