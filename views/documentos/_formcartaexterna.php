<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
//use kartik\file\FileInput;



use app\models\Estadodocumento;
use app\models\Documentos;
use app\models\Usuarios;
use app\models\Listaderivacion;


use kartik\editors\Summernote;



/* @var $this yii\web\View */
/* @var $model app\models\Documentos */
/* @var $form yii\widgets\ActiveForm */

//use edwinhaq\simpleloading\SimpleLoading;
//SimpleLoading::widget();


//use toriphes\lazyload\LazyLoad;
//echo LazyLoad::widget(['src' => 'url/to/your/carpetas.png']);

?>
<script src="<?=Yii::$app->request->baseUrl; ?>/js/jquery.js"></script>

<script type="text/javascript">

function destinatario(valor1, valor2){	

	$("#documentos-destinatario_nombres").val(valor1);
	$("#documentos-destinatario_cargo").val(valor2);
	//$("#usuario_destino").val(valor3);
}

</script>

<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          
        </div>
    </div>
    <div class="col-md-6">
        <!--<div class="card-body" >
          <p style="color:#0B2F3A">
          Opcionalmente, puede ingresar un operador de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> o <b>=</b>) al comienzo de cada uno de sus valores de búsqueda para especificar cómo se debe hacer la comparación.
          </p>
        </div>-->
    </div>
</div>


<?php $form = ActiveForm::begin([
                //"method" => "post",
                //"enableClientValidation" => true,
               // 'enableAjaxValidation'=>false,
                'options'=>['enctype'=>'multipart/form-data'] // important
            ]); ?>
<div class="row">
 <div class="col-md-6">
            
            
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? "<span class='glyphicon glyphicon-floppy-disk'></span> Guardar Documento" : "<span class='glyphicon glyphicon-floppy-disk'></span> Modificar Documento", ['class' => 'btn btn-primary', 'id'=>'mybotonsave']) ?>
                <?=Html::a("<i class='glyphicon glyphicon-ban-circle'></i> <span style='font-size:9pt;'> Cancelar</span>", ['hojasruta/adminventanilla'], ['class' => 'btn btn-danger']); ?>
            </div>
            
            <?= $form->field($model, 'codigo')->textInput(['maxlength' => true, 'value'=>$model->isNewRecord ? "S/C" : $model->codigo, 'style'=>"font-size:13pt; color:#1A2226 ;"]) ?>

            <?php //= $form->field($model, 'destinatario_titulo')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'remitente_nombres')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'remitente_cargo')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'remitente_institucion')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'destinatario_nombres')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'destinatario_cargo')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'destinatario_institucion')->textInput(['maxlength' => true, 'value'=>$model->isNewRecord ? "ENTIDAD EJECUTORA DE RENOVACION VEHICULAR PATRIA" : $model->destinatario_institucion,]) ?>
            
            <?= $form->field($model, 'fecha')->textInput()->widget(DatePicker::classname(), [
                        'name' => 'fecha',
                        'readonly' => true,
                        'options' => ['placeholder' => 'Seleccione fecha ', 
                                      'value'=>$model->isNewRecord ? date('d/m/Y') : Yii::$app->formatter->asDate($model->fecha, 'dd/MM/yyyy'),
                                      
                                      
                                     ], //'value' => date('Y-m-d')
                        'pluginOptions' => [
                                            'autoclose'=>true,
                                            'format' => 'dd/mm/yyyy',
                                            'startDate' => date('d/m-Y'),
                                           ]

                        ])->label('Fecha') ?>

</div>
<div class="col-md-6"> 
    <style type="text/css"> 
        thead tr th { 
            position: sticky;
            top: 0;
            z-index: 10;
            background-color: #B8C7CD;
        }
    
        
    </style>
     
   <div class="card-body pad table-responsive"  style="height:630px; overflow:auto; border:1px solid lightgray; border-radius: 5px;">  
       
       
       <table class="table table-hover table-bordered table-striped" style="width:100%;" >
           <thead>
                  <tr style="background-color: #B8C7CD;">
                  <th>ID</th>
                  <th>NOMBRE</th>
                  <!--<th>CARGO</th>-->
                  <th>&Aacute;REA/UNIDAD</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php 

                    $dataReader=Documentos::getListaderivacion();
                    $i=0;
                    foreach($dataReader as $row){
                    $i++;    
                ?>
                  <tr style="font-size: 7.5pt; border-bottom: solid 0.11em gray;">
                      <td><?=$i?></td>
                      <td><?= Usuarios::getNameUsuario($row['id_usuario'])?><br><b><?=$row['cargo']?><b></td>
                        <td style="vertical-align: middle;"><?=Usuarios::getUsuarioArea($row['id_usuario'])?></td>
                        <td style="vertical-align: middle; width: 15%;">
                            <a onclick="javascript:destinatario('<?=Usuarios::getNameUsuario($row['id_usuario'])?>','<?= $row['cargo'] ?>');" style="text-decoration:none; color: white;font-size: 12px;" class='btn btn-success'>Destino</a>
                        </td>
                    </tr>
                <?php } ?>    
              </tbody>
            </table>
       
       
       
   </div>  
     
 </div>        

</div>
<div class="row">
 <div class="col-md-12">              
            
            
            <?php //= $form->field($model, 'fecha')->textInput() ?>
            

            <?= $form->field($model, 'referencia')->textarea(['rows' => 2]) ?>
 </div>
</div>
<div class="row">
 <div class="col-md-8">
            <?php //= $form->field($model, 'contenido')->passwordInput()->label('Contraseña') ?>
            <?php echo $form->field($model, 'contenido')->widget(Summernote::class, [
                    'useKrajeePresets' => true,
                    'pluginOptions'=>[
                                        'height' => 100,
                                        'dialogsFade' => true,
                                    /*    'toolbar' => [
                                            ['style1', ['style']],
                                            ['style2', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript']],
                                            ['font', ['fontname', 'fontsize', 'color', 'clear']],
                                            ['para', ['ul', 'ol', 'paragraph', 'height']],
                                            ['insert', ['link', 'picture', 'video', 'table', 'hr']],
                                        ],
                                        'fontSizes' => ['7','8', '9', '10', '11', '12', '13', '14', '16', '18', '20', '24', '36', '48'],
                                        'codemirror' => [
                                            //'theme' => Codemirror::DEFAULT_THEME,
                                            'lineNumbers' => true,
                                            'styleActiveLine' => true,
                                            'matchBrackets' => true,
                                            'smartIndent' => true,
                                            
                                        ], */
                                          'enableFullScreen'=>true,
                                        'enableHelp'=>true,
                                    ] 
                    // other widget settings
                ])->label('Resumen documento'); 
            ?>
            
            <?php //= $form->field($model, 'ruta_documento')->textInput(['maxlength' => true]) ?>
            <?php /*echo $form->field($model, 'archivo')->widget(FileInput::classname(), [
                                            'options' => ['multiple' => true, 'accept' => 'pdf/*', 'class' => 'form-control'], //'accept'=>'pdf/*', 
                                            'pluginOptions' => [ 'allowedFileExtensions' => ['pdf'], 'browseClass' => 'btn btn-primary btn-block', 'browseIcon' => '<i class="fa fa-file-pdf-o"></i> ']    
                ])->label('Documento PDF'); */
            
            
        /*    echo $form->field($model, 'archivo')->widget(FileInput::classname(), [
                'options' => ['multiple' => true],
                'pluginOptions' => ['allowedFileExtensions' => ['pdf'],
                    
                    'previewFileType' => 'pdf',
                'showUpload' => true,
                //'initialPreview' => $all_images,
                //'initialPreviewConfig'=>$all_images_preview,
                'overwriteInitial' => false,
                'showRemove' => true,
                'showPreview' => true,
                    
                    ]
            ]); */
            
                
            /*echo $form->field($model, 'image')->widget(FileInput::classname(), [
                'options'=>['accept'=>'image/*'],
                'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']
            ]);*/
            
            
            ?>
     
            <?php echo $form->field($model, 'archivo')->fileInput(['multiple' => true, 'accept' => 'pdf/*', 'class' => 'form-control', 'required'=>$model->isNewRecord ? true : false])->label('Documento PDF') ?>
  </div>
  <div class="col-md-4">  
            <?php 
                 if($model->isNewRecord){
                     $ruta="";
                     $gestion=date('Y');
                 }
                 else{
                     $ruta=$model->ruta_documento;
                     $gestion=$model->gestion;
                 }
            ?>
            <?=\lesha724\documentviewer\ViewerJsDocumentViewer::widget([
                'url' => '../../uploads/'.$gestion.'/'.$ruta, //url на ваш документ или http://example.com/test.odt
                'width'=>'100%',
                'height'=>'300px',
             ]);?>
            <?php /*=$form->field($model, 'ruta_documento')->widget(FileInput::classname(), [

            	'options' => ['multiple' => false, 'class' => 'form-control', 'accept' => 'image/*'],

            	'pluginOptions' => [ 'allowedFileExtensions' => ['pdf']]

        	]);*/ ?>
  </div>
</div>    
            <div class="row">
                <div class="col-md-6">
                    <?php //= $form->field($model, 'fk_motivo')->textInput() ?>
                    <?= $form->field($model, 'fk_motivo')->widget(Select2::classname(), [
                        'data'=> ArrayHelper::map(\app\models\Motivos::find()->all(), 'id_motivo', 'motivo'), 
                        'language' => 'es',
                        'options' => ['placeholder' => 'Seleccione motivo',],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Motivo documento'); ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'nro_hojas')->textInput(['maxlength' => true, 'value'=>$model->isNewRecord ? "0 Hojas" : $model->nro_hojas,]) ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'adjuntos')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'copias')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            
            
            
           
            
            <?php //= $form->field($model, 'fk_estado_documento')->textInput() ?>
            
            
            <?= $form->field($model, 'fk_estado_documento')->widget(Select2::classname(), [
                        'data'=> ArrayHelper::map(Estadodocumento::find()->all(), 'id_estado_documento', 'estado_documento'), 
                        'language' => 'es',
                        'options' => ['placeholder' => 'Seleccione estado documento',  'value' => 2,],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Estado documento'); ?>
            
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? "<span class='glyphicon glyphicon-floppy-disk'></span> Guardar Documento" : "<span class='glyphicon glyphicon-floppy-disk'></span> Modificar Documento", ['class' => 'btn btn-primary', 'id'=>'mybotonsave2']) ?>
                <?=Html::a("<i class='glyphicon glyphicon-ban-circle'></i> <span style='font-size:9pt;'> Cancelar</span>", ['hojasruta/adminventanilla'], ['class' => 'btn btn-danger']); ?>
            </div>
            
            
            <?php //= $form->field($model, 'hora')->textInput() ?>

            <?php //= $form->field($model, 'via_nombres')->textInput(['maxlength' => true]) ?>

            <?php //= $form->field($model, 'via_cargo')->textInput(['maxlength' => true]) ?>

            

            <?php //= $form->field($model, 'gestion')->textInput() ?>

            <?php //= $form->field($model, 'fecha_registro')->textInput() ?>

            <?php //= $form->field($model, 'hora_registro')->textInput() ?>

            <?php //= $form->field($model, 'fk_usuario')->textInput() ?>

            <?php //= $form->field($model, 'fk_tipo_documento')->textInput() ?>

            <?php //= $form->field($model, 'fk_area')->textInput() ?>

            <?php //= $form->field($model, 'fk_documento')->textInput() ?>

            

            <?php //= $form->field($model, 'activo')->textInput() ?>

            <?php //= $form->field($model, 'usuario_destino')->textInput() ?>

            <?php //= $form->field($model, 'grupo_destino')->textInput() ?>

            <?php //= $form->field($model, 'nombre_grupo')->textInput(['maxlength' => true]) ?>

            

            <?php //= $form->field($model, 'observado')->textInput() ?>

            <?php //= $form->field($model, 'enlace_nube')->textInput(['maxlength' => true]) ?>

            <?php //= $form->field($model, 'fk_regional_suic')->textInput() ?>

            <?php //= $form->field($model, 'fk_taller_suic')->textInput() ?>

            <?php //= $form->field($model, 'fk_orden_pago_suic')->textInput() ?>

            <?php //= $form->field($model, 'carpeta_pago')->textInput() ?>

           

            

        </div>
 </div>
</div>
<?php ActiveForm::end(); ?>




<script src="<?=Yii::$app->request->baseUrl; ?>/js/jquery.js"></script>
<script>
$(document).ready(function(){
    
    //$('select#documentos-fk_estado_documento').on('change',function(){
    $("#documentos-fk_estado_documento").change(function(){    
        var valor = $(this).val();
        //alert(valor);
        if(valor==1){
            $('#documentos-destinatario_nombres').val('NOMBRE RESERVADO'); 
            $('#documentos-referencia').val('RESERVADO'); 
            $('#documentos-contenido').val('RESERVADO');
        }
        else{
            $('#documentos-destinatario_nombres').val(''); 
            $('#documentos-referencia').val(''); 
            $('#documentos-contenido').val('');
        }
    });

});


</script>

