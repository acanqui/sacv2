<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Usuarios;
use app\models\Acciones;
use kartik\date\DatePicker;

use yii\bootstrap\Modal;
use yii\helpers\Url;



use kartik\dialog\Dialog;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SeguimientosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Seguimientos';
$this->params['breadcrumbs'][] = 'Copias pendientes';
?>
<br><br>
<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="fa fa-folder-open-o" style="font-size:30pt;" ></i>&nbsp;&nbsp;&nbsp;
              <!--<b><u style="font-size: 18pt;">Tr&aacute;mites Copias Pendientes</u></b>-->
              <b><u style="font-size: 18pt;">Bandeja de Pendientes (Copias)</u></b>
          </h5>
        </div>
    </div>
    <div class="col-md-6" style="text-align: right;">
        <?php 
            echo " ".Html::a("<i style='font-size:12pt;' class='fa fa-file-pdf-o'></i> <br>Reporte PDF", ['pendientescopiaspdf'], ['class' => 'btn btn-success', 'target'=>'_blank']);
        ?>
    </div>
</div>

<style>
.grid-view table thead {
    background-color: #B8C7CD;
}

.grid-view table thead a {
    color: #222D32;
}


</style>

<hr style="opacity: 0.3;">
<div class="seguimientos-index">

    
    <h1><?php //= Html::encode($this->title) ?></h1>

    <p>
        <?php //= Html::a('Create Seguimientos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        //'options' => [ 'class' => 'YourCustomTableClass', ],
        
        
        'tableOptions'=> ['class'=>'table table-striped table-bordered table-hover'],
        
        'showFooter'=>true,
        'showHeader' => true,
        //'showFooter' => true,
        'pager' => [
            'nextPageLabel' => '»',
            'prevPageLabel' => '«',
            'firstPageLabel' => 'Primero',
            'maxButtonCount' => 5,
            'lastPageLabel'  => 'Último'
        ],
        //'contentOptions' =>['class' => 'table table-hovered',],
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                //'contentOptions' => ['class' => 'table table-dark table-striped table-bordered table-hover'],
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],
            ],

            //'id_seguimiento',
            //'codigo',
            
            [
                //'label'=>'NUR/NURI',
                'label'=>'Hoja de Ruta',
                'attribute'=>'codigo',
                /*'value' => function ($model) {
                        return $model->getMostrarCodigo($model->oficial, $model->codigo, $model->numero_copia);
                   },*/

                    'value' => function ($model) {
                        // 1. Obtenemos el texto de la Hoja de Ruta que ya tenías
                        $textoCodigo = $model->getMostrarCodigo($model->oficial, $model->codigo, $model->numero_copia) . " " . $model->getVerNuriAgrupado($model->codigo);

                        // 2. Generamos la URL usando tu ejemplo exacto
                        $url = yii\helpers\Url::to(['seguimientos/seguimientonuri', 'nuri' => $model->codigo]);

                        // 3. Devolvemos el texto convertido en enlace que abre en una nueva pestaña
                        return yii\helpers\Html::a($textoCodigo, $url, [
                                'title' => 'Ver Seguimiento de Hoja de Ruta',
                                'target' => '_blank',
                                'style' => 'color: inherit; text-decoration: none;',
                                'data-pjax' => '0' // Opcional, por si usas Pjax en tu GridView para evitar conflictos
                        ]);
                    },

                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            
            
            
            //'derivado_por',
            
            [
                'label'=>'Derivado Por',
                'attribute' => 'derivado_por',
                'value'=> function ($model, $key, $index, $grid){
                    //return $model->derivadoPor->nombre;
                    return $model->getUsuarioPendientes($model->derivado_por);
                },
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],
                'format'=>'html',        
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'derivado_por',
                    'data' => ArrayHelper::map(Usuarios::find()->all(), 'id_usuario', 'nombre'),
                    'options' => [
                        //'multiple' => true, 
                               'placeholder' => 'Seleccione Funcionario'
                           ],
                       'pluginOptions' => [
                              'allowClear' => true
                          ],        
                ]),           
                        
            ],
            
            //'derivado_a',
            //'proveido:ntext',
            
            [
                'label'=>'Proveido',
                'attribute'=>'proveido',
                //'value'=>'proveido',
                'format'=>'html',
                'value'=> function ($model, $key, $index, $grid){
                    //return $model->derivadoPor->nombre;
                    return $model->getReferenciaSintesis($model->codigo, $model->proveido);
                },
                
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],
            ],
            
            [
                'label'=>'Fecha Derivación',
                'attribute'=>'fecha_derivacion',
                //'value'=>'fecha_derivacion',
                'format'=>'datetime',
                'value' => function($model) { return $model->fecha_derivacion  . " " . $model->hora_derivacion ;},
                
                'filter' => DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'fecha_derivacion',
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,
                        ]
                    ]),        
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; text-align: center; width:180px;'],        
            ],
                        
            /*[
                'label'=>'Accion/Tipo',
                'attribute'=>'fk_accion',
                'value' => function ($model) {
                        return $model->fkAccion->accion;
                   },
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'fk_accion',
                    'data' => ArrayHelper::map(Acciones::find()->all(), 'id_accion', 'accion'),
                    'options' => [
                               'placeholder' => 'Seleccione'
                           ],
                       'pluginOptions' => [
                              'allowClear' => true
                          ],        
                ]),           
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size:9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],*/            
            
            //'fecha_derivacion',
            //'hora_derivacion',
            //'fecha_recepcion',
            //'hora_recepcion',
            //'fk_accion',
            //'fk_estado',
            //'padre',
            //'oficial',
            //'hijo',
            //'fecha_registro',
            //'hora_registro',
            //'gestion',
            //'confirmado',
            //'activo',
            //'fk_grupo_derivacion',
            //'fk_principal_agrupacion',
            //'numero_copia',
            //'observado',
            //'accion_archivo:ntext',
            //'correlativo_copia',

           /* [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],
            ],*/
            
            [ // begins buttons
                'class' => 'yii\grid\ActionColumn',
                    'header' => 'Opciones',
                    'headerOptions' => ['style' => 'width: 150px;'],
                    'contentOptions'=>['style'=>' border: 1px solid #BEBFC1;'],
                    'template' => '{verdocumento} {seguimiento}',
                    'buttons'=>[
                        
                        
                       /* 'view'=>function($url, $model){
                            
                          return Html::a(
                                        '<span class="btn btn-sm btn-block btn-warning">
                                                <span class="glyphicon glyphicon-eye-open"></span> Ver documento<span>',
                                        $url, ['title'=>'Generar Solicitud']
                                    );
                        },*/
                                
                         'verdocumento'=>function($url, $model, $key) {
                            return Html :: a ('
                                                    <span class="btn btn-sm btn-block btn-warning">
                                                <span class="glyphicon glyphicon-eye-open"></span> Ver documento<span>'
                                                        , '#', [
                                                   'data-toggle' => 'modal',
                                                   'data-target' => '#update-modal',
                                                   'class' => 'data-update',
                                                   'data-id' => $key,
                                               ]);
                        },        
                       
                        'seguimiento'=>function($url, $model){
                            
                          return Html::a(
                                        '<span class="btn btn-sm btn-block btn-primary">
                                            <span class="fa fa-paw"></span> Seguimiento<span>',
                                        $url, ['title'=>'Seguimiento NUR/NURI', 'target'=>'_blank']
                                    );
                        },
                        
                    ],
                    'urlCreator'=>function($action, $model, $key, $index){
                        
                            if($action=='view'){
                               return yii\helpers\Url::to(['garantias/view', 'id'=>$key]); 
                            }
                           
                            if($action=='seguimiento'){
                               return yii\helpers\Url::to(['seguimientos/seguimientonuri', 'nuri'=>$model->codigo]); 
                            }
                                
                    }         
            ], // fin buttons
            
                    
            [ // begin buttons
                'class' => 'yii\grid\ActionColumn',
                    'header' => 'Opciones',
                    'headerOptions' => ['style' => 'width: 150px;'],
                    'contentOptions'=>['style'=>'border: 1px solid #BEBFC1;'],
                    'template' => '{derivar} {imprimirhs}',
                    'buttons'=>[
                                
                        'derivar'=>function($url, $model){
                            
                                return Html::a(
                                        '<span class="btn  btn-sm btn-block btn-success">
                                            <span class="glyphicon glyphicon-hand-right"></span> Derivar<span>',
                                        $url, ['title'=>'Derivar NUR/NURI']
                                    );            
                                                    
                        },
                        'imprimirhs'=>function($url, $model){
                            
                                return Html::a(
                                        '<span class="btn  btn-sm btn-block btn-default active">
                                            <span class="fa fa-file-pdf-o"></span> Imprimir H.S.<span>',
                                        $url, ['title'=>'Imprimir H.S.']
                                    );            
                                                    
                        },        
                                
                    ],
                    'urlCreator'=>function($action, $model, $key, $index){
                        
                            if($action=='derivar'){
                               return yii\helpers\Url::to(['derivarpendiente', 'id'=>$key]); 
                            }
                            if($action=='imprimirhs'){
                               return yii\helpers\Url::to(['imprimirhsadicional', 'id'=>$key, 'nur'=>$model->codigo, 'oficial'=>$model->oficial]); 
                            }
                                
                    }         
            ], // fin buttons        
                    
                    
            [
                'class' => 'yii\grid\ActionColumn',
                    'header' => 'Opciones',
                    'headerOptions' => ['style' => 'width: 150px;'],
                    'contentOptions'=>['style'=>'border: 1px solid #BEBFC1;'],
                    'template' => '{archivar} {anadirrespuesta} ', //{agrupar} 
                    'buttons'=>[
                        'archivar'=>function($url, $model){
                            
                          return Html::a(
                                        '<span class="btn btn-sm btn-block btn-danger">
                                           <span class="glyphicon glyphicon-eye-open"></span> Archivar<span>',
                                        $url, ['title'=>'Archivar Tramite']
                                    );
                        },
                        'agrupar'=>function($url, $model){
                            
                          return Html::a(
                                        '<span class="btn btn-sm btn-block btn-primary">
                                           <span class="glyphicon glyphicon-pencil"></span> Agrupar<span>',
                                        $url, ['title'=>'Agrupar tramites']
                                    );
                        },
                        'anadirrespuesta'=>function($url, $model){
                            
                          return Html::a(
                                        '<span class="btn btn-sm btn-block btn-primary">
                                           <span class="fa fa-file-word-o"></span> Añadir Respuesta<span>',
                                        $url, ['title'=>'Añadir respuesta']
                                    );
                        },
                        
                       /* 'seguimiento'=>function($url, $model){
                            
                          return Html::a(
                                        '<span class="btn btn-success"><span class="glyphicon glyphicon-hand-right"></span><span>',
                                        $url, ['title'=>'Seguimiento Garantia']
                                    );
                        },
                        
                        'reportepdf'=>function($url, $model){
                            
                          return Html::a(
                                        '<span class="btn btn-danger"><span class="glyphicon glyphicon-print "></span> <span>',
                                        $url, ['title'=>'Reporte PDF']
                                    );
                        },
                        'reporteexcel'=>function($url, $model){
                            
                          return Html::a(
                                        '<span class="btn btn-default"><span class="glyphicon glyphicon-file "></span> <span>',
                                        $url, ['title'=>'Reporte PDF']
                                    );
                        }*/
                        
                    ],
                    'urlCreator'=>function($action, $model, $key, $index){
                        
                            if($action=='archivar'){
                                //return yii\helpers\Url::to(['archivo/seleccioncarpeta', 'id_seguimiento'=>$key]);
                                return yii\helpers\Url::to(['archivo/createarchivo', 'id_seguimiento'=>$key]);
                            }
                            if($action=='agrupar'){
                               return yii\helpers\Url::to(['agrupartramites', 'id'=>$key]); 
                            }
                            if($action=='anadirrespuesta'){
                               return yii\helpers\Url::to(['anadirrespuesta', 'id'=>$key]); 
                            }
                            /*if($action=='seguimiento'){
                               return yii\helpers\Url::to(['garantias/seguimientogarantia', 'id'=>$key]); 
                            }
                            if($action=='reportepdf'){
                               return yii\helpers\Url::to(['garantias/reportepdf', 'id'=>$key]); 
                            }
                            if($action=='reporteexcel'){
                               return yii\helpers\Url::to(['garantias/reporteexcel', 'id'=>$key]); 
                            }*/
                                
                    }         
            ], // fin buttons  
                    
                    
                    
                        
                        
                        
        ],
    ]); ?>


</div>


<?php 

//##############################################################################################
//CODIGO PARA MOSTRAR LA VISTA DE LOS DOCUMENTOS
//use yii\bootstrap\Modal;
//Update operation
Modal::begin([
    'id' => 'update-modal',
    'header' => '<h4 class="modal-title">Documento</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Cerrar</a>',
    'size' => 'modal-lg',
]); 

//$requestUpdateUrl=Url::toRoute('actualizar');
$requestUpdateUrl=Url::toRoute('verdocumentopendiente');
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

<script src="<?=Yii::$app->request->baseUrl; ?>/js/jquery.js"></script>

