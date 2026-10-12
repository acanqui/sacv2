<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

use app\models\Usuarios;
use app\models\Seguimientos;
use app\models\Archivo;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArchivoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Archivos';
$this->params['breadcrumbs'][] = 'Archivo SAC';

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
    'title' => '<b>ERROR EN LA OPERACION</b>',
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

<br>
<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="fa fa-archive" style="font-size:30pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 18pt;">Archivo SAC</u></b>
          </h5>
        </div>
    </div>
    <div class="col-md-6" style="text-align: right;">
       <?=Html::a("<i style='font-size:12pt;' class='glyphicon glyphicon-hand-left'></i> <br>&nbsp;&nbsp;&nbsp;Atras&nbsp;&nbsp;&nbsp;", ['site/index'], ['class' => 'btn btn-danger active']);?>

       <?=" ".Html::a("<i style='font-size:12pt;' class='fa fa-file-pdf-o'></i> <br>Reporte PDF", ['reportearchivopdf'], ['class' => 'btn btn-success active', 'target'=>'_blank']); ?>

       <?=" ".Html::a("<i style='font-size:12pt;' class='fa fa-file-pdf-o'></i> <br>Reporte EXCEL", ['reportearchivoexcel'], ['class' => 'btn btn-warning active', 'target'=>'_blank']); ?>
        
    </div>
</div>
<br>
<div class="archivo-index">

    <?php //= Html::a('Create Archivo', ['create'], ['class' => 'btn btn-success']) ?>
    

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
              'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],  
            ],
            
            [
                'label'=>'Tipo',
                'attribute'=>'oficial',
                //'value'=>'oficial',
                'value' => function ($model) {
                       return $model->oficial==1?'ORIGINAL':'COPIA';
                        
                   },
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'oficial',
                    'data' => [1=>'ORIGINAL', 0=>'COPIA'],
                    'options' => [
                               'placeholder' => 'Sel.'
                           ],
                       'pluginOptions' => [
                              'allowClear' => true
                          ],        
                ]),           
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            [
                'label'=>'NUR/NURI',
                'attribute'=>'nuri',
                'value'=>'nuri',
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],

            [
                'label'=>'Fecha Nuri',
                'attribute'=>'oficial',
                //'value'=>'proveido',
                'format'=>'html',
                'value'=> function ($model, $key, $index, $grid){
                    //return $model->derivadoPor->nombre;
                     $row=Seguimientos::getObtenerReferenciaRemitente($model->nuri);
                     return $row['fecha'];

                },
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt;'],
                'filter'=>false,
            ],
 	    [
                'label'=>'CITE',
                'attribute'=>'oficial',
                //'value'=>'proveido',
                'format'=>'html',
                'value'=> function ($model, $key, $index, $grid){
                    //return $model->derivadoPor->nombre;
                     $row=Seguimientos::getObtenerReferenciaRemitente($model->nuri);
                     return $row['cite'];

                },
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt;'],
                'filter'=>false,
            ],


            [
                'label'=>'Referencia',
                'attribute'=>'oficial',
                //'value'=>'proveido',
                'format'=>'html',
                'value'=> function ($model, $key, $index, $grid){
                    //return $model->derivadoPor->nombre;
                     $row=Seguimientos::getObtenerReferenciaRemitente($model->nuri);
                     return $row['referencia'];

                },
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt;'],
                'filter'=>false,
            ],


            [
                'label'=>'Acciones',
                'attribute'=>'acciones',
                'value'=>'acciones',
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            [
                'label'=>'Nombre Carpeta',
                'attribute'=>'nombre_carpeta',
                'value'=>'nombre_carpeta',
                'format'=>'html',
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'nombre_carpeta',
                    'data' => Archivo::getListCarpeta(),
                    'options' => [
                               'placeholder' => 'Seleccione'
                           ],
                       'pluginOptions' => [
                              'allowClear' => true
                          ],        
                ]),
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            [
                'label'=>'Fecha Archivo',
                'attribute'=>'fecha_archivo',
                'value'=>'fecha_archivo',
                'format'=>'date',
                'filter' => DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'fecha_archivo',
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,
                        ]
                    ]), 
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; width: 150px; font-size: 9pt; text-align:center;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            [
                'label'=>'Tipo Trámite',
                'attribute'=>'tipo_tramite',
                'value'=>'tipo_tramite',
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            
        /*    [
                'label'=>'Usuario Archivo',
                'attribute'=>'fk_usuario',
                //'value'=>'fk_usuario',
                'value'=> function ($model, $key, $index, $grid){
                    //return $model->derivadoPor->nombre;
                    return Seguimientos::getUsuarioPendientes($model->fk_usuario);
                },
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],  */             
                           
            /*[
                'label'=>'Observaciones',
                'attribute'=>'observaciones',
                'value'=>'observaciones',
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],*/
                           
            [
                'label'=>'Gestion',
                'attribute'=>'gestion',
                'value'=>'gestion',
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'gestion',
                    'data' => Archivo::getListGestion(),
                    'options' => [
                               'placeholder' => 'Sel.'
                           ],
                       'pluginOptions' => [
                              'allowClear' => true
                          ],        
                ]), 
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt; text-align:right;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],  
            [
                'label'=>'Estado Archivo',
                'attribute'=>'activo',
                //'value'=>'fk_usuario',
                'value'=> function ($model, $key, $index, $grid){
                    return $model->activo==1?'ARCHIVADO':'DESARCHIVADO';
                },
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'activo',
                    'data' => [1=>'ARCHIVADO', 0=>'DESARCHIVADO'],
                    'options' => [
                               'placeholder' => 'Sel.'
                           ],
                       'pluginOptions' => [
                              'allowClear' => true
                          ],        
                ]),        
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],            
           
            

           /* 'id_archivo',
            'nuri',
            'acciones',
            'nombre_carpeta',
            'fecha_archivo',*/
            //'tipo_tramite',
            //'observaciones',
            //'terminado',
            //'gestion',
            //'fecha_registro',
            //'hora_registro',
            //'fk_usuario',
            //'fk_seguimiento',
            //'fk_regional',
            //'activo',
            //'oficial',
            //'fk_area',

           // ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                    'header' => 'Opciones',
                    'headerOptions' => ['style' => 'width: 80px;'],
                    'contentOptions'=>['style'=>'border: 1px solid #BEBFC1;'],
                    'template' => '{archivar} {agrupar} {anadirrespuesta} ', //{seguimiento} {reportepdf} {reporteexcel}
                    'buttons'=>[
                        'archivar'=>function($url, $model){
                    
                            if($model->activo==1){
                                    return Html::a(
                                        '<span class="btn btn-sm btn-primary active">
                                           <span class="fa fa-paint-brush"></span> Modificar<span>',
                                        $url, ['title'=>'Modificar Archivo']
                                    );
                            }       
                        },
                        
                        
                    ],
                    'urlCreator'=>function($action, $model, $key, $index){
                        
                            if($action=='archivar'){
                               return yii\helpers\Url::to(['archivo/update', 'id'=>$key]); 
                            }
                    }         
            ], // fin buttons
                    
                    
        ],
    ]); ?>


</div>
