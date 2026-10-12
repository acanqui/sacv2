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

<?php
//$this->title = 'Create Archivo';
$this->params['breadcrumbs'][] = ['label' => 'Archivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Archivar NUR/NURI '. $seguimientos->codigo;
?>

<div class="row">
    <div class="col-md-8">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="fa fa-archive" style="font-size:25pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 18pt;">Archivar tr&aacute;mite <?=$seguimientos->codigo?></u></b><br><br><br>
              
              <?php $carpetas = Carpetaarchivo::findOne($id_carpeta);     ?>
              <center>
                <b><span style="font-size: 15pt;">Carpeta: <?=$carpetas->nombre_carpeta?></span></b>
              </center>
          </h5>
        </div>
    </div>
    
</div>
<hr>

<div class="row">
    <div class="col-md-8" style="border-right: solid grey 0.1em;">
        <div class="archivo-form">

            <?php $form = ActiveForm::begin(); ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? "<span class='glyphicon glyphicon-floppy-disk'></span> Archivar NUR/NURI" : "<span class='glyphicon glyphicon-floppy-disk'></span> Modificar Archivo", ['class' => 'btn btn-primary', 'id'=>'mybotonsave2' ]) ?>
                <?=Html::a("<i class='glyphicon glyphicon-ban-circle'></i> <span style='font-size:9pt;'> Cancelar</span>", ['seguimientos/pendientesoficiales'], ['class' => 'btn btn-danger']); ?>
            </div>

            <?= $form->field($model, 'nuri')->textInput(['maxlength' => true, 'readonly'=>true, 'value'=>$model->isNewRecord ? $seguimientos->codigo : $model->nuri]) ?>

            <?= $form->field($model, 'acciones')->textInput(['maxlength' => true])->textarea(['rows' => 2]) ?>

            <?= $form->field($model, 'nombre_carpeta')->hiddenInput(['value' => $id_carpeta])->label(false) ?>

            <?php //= $form->field($model, 'fecha_archivo')->textInput() ?>
            <?= $form->field($model, 'fecha_archivo')->textInput()->widget(DatePicker::classname(), [
                                'name' => 'fecha_archivo',
                                'readonly' => true,
                                'options' => ['placeholder' => 'Seleccione fecha ', 
                                              'value'=>$model->isNewRecord ? date('Y-m-d') : Yii::$app->formatter->asDate($model->fecha_archivo, 'yyyy-MM-dd'),
                                             ], //'value' => date('Y-m-d')
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                    'startDate' =>date("Y-m-d"),
                                    'format' => 'yyyy-mm-dd']

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
                <?=Html::a("<i class='glyphicon glyphicon-ban-circle'></i> <span style='font-size:9pt;'> Cancelar</span>", ['seguimientos/pendientesoficiales'], ['class' => 'btn btn-danger']); ?>
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
