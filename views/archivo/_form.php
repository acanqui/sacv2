<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

use app\models\Carpetaarchivo;
use app\models\Archivo;

/* @var $this yii\web\View */
/* @var $model app\models\Archivo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-8" style="border-right: solid grey 0.1em;">
        <div class="archivo-form">

            <?php $form = ActiveForm::begin(); ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? "<span class='glyphicon glyphicon-floppy-disk'></span> Archivar NUR/NURI" : "<span class='glyphicon glyphicon-floppy-disk'></span> Modificar Archivo", ['class' => 'btn btn-primary', 'id'=>'mybotonsave2' ]) ?>
                <?=Html::a("<i class='glyphicon glyphicon-ban-circle'></i> <span style='font-size:9pt;'> Cancelar</span>", ['index'], ['class' => 'btn btn-danger']); ?>
            </div>

            <?= $form->field($model, 'nuri')->textInput(['maxlength' => true, 'readonly'=>true, 'value'=>$model->isNewRecord ? $seguimientos->codigo : $model->nuri]) ?>

            <?= $form->field($model, 'acciones')->textInput(['maxlength' => true])->textarea(['rows' => 2]) ?>

            <?php //= $form->field($model, 'nombre_carpeta')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'fk_carpeta_archivo')->widget(Select2::classname(), [
                                'data'=> \app\models\Archivo::getListCarpetaform(), 
                                'language' => 'es',
                                'options' => ['placeholder' => 'Seleccione carpeta de archivo',  /*'value' => 2,*/],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])->label('Carpeta de archivo'); ?>


            <?php //= $form->field($model, 'fecha_archivo')->textInput() ?>
            <?= $form->field($model, 'fecha_archivo')->textInput()->widget(DatePicker::classname(), [
                                'name' => 'fecha_archivo',
                                'readonly' => true,
                                'options' => ['placeholder' => 'Seleccione fecha ', 
                                              'value'=>$model->isNewRecord ? date('Y-m-d') : Yii::$app->formatter->asDate($model->fecha_archivo, 'yyyy-MM-dd'),
                                             ], //'value' => date('Y-m-d')
                                'pluginOptions' => [
                                                    'autoclose'=>true,
                                                    'format' => 'dd/mm/yyyy']

                                ])->label('Fecha de archivo') ?>

            <?= $form->field($model, 'tipo_tramite')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'observaciones')->textInput(['maxlength' => true])->textarea(['rows' => 2]) ?>

            <?= $form->field($model, 'fk_seguimiento')->hiddenInput(['value'=>$model->isNewRecord ? $seguimientos->id_seguimiento : $model->fk_seguimiento])->label(false) ?>

            <?= $form->field($model, 'oficial')->hiddenInput(['value'=>$model->isNewRecord ? $seguimientos->oficial : $model->oficial])->label(false) ?>

            <?php //= $form->field($model, 'terminado')->textInput() ?>

            <?php //= $form->field($model, 'gestion')->textInput() ?>

            <?php //= $form->field($model, 'fecha_registro')->textInput() ?>

            <?php //= $form->field($model, 'hora_registro')->textInput() ?>

            <?php //= $form->field($model, 'fk_usuario')->textInput() ?>

            <?php //= $form->field($model, 'fk_regional')->textInput() ?>

            <?php //= $form->field($model, 'activo')->textInput() ?>

            <?php //= $form->field($model, 'fk_area')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? "<span class='glyphicon glyphicon-floppy-disk'></span> Archivar NUR/NURI" : "<span class='glyphicon glyphicon-floppy-disk'></span> Modificar Archivo", ['class' => 'btn btn-primary', 'id'=>'mybotonsave2' ]) ?>
                <?=Html::a("<i class='glyphicon glyphicon-ban-circle'></i> <span style='font-size:9pt;'> Cancelar</span>", ['index'], ['class' => 'btn btn-danger']); ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
    <div class="col-md-4" >
        
        <center>
            		<b><u>NUR/NURI</u></b><br>
            		<b style="font-size:22pt;" ><?=$seguimientos->codigo?></b><br>
            		<?php 
            			if ($seguimientos->oficial==1) {
            				echo "<i style='font-size:14pt;' >Original</i>";
            			}
            			else{
            				echo "Copia ".$seguimientos->numero_copia;	
            			}
            		?>
            	</center>

            	<br>
            	<center><b>CITEs asociados al tramite</b></center>
            	<table  class="table table-bordered table-striped">
            	
            	<?php  

            		if ($seguimientos->oficial==1) {
            			$dataReader=Archivo::getListCITEs($seguimientos->codigo);
					    foreach ($dataReader as $row2) { 
					    	?>
					    	<tr>
					    		<td>
					    			<?=$row2['codigo']?>
					    		</td>
					    	</tr>
					    <?php	
					    }//foreach ($dataReader as $row2) { 
            		}
            		else{

            		}	
            	?>
            	</table>	
        
    </div>
</div>     
