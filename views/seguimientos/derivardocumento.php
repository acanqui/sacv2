<script src="<?=Yii::$app->request->baseUrl; ?>/js/jquery.js"></script>   
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Seguimientos;
use app\models\Documentos;
use app\models\Hojasruta;
use app\models\SeguimientosSearch;


use yii\grid\GridView;

use app\models\Listaderivacion;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

use kartik\popover\PopoverX;

use kartik\dialog\Dialog;
/* @var $this yii\web\View */
/* @var $model app\models\Seguimientos */
/* @var $form yii\widgets\ActiveForm */

//$this->title = 'Create Seguimientos';
$this->params['breadcrumbs'][] = ['label' => 'Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Derivar documento';

$hojasruta= Documentos::getHojasRuta($documento->id_documento);

/*print_r($hojasruta);
exit(); */

// CODIGO PARA DIALOG
echo Dialog::widget([
   'options' => [
                'type' => Dialog::TYPE_DANGER,
                'btnOKClass' => 'btn-danger',
                'size' => Dialog::SIZE_MEDIUM, // large dialog text
       ], // default options
]);

//##############################################################################
use kartik\widgets\Growl;
if (Yii::$app->session->getFlash('success')){
    echo Growl::widget([
        'type' => Growl::TYPE_SUCCESS,
        'title' => '<b>OPERACIÓN EXITOSA</b>',
        'icon' => 'glyphicon glyphicon-ok-circle',
        //'body' => 'You successfully read this important alert message.',
        'body' => Yii::$app->session->getFlash('success'),
        'showSeparator' => true,
        'delay' => 0,
        'pluginOptions' => [
            'showProgressbar' => true,
            'placement' => [
                'from' => 'top',
                'align' => 'right',
            ],
            'timer'=>1700,
        ]
    ]);
}

if (Yii::$app->session->getFlash('error')){
    echo Growl::widget([
    'type' => Growl::TYPE_DANGER,
    'title' => '<b>ERROR EN LA OPERACIÓN</b>',
    'icon' => 'glyphicon glyphicon-remove-circle',
    //'body' => 'Change a few things up and try submitting again.',
    'body' => Yii::$app->session->getFlash('error'),
    'showSeparator' => true,
    'delay' => 4500,
    'pluginOptions' => [
        'showProgressbar' => true,
        'placement' => [
            'from' => 'top',
            'align' => 'right',
        ],
        'timer'=>1700,
    ]
  ]);
}


?>
<style>
.grid-view table thead {
    background-color: #B8C7CD;
}

.grid-view table thead a {
    color: #222D32;
}


</style>

<script>
   /* $(document).ready(function() {
        
        
        $('#boton_derivar').on('click',function()
            {
              $(this).val('Please wait ...')
                .attr('disabled','disabled');
              $('#formulario').submit();
            });
        
        
    });*/
    </script>

<?php 


/*
echo Growl::widget([
	'type' => Growl::TYPE_WARNING,
	'icon' => 'glyphicon glyphicon-ok-sign',
	'title' => 'Note',
	'showSeparator' => true,
	'body' => 'This is a successful growling alert.'
]); */

//echo $hojasruta['nur'];
//exit();

// codigo para contar si todas las acciones son las mismas, si hay mas de uno se muestra el mensaje 
if(Seguimientos::contaraccionesdistintas($hojasruta['nur'])>1){
    Seguimientos::mensajeMismaAccion();
} // end if






//##############################################################################################
//CODIGO MOSTRAR LOS GRUPOS CREADOS Y DERIVARLOS
Modal::begin([
    'id' => 'creados-modal',
    'header' => '<h4 class="modal-title">Derivar copias a grupos</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Cerrar</a>',
    'size' => 'modal-lg',
]); 

//$requestUpdateUrl=Url::toRoute('actualizar');
$requestUpdateUrl=Url::toRoute('seguimientos/derivargrupos');
$updateJs=<<<JS
    $('.data-creados').on('click', function () {
        $.get ('{$requestUpdateUrl}', {id:$(this).data('id')},
            function (data) {
                $('.modal-body').html (data);
            }  
        );
    });
JS;
$this->registerJs($updateJs);
Modal::end();


?>    

    
<div class="seguimientos-create">

    <span style="font-size: 20pt; color: #222D32;"><b>Derivar documento <u><?=$hojasruta['nur']?></u></b></span>

<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <div class="card-body pad">
		
                
                <?php $form = ActiveForm::begin([ 'id' => 'formulario',]); ?>
       
          
                <?php //= $form->field($model, 'derivado_a')->textInput() ?>
                <?php /*= $form->field($model, 'derivado_a')->widget(Select2::classname(), [
                        'data'=> ArrayHelper::map(Listaderivacion::find()
                                                                   ->where(['usuario_origen'=>3])
                                                                   ->joinWith([
                                                                        'usuarioDestino as u' => function($query){
                                                                               $query->select(['u.id_usuario', 'u.nombre', 'u.cargo']);
                                                                             }
                                                                   ])
                                                                   ->all(), 'id_lista_derivacion', 'usuario_destino'),


                                    'language' => 'es',
                                    'options' => ['placeholder' => 'Seleccione destinatario',],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                ]);*/ ?>

                <?= $form->field($model, 'derivado_a')->widget(Select2::classname(), [
                        'data'=> Seguimientos::getListDestino(),

                                    'language' => 'es',
                                    'options' => ['placeholder' => 'Seleccione destinatario', /*'multiple' => true,*/],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                ])->label('Derivado a:'); ?>      

                <?= $form->field($model, 'proveido')->textInput(['rows' => 12])->label('Proveído') ?>                
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'fk_accion')->widget(Select2::classname(), [
                                    'data'=> ArrayHelper::map(app\models\Acciones::find()->all(), 'id_accion', 'accion'),
                                    'language' => 'es',
                                    'size'=>'LARGE',
                                    'options' => ['placeholder' => 'Seleccione Acción/Tipo Proceso', /*'multiple' => true, 'value' => 1,*/],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ],

                                ])->label('Acción/Tipo Proceso'); ?>
                    </div>
                    <div class="col-md-6">
                        <?php 
                        
                            if(Yii::$app->user->identity->fk_nivel==2 || Yii::$app->user->identity->fk_nivel==4 || Yii::$app->user->identity->fk_nivel==6 || Yii::$app->user->identity->fk_nivel==7 || Yii::$app->user->identity->fk_nivel==8 ){
                                
                                echo $form->field($model, 'oficial')->widget(Select2::classname(), [
                                           'data'=> [1=>'ORIGINAL'],
                                           //'readonly' => $seguimientos->oficial==0?true:false,
                                           'language' => 'es',
                                           'options' => ['placeholder' => 'Seleccione',
                                                         //isset($params['company_id'])?$params['company_id']:'', 
                                                         'value' => Seguimientos::getDerivarDocumentoOriginalCopia($hojasruta['nur']), /*'multiple' => true,*/

                                                         'options' => [
                                                               // 1 => ['disabled' => $seguimientos->oficial==0?true:false],
                                                               1 => ['disabled' => Seguimientos::geStateDerivarDocumentoOriginalCopia($hojasruta['nur'])],
                                                          ],
                                                   ],

                                           'pluginOptions' => [
                                               'allowClear' => true,
                                           ],

                                       ])->label('Tipo de trámite'); 
                                
                            } //END IF
                            else{
                        
                                echo $form->field($model, 'oficial')->widget(Select2::classname(), [
                                           'data'=> [1=>'ORIGINAL',0=>'COPIA'],
                                           //'readonly' => $seguimientos->oficial==0?true:false,
                                           'language' => 'es',
                                           'options' => ['placeholder' => 'Seleccione',
                                                         //isset($params['company_id'])?$params['company_id']:'', 
                                                         'value' => Seguimientos::getDerivarDocumentoOriginalCopia($hojasruta['nur']), /*'multiple' => true,*/

                                                         'options' => [
                                                               // 1 => ['disabled' => $seguimientos->oficial==0?true:false],
                                                               1 => ['disabled' => Seguimientos::geStateDerivarDocumentoOriginalCopia($hojasruta['nur'])],
                                                          ],
                                                   ],

                                           'pluginOptions' => [
                                               'allowClear' => true,
                                           ],

                                       ])->label('Tipo de trámite'); 
                            } // END ELSE
                        ?>
                    </div>
                </div>    


                <?php //= $form->field($model, 'oficial')->textInput() ?>      



                <?= $form->field($model, 'codigo')->hiddenInput(['maxlength' => true, 'value' => $hojasruta['nur']])->label(false) ?>
                <?= $form->field($model, 'derivado_por')->hiddenInput(['value' => Yii::$app->user->identity->id_usuario])->label(false) ?>
                <?= $form->field($model, 'padre')->hiddenInput(['value'=>0])->label(false) ?>          


                <?php //= $form->field($model, 'fecha_derivacion')->textInput() ?>

                <?php //= $form->field($model, 'hora_derivacion')->textInput() ?>

                <?php //= $form->field($model, 'fecha_recepcion')->textInput() ?>

                <?php //= $form->field($model, 'hora_recepcion')->textInput() ?>

                <?php //= $form->field($model, 'fk_accion')->textInput() ?>

                <?php //= $form->field($model, 'fk_estado')->textInput() ?>

                <?php //= $form->field($model, 'hijo')->textInput(['maxlength' => true]) ?>

                <?php //= $form->field($model, 'fecha_registro')->textInput() ?>

                <?php //= $form->field($model, 'hora_registro')->textInput() ?>

                <?php //= $form->field($model, 'gestion')->textInput() ?>

                <?php //= $form->field($model, 'confirmado')->textInput() ?>

                <?php //= $form->field($model, 'activo')->textInput() ?>

                <?php //= $form->field($model, 'fk_grupo_derivacion')->textInput() ?>

                <?php //= $form->field($model, 'fk_principal_agrupacion')->textInput() ?>

                <?php //= $form->field($model, 'numero_copia')->textInput(['maxlength' => true]) ?>

                <?php //= $form->field($model, 'observado')->textInput() ?>

                <?php //= $form->field($model, 'accion_archivo')->textarea(['rows' => 6]) ?>

                <?php //= $form->field($model, 'correlativo_copia')->textInput() ?>

                <div class="form-group">
                    <center>
                <?php 
                    
                    //echo Html::submitButton("<i style='font-size:12pt;' class='fa fa-group'></i> Derivar a grupo", ['class' => 'btn btn-danger', 'id'=>'boton_derivar',]); 
                    if(Yii::$app->user->identity->fk_nivel==1 ||Yii::$app->user->identity->fk_nivel==3){
                        echo Html :: a ("<i style='font-size:15pt;' class='fa fa-group'></i> Derivar a grupo"
                                , '#', [
                                        'data-toggle' => 'modal',
                                        'data-target' => '#creados-modal',
                                        'class' => 'data-creados btn btn-danger',
                                        'data-id' =>$hojasruta['id_hoja_ruta'],
                                ]);
                    }// end if
                    
                    
                    echo " ".Html::submitButton("<i style='font-size:12pt;' class='fa fa-share-square-o'></i> Derivar trámite", ['class' => 'btn btn-success', 'id'=>'boton_derivar',]); 
                    
                    
                        
                        // codigo para contar si hay nuris derivados sin confirmar
                        $cant_derivados= Seguimientos::countDerivarSinConfirmar($hojasruta['nur']);
                        if($cant_derivados>0){
                            
                        
                    
                            //codigo para contar los caracteres en todos los cites generados asociados al NUR/NURI
                            $row_cant= Seguimientos::countCharCites($hojasruta['nur']);  
                              if($row_cant['total_menor']==0){
                                 if(Seguimientos::contaraccionesdistintas($hojasruta['nur'])==1){
                                     if(Seguimientos::verificarSiExisteOficialDocumento($hojasruta['nur'])==1){
                                        echo " ".Html::a("<i style='font-size:12pt;' class='fa fa-check-square-o'></i> Confirmar y Finalizar", ['confirmarderivaciondocumento', 'nuri' => $hojasruta['nur']], ['class' => 'btn btn-primary']); 
                                     }
                                     else{
                                         Seguimientos::mensajeNoSePuedeConfirmar($hojasruta['nur']) ;
                                     }
                                 }  
                              }
                              else{ 
                                  
                                  Seguimientos::mensajeCantidadLetras($hojasruta['nur']);
                              }  
                        
                        } //if($cant_derivados>0){    
                         
                         //echo "-----> ".print_r($row_cant);    
                    
                        
                        

                    ?>
                        
                    </center>
                </div>

                <?php ActiveForm::end(); ?>
                
                
                
                
            <div>
        </div>
    </div> 
    </div><!<!-- DIV 6 -->
    <div class="col-md-6">
        <div class="card-body pad table-responsive">
            <br>
		<table class="table table-bordered table-striped" >
		    <tr style="font-size: 16px; " class="bg-success disabled color-palette">
		      	<th style="border: 1px solid darkgray; background-color: #B8C7CD;">NUR/NURI</th>
		       	<th style="border: 1px solid darkgray; background-color: #B8C7CD;">CITES ASOCIADOS</th>
		    </tr>
		    <tr style="font-size: 16px;"  style="border: 1px solid darkgray;">
		     	<th style="border: 1px solid darkgray;" valign="middle">
                            <center>
                                <i  style="font-size: 20pt; color: #DB4437;" class="fa fa-thumbs-o-up"></i><br>
				    Documento Oficial
			    </center>
                            
                            <center><span style="font-size:15pt; color: #222D32;"><?=$hojasruta['nur']?></span></center>
			</th>
			<td  style="border: 1px solid darkgray;">
                            <table cellpadding="2px" width="100%" class="table-bordered " >
				<?php
                                    //añadir id de edocumento actual para no quede el nuri vacio
                                    $dataReader=Seguimientos::getListCitesAsignados($hojasruta['nur']);
                                    //$dataReader=Seguimientos::getListCitesAsignadosPendiente($seguimientos->codigo);
                                    foreach ($dataReader as $row4) {  ?>
                                        <tr  style="font-size: 15px;">
                                            <td align="center"><b><?=$row4['codigo']; ?></b></td>
                                        </tr>
                                    <?php } ?>
                            </table>

                            <table cellpadding="0" width="100%" class="table-bordered" >
					                    <?php
                              // CODIGO PARA CONTABILIZAR SI TODOS LOS DOCUMENTOS TIENEN MAYOR A 400 caracteres
                              $contador_caracteres=0;

                              //codigo para verificar si el ultimo ID seguimiento tiene asociado un docuemtno
                              // vamos revisanndo desde el mas reciente al mas antoguo
                                 
                                $dataReader=Seguimientos::getListCitesAsignadosPendiente($hojasruta['nur']);
				foreach ($dataReader as $row2) {
                                // verificando si el contador es menor a 400 caracteres
                                //if ($row2['num_contenido']<301) { $contador_caracteres++;  }
                                ?>
                                    <tr  style="font-size: 11px;">
                                      <td><?=$row2['cite']?></td><td align="right"><?=number_format($row2['num_contenido'], 0, ',', '.')?></td>
                                    </tr>
                                <?php
				}
                                ?>
                                                            
                                                            

                              </table>

                              <?php //="<br> -----> ".$contador_caracteres ?>

                        </td>
                    </tr>
		</table>
            
                <?php 
                    if(Documentos::getCountNurinuevo($hojasruta['nur'])>0){  
                  
                        if(Documentos::verificarDocumentoExterno($hojasruta['nur'])>0){
                            echo " ".Html::a("<i style='font-size:12pt;' class='fa fa-file-pdf-o'></i> Hoja de Ruta Externa", ['documentos/generarhrexternopdf', 'id_hoja_ruta' => $hojasruta['id_hoja_ruta'], 'id_documento' => $documento->id_documento ] , ['class' => 'btn btn-warning', 'target'=>'_blank']);
                        }
                        else{
                            echo " ".Html::a("<i style='font-size:12pt;' class='fa fa-file-pdf-o'></i> Hoja de Ruta ", ['documentos/generarhrinternopdf', 'id_hoja_ruta' => $hojasruta['id_hoja_ruta'], 'id_documento' => $documento->id_documento ] , ['class' => 'btn btn-warning', 'target'=>'_blank']);
                        }
                        
                        
                    }
                ?>
            
                <?php 
                    if($cant_derivados>0){
                       // echo Html::a("<i style='font-size:15pt;' class='fa fa-file-pdf-o'></i> Imprimir H.S.", ['/controller/action', 'id' => $seguimientos->codigo], ['class' => 'btn btn-warning']); 
                    }    
                ?>
        </div>
    </div>
</div>
</div>
<?php 

//echo "--------> ".Yii::$app->user->identity->fk_perfil;

?>

<div class="card-body">
  <div class="row">
      
    <div class="col-md-12">
        <div class="card-body pad table-responsives">
            <?php 
            
            /*
            use kartik\editable\Editable;
            
            echo Editable::widget([
    'name'=>'notes', 
    'asPopover' => false,
    'displayValue' => 'more...',
    'inputType' => Editable::INPUT_TEXTAREA,
    'value' => "Raw denim you...",
    'header' => 'Notes',
    'submitOnEnter' => false,
    'options' => [
        'class'=>'form-control', 
        'rows'=>5, 
        'style'=>'width:400px', 
        'placeholder'=>'Enter notes...'
    ]
]);*/
        // use dosamigos\grid\GridView;
            
                $searchModel = new SeguimientosSearch();
                $dataProvider = $searchModel->searchderivadosa(Yii::$app->request->queryParams, $hojasruta['nur']);
                $dataProvider->pagination->pageSize=15;
                
                echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'pager' =>false,
                       // 'filterModel' => $searchModel,
                    
                        'columns' => [
                            //['class' => 'yii\grid\SerialColumn'],
                            //'id_seguimiento',
                            //'codigo',
                            //'derivado_por',
                            //'derivado_a',
                            [
                                'label'=>'N°',
                                'attribute'=>'numero_copia',
                                //'value'=>'derivado_a',
                                'value'=> function ($model, $key, $index, $grid){
                                        
                                        if($model->oficial==0){ return $model->numero_copia; }
                                        else{ return "."; }
                                    },
                                //'format'=>'html',
                                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt;'],
                                'headerOptions'=>['style'=>'color:black;'],
                                'filter'=>false
                            ],
                            [
                                'label'=>'Derivado a',
                                'attribute'=>'derivado_a',
                                //'value'=>'derivado_a',
                                'value'=> function ($model, $key, $index, $grid){
                                        //return $model->derivadoPor->nombre;
                                        return $model->getUsuarioPendientes($model->derivado_a);
                                    },
                                'format'=>'html',
                                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt;'],
                                'headerOptions'=>['style'=>'color:black;'],
                                'filter'=>false
                            ],
                            [
                                'label'=>'Área destino',
                                'attribute'=>'derivado_a',
                                //'value'=>'derivado_a',
                                'value'=> function ($model, $key, $index, $grid){
                                        //return $model->derivadoPor->nombre;
                                        return $model->getUsuarioArea($model->derivado_a);
                                    },
                                'format'=>'html',
                                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt;'],
                                'headerOptions'=>['style'=>'color:black;'],
                                'filter'=>false
                            ],                
                            [
                                'label'=>'Proveído',
                                'attribute'=>'proveido',
                                'value'=>'proveido',
                                'format'=>'html',
                                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt;'],
                                'headerOptions'=>['style'=>'color:black;'],
                                'filter'=>false
                            ],
                            [
                                'label'=>'Fecha',
                                'attribute'=>'fecha_derivacion',
                                'value'=>'fecha_derivacion',
                                'format'=>'date',
                                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt; width:90px;'],
                                'headerOptions'=>['style'=>'color:black;'],
                                'filter'=>false
                            ],
                            [
                                'label'=>'Accion/Tipo',
                                'attribute'=>'fk_accion',
                                 'value'=> function ($model, $key, $index, $grid){
                                        return $model->fkAccion->accion ;
                                    },
                                'format'=>'html',
                                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt; width:90px;'],
                                'headerOptions'=>['style'=>'color:black;'],
                                'filter'=>false
                            ],                
                            [
                                'label'=>'Tipo',
                                'attribute'=>'oficial',
                                'value'=>'oficial',
                                'value'=> function($data){
                                        if($data->oficial == 1){  $info = '<b>ORIGINAL</b>';   }
                                        if($data->oficial == 0){  $info = 'COPIA';      }
                                        return $info;
                                    },
                                'format'=>'html',
                                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt;'],
                                'headerOptions'=>['style'=>'color:black;'],
                                'filter'=>false
                            ],
                            
                                            
                            [
                                'class' => 'yii\grid\ActionColumn',
                                    'header' => 'Opciones',
                                    'headerOptions' => ['style' => 'border: 1px solid #BEBFC1; width: 150px;'],
                                    'contentOptions'=>['style'=>'border: 1px solid #BEBFC1;'],
                                    'template' => '{update} {eliminarderivacion} ', //{confirmarcopia}
                                    'buttons'=>[
                                        /*'update'=>function($url, $model){

                                            
                                                return Html::a(
                                                        '<span class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span><span>',
                                                        $url, ['title'=>'Modificar derivacion']
                                                    );
                                        },*/
                                        'update'=>function($url, $model, $key) {
                                            return Html :: a ('
                                                                <span class="btn btn-primary">
                                                                 <span class="fa fa-paint-brush" style="font-size: 11pt;">'
                                                                        , '#', [
                                                                   'data-toggle' => 'modal',
                                                                   'data-target' => '#update-modal',
                                                                   'class' => 'data-update',
                                                                   'data-id' => $key,
                                                               ]);
                                        },        

                                        'confirmarcopia'=>function($url, $model){
                                            
                                            if($model->oficial == 0){
                                                if(Yii::$app->user->identity->fk_perfil==5){
                                                    return Html::a(
                                                        '<span class="btn btn-warning"><span class="glyphicon glyphicon-ok"></span> <span>',
                                                        $url, ['title'=>'Confirmar copia']
                                                    );
                                                }    
                                            }
                                            
                                                
                                        },
                                        
                                        'eliminarderivacion'=>function($url, $model){

                                          return Html::a(
                                                        '<span class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span><span>',
                                                        $url, ['title'=>'Eliminar derivación', 
                                                                'data' => [
                                                                        'confirm' => 'Esta seguro que desea eliminar esta derivacion?',
                                                                        'method' => 'post',
                                                                    ],
                                                            ]
                                                    );
                                        },

                                    ],
                                    'urlCreator'=>function($action, $model, $key, $index) use ($documento){
                                            
                                            if($action=='confirmarcopia'){
                                               return yii\helpers\Url::to(['confirmarcopiadocumento', 'id_seguimiento'=>$key, 'id_documento'=>$documento->id_documento]); 
                                            }
                                            if($action=='eliminarderivacion'){
                                               return yii\helpers\Url::to(['eliminarderivaciondocumento', 'id_seguimiento'=>$key, 'id_documento'=>$documento->id_documento]); 
                                            }
                                            
                                    }         
                            ], // fin buttons                  
                                            
                        ],
                    ]); ?>
            
            
        </div>  
    </div>    
  </div>
 </div>    
</div>
    
    
<?php 


//##############################################################################################
//CODIGO PARA MOSTRAR LA VISTA DE LOS DOCUMENTOS
//use yii\bootstrap\Modal;
//Update operation
Modal::begin([
    'id' => 'update-modal',
    'header' => '<h4 class="modal-title">Modificar derivacion</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Cerrar</a>',
    'size' => 'modal-lg',
]); 

//$requestUpdateUrl=Url::toRoute('actualizar');
$requestUpdateUrl=Url::toRoute('formcorregirderivaciondocumento');
$updateJs=<<<JS
    $('.data-update').on('click', function () {
        $.get ('{$requestUpdateUrl}', {id:$(this).closest('tr').data('key')},
            function (data) {
                $('.modal-body').html (data);
            }  
        );
    });
JS;
$this->registerJs($updateJs);
Modal::end();

?>    
    
    
 