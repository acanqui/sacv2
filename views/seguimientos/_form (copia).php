<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Seguimientos;

//use yii\bootstrap\Modal;

 use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model app\models\Seguimientos */
/* @var $form yii\widgets\ActiveForm */


?>


<div class="row">
    <div class="col-md-12">
        <div class="card-body">
          <center> 
            <h5 style="color:#0B4C5F;" ><i class="glyphicon glyphicon-floppy-disk" style="font-size:20pt;" ></i>&nbsp;
                <b><u style="font-size: 15pt;">Modificar prove&iacute;do o destino</u></b><br><br>
                <b style="font-size: 14pt;"><?=$model->getMostrarCodigo($model->oficial, $model->codigo, $model->numero_copia)?></b>
            </h5>
          </center>       
        </div>
    </div>
    
</div>



<div class="row" style="margin-left: 40px;">
    <div class="col-md-8">
        <div class="card-body">
            
            <div class="seguimientos-form">

                <?php $form = ActiveForm::begin(); ?>

                <?php /*= $form->field($model, 'derivado_a')->widget(Select2::classname(), [
                        'data'=> Seguimientos::getListDestino(),

                                    'language' => 'es',
                                    'options' => ['placeholder' => 'Seleccione destinatario'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                ])->label('Derivado a:');*/ ?> 
                
                <?=$form->field($model, 'derivado_a')->dropDownList(Seguimientos::getListDestino(),['prompt'=>'Seleccione destinatario'])->label('Derivar a:'); ?>
                
                <?php //=$form->field($model, 'derivado_a')->dropDownList(['1' => 'Yes', '0' => 'No'],['prompt'=>'Select Option']);?>
                

                <?= $form->field($model, 'proveido')->textarea(['rows' => 3])->label('Proveído') ?>


                <div class="form-group">
                    <?= Html::submitButton('<i class="glyphicon glyphicon-floppy-disk" style="font-size:10pt;" ></i> <b>Guardar Modificación</b>', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
         
        </div>
    </div>
    
</div>



