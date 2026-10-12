<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Hojasruta;

/* @var $this yii\web\View */
/* @var $model app\models\Hojasruta */
/* @var $form yii\widgets\ActiveForm */

//echo "------------__> ".$documentos->id_documento;

?>
<div class="row">
        <div class="col-md-12">
            <div class="card-body">
              <center>
                <h5 style="color:#0B4C5F;" > 
                    <b><span style="font-size: 15pt;"><i style='font-size:13pt;' class='glyphicon glyphicon-list'></i> <b>Asingar NUR/NURI pendiente</b></span></b>
                </h5>
              </center>    
            </div>
        </div>
</div>    
<div class="hojasruta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //=$form->field($model, 'nur')->textInput(['maxlength' => true]) ?>
   
            
    <?php //= $form->field($model, 'nro')->hiddenInput(['value'=>0])->label(false) ?>
    <?=$form->field($model, 'nro')->dropDownList(Hojasruta::getListNuriPendiente(),['prompt'=>'Seleccione'])->label('Seleccione NUR/NURI pendiente:'); ?>
   
    <?= $form->field($model, 'codigo')->hiddenInput(['maxlength' => true, 'value'=>$documentos->codigo])->label(false) ?> 

    <?= $form->field($model, 'fecha')->hiddenInput(['value'=>date('Y-m-d')])->label(false) ?>

    <?= $form->field($model, 'hora')->hiddenInput(['value'=>date('H:i:s')])->label(false) ?>

    <?= $form->field($model, 'proceso')->hiddenInput(['value'=>0])->label(false) ?>

    <?= $form->field($model, 'fecha_registro')->hiddenInput(['value'=>date('Y-m-d')])->label(false) ?>

    <?= $form->field($model, 'hora_registro')->hiddenInput(['value'=>date('H:i:s')])->label(false) ?>

    <?= $form->field($model, 'fk_usuario')->hiddenInput(['value'=>Yii::$app->user->identity->id_usuario])->label(false) ?>

    <?= $form->field($model, 'gestion')->hiddenInput(['value'=>date('Y')])->label(false) ?>

    <?= $form->field($model, 'activo')->hiddenInput(['value'=>1])->label(false) ?>

    <?= $form->field($model, 'fk_documento')->hiddenInput(['value'=>$documentos->id_documento])->label(false) ?>

    <?php //= $form->field($model, 'oficial')->hiddenInput(['value'=>1])->label(false) ?>

    <div class="form-group">
        <?php //= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::submitButton($model->isNewRecord ? "<span class='glyphicon glyphicon-floppy-disk'></span> Asignar pendiente" : "<span class='glyphicon glyphicon-floppy-disk'></span> Asignar pendiente", ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
