<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

use app\models\Estadodocumento;
use app\models\Documentos;

use kartik\editors\Summernote;

/* @var $this yii\web\View */
/* @var $model app\models\Documentos */
/* @var $form yii\widgets\ActiveForm */
?>
<script src="<?=Yii::$app->request->baseUrl; ?>/js/jquery.js"></script>
<script>
$(document).ready(function() {
    
    $("#mybotonsave" ).click(function() {
        $(this).prop("disabled",true).text("Enviando...").submit();
    });
    $("#mybotonsave2" ).click(function() {
        $(this).prop("disabled",true).text("Enviando...").submit();
    });    
 });    
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

<?php $form = ActiveForm::begin(); ?>
<div class="row">
 <div class="col-md-12">
        <div class="documentos-form">

            
            
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? "<span class='glyphicon glyphicon-floppy-disk'></span> Guardar Documento" : "<span class='glyphicon glyphicon-floppy-disk'></span> Modificar Documento", ['class' => 'btn btn-primary', 'id'=>'mybotonsave']) ?>
                
                <?=Html::a("<i class='glyphicon glyphicon-ban-circle'></i> <span style='font-size:9pt;'> Cancelar</span>", [$model->isNewRecord ? 'site/menudocumentos':'documentos/admintipo', 'gestion' => date('Y'), 'tipo'=>4], ['class' => 'btn btn-danger']); ?>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <?php $data = [
                            'Señor'=> 'Señor', 
                            'Señora'=> 'Señora', 
                            'Señores'=> 'Señores', 
                            ]; 

                    ?>        
                    <?= $form->field($model, 'destinatario_titulo')->widget(Select2::classname(), [
                                'data'=> $data,
                                'language' => 'es',
                                'options' => ['placeholder' => 'Seleccione Título'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]); ?>
                    
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true, 'readonly'=>true, 'value'=>$model->isNewRecord ? "........." : $model->codigo, 'style'=>$model->isNewRecord ? " " : "font-size:13pt; color:#1A2226 ;"]) ?>
                </div>
            </div>

            

            

            <?php //= $form->field($model, 'destinatario_titulo')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'destinatario_nombres')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'destinatario_cargo')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'destinatario_institucion')->textInput(['maxlength' => true]) ?>

            <?php //= $form->field($model, 'fecha')->textInput() ?>
            <?= $form->field($model, 'fecha')->textInput()->widget(DatePicker::classname(), [
                        'name' => 'fecha',
                        'readonly' => true,
                        'options' => ['placeholder' => 'Seleccione fecha ', 
                                      'value'=>$model->isNewRecord ? date('d/m/Y') : Yii::$app->formatter->asDate($model->fecha, 'dd/MM/yyyy'),
                                     ], //'value' => date('Y-m-d')
                        'pluginOptions' => [
                                            'autoclose'=>true,
                                            'format' => 'dd/mm/yyyy']

                        ])->label('Fecha') ?>

            <?= $form->field($model, 'referencia')->textarea(['rows' => 2]) ?>

            <?php //= $form->field($model, 'contenido')->textarea(['rows' => 6]) ?>
            <?php echo $form->field($model, 'contenido')->widget(Summernote::class, [
                    'useKrajeePresets' => true,
                 /*   'pluginOptions'=>[
                                        'height' => 300,
                                        'dialogsFade' => true,
                                        'toolbar' => [
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
                                            
                                        ],
                                          'enableFullScreen'=>true,
                                        'enableHelp'=>true,
                                    ] */
                    // other widget settings
                ]); ?>
            
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'adjuntos')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'copias')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            
            
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'remitente_nombres')->textInput(['maxlength' => true, 'value'=>$model->isNewRecord ? Documentos::getNameRemitente() : $model->remitente_nombres]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'remitente_cargo')->textInput(['maxlength' => true, 'value'=>$model->isNewRecord ? Documentos::getCargoRemitente() : $model->remitente_cargo]) ?>
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
                <?=Html::a("<i class='glyphicon glyphicon-ban-circle'></i> <span style='font-size:9pt;'> Cancelar</span>", [$model->isNewRecord ? 'site/menudocumentos':'documentos/admintipo', 'gestion' => date('Y'), 'tipo'=>4], ['class' => 'btn btn-danger']); ?>
            </div>
            <?php //= $form->field($model, 'remitente_institucion')->textInput(['maxlength' => true]) ?>
            
            <?php //= $form->field($model, 'hora')->textInput() ?>

            <?php //= $form->field($model, 'via_nombres')->textInput(['maxlength' => true]) ?>

            <?php //= $form->field($model, 'via_cargo')->textInput(['maxlength' => true]) ?>

            <?php //= $form->field($model, 'nro_hojas')->textInput(['maxlength' => true]) ?>

            <?php //= $form->field($model, 'gestion')->textInput() ?>

            <?php //= $form->field($model, 'fecha_registro')->textInput() ?>

            <?php //= $form->field($model, 'hora_registro')->textInput() ?>

            <?php //= $form->field($model, 'fk_usuario')->textInput() ?>

            <?php //= $form->field($model, 'fk_tipo_documento')->textInput() ?>

            <?php //= $form->field($model, 'fk_area')->textInput() ?>

            <?php //= $form->field($model, 'fk_documento')->textInput() ?>

            <?php //= $form->field($model, 'ruta_documento')->textInput(['maxlength' => true]) ?>

            <?php //= $form->field($model, 'activo')->textInput() ?>

            <?php //= $form->field($model, 'usuario_destino')->textInput() ?>

            <?php //= $form->field($model, 'grupo_destino')->textInput() ?>

            <?php //= $form->field($model, 'nombre_grupo')->textInput(['maxlength' => true]) ?>

            <?php //= $form->field($model, 'fk_motivo')->textInput() ?>

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

