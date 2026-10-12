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
$this->params['breadcrumbs'][] = 'Que deben llegar';

echo Dialog::widget();


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
<br><br>
<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="icon fa fa-envelope-o" style="font-size:30pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 18pt;">Tr&aacute;mites que deben llegar (Recepci&oacute;n)</u></b>
          </h5>
        </div>
    </div>
    <div class="col-md-6" style="text-align: right;">
            <?php              
                //$params = array_merge(['seguimientos/exportexcel'], Yii::$app->request->getQueryParams());
            ?>
            <!--<a href="<?php //= Url::to($params); ?>">Export Sasaran Pokok</a>-->
        
        <?php 
            echo " ".Html::a("<i style='font-size:12pt;' class='fa fa-file-pdf-o'></i> <br>Reporte PDF", ['generarquedebenllegarpdf'], ['class' => 'btn btn-success', 'target'=>'_blank']);
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
            
            
            /*[
                'class' => \liyunfang\contextmenu\SerialColumn::className(),
                'contextMenu' => true,
                //'contextMenuAttribute' => 'id',
                'template' => '{view} {update} <li class="divider"></li> {story}', 
                'buttons' => [
                     'story' => function ($url, $model) {
                         $title = Yii::t('app', 'Story');
                         $label = '<span class="glyphicon glyphicon-film"></span> ' . $title;
                         $url = \Yii::$app->getUrlManager()->createUrl(['/user/story','id' => $model->id_seguimiento]);
                         $options = ['tabindex' => '-1','title' => $title, 'data' => ['pjax' => '0' ,  'toggle' => 'tooltip']];
                         return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                      }
                 ],
            ], */
                         
                         
                 
                 
            [
                'class' => 'yii\grid\SerialColumn',
                //'contentOptions' => ['class' => 'table table-dark table-striped table-bordered table-hover'],
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],
            ],

            //'id_seguimiento',
            //'codigo',
            
            [
                'label'=>'NUR/NURI',
                'attribute'=>'codigo',
                //'value'=>'codigo',
                //'value'=>'$data->getMostrarCodigo()',
                'value' => function ($model) {
                        return $model->getMostrarCodigo($model->oficial, $model->codigo, $model->numero_copia)." ".$model->getVerNuriAgrupado($model->codigo);
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
            //'fk_accion',
            [
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
            ],            
            
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
                    'headerOptions' => ['style' => 'width: 130px;'],
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
                                               <span class="btn btn-sm btn-warning">
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
                    'headerOptions' => ['style' => 'width: 110px;'],
                    'contentOptions'=>['style'=>'border: 1px solid #BEBFC1;'],
                    'template' => '{recibir}',
                    'buttons'=>[
                        
                         
                       
                
                                
                        'recibir'=>function($url, $model){
                            
                                return Html::a(
                                        '<span class="btn btn-sm btn-danger">
                                            <span class="fa fa-cloud-download"></span> Recibir<span>',
                                        $url, ['title' => Yii::t('app', 'Recibir nNUR/NURI'.$model->codigo), 'data' => [ 'confirm' => Yii::t('app', '¿Esta seguro que desea recibir el NUR/NURI <b>'.$model->codigo.'</b>?'), 'method' => 'post', ], ] 
                                    );
                                                    
                        },
                                
                    ],
                    'urlCreator'=>function($action, $model, $key, $index){
                        
                            if($action=='recibir'){
                               return yii\helpers\Url::to(['recibirdocumento', 'id_seguimiento'=>$key]); 
                            }
                                
                    }         
            ], // fin buttons        
                    
                    
        /*    [
                'class' => 'yii\grid\ActionColumn',
                    'header' => 'Opciones',
                    'headerOptions' => ['style' => 'border: 1px solid #BEBFC1; width: 200px;'],
                    'contentOptions'=>['style'=>'width: 200px;'],
                    'template' => '{view} {update} {delete} {seguimiento} {reportepdf} {reporteexcel}',
                    'buttons'=>[
                        'view'=>function($url, $model){
                            
                          return Html::a(
                                        '<span class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span><span>',
                                        $url, ['title'=>'Generar Solicitud']
                                    );
                        },
                        'update'=>function($url, $model){
                            
                          return Html::a(
                                        '<span class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span><span>',
                                        $url, ['title'=>'Generar Solicitud']
                                    );
                        },
                        'delete'=>function($url, $model){
                            
                          return Html::a(
                                        '<span class="btn btn-warning"><span class="glyphicon glyphicon-trash"></span><span>',
                                        $url, ['title'=>'Generar Solicitud', 
                                                'data' => [
                                                        'confirm' => 'Esta seguro que desea eliminar este registro?',
                                                        'method' => 'post',
                                                    ],
                                            ]
                                    );
                        },
                        
                        'seguimiento'=>function($url, $model){
                            
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
                        }
                        
                    ],
                    'urlCreator'=>function($action, $model, $key, $index){
                        
                            if($action=='view'){
                               return yii\helpers\Url::to(['garantias/view', 'id'=>$key]); 
                            }
                            if($action=='update'){
                               return yii\helpers\Url::to(['garantias/update', 'id'=>$key]); 
                            }
                            if($action=='delete'){
                               return yii\helpers\Url::to(['garantias/delete', 'id'=>$key]); 
                            }
                            if($action=='seguimiento'){
                               return yii\helpers\Url::to(['garantias/seguimientogarantia', 'id'=>$key]); 
                            }
                            if($action=='reportepdf'){
                               return yii\helpers\Url::to(['garantias/reportepdf', 'id'=>$key]); 
                            }
                            if($action=='reporteexcel'){
                               return yii\helpers\Url::to(['garantias/reporteexcel', 'id'=>$key]); 
                            }
                                
                    }         
            ], // fin buttons  
                    
             */       
                    
                        
                        
                        
        ], // END COLUMNS
        
       /* 'rowOptions' => function($model, $key, $index, $gird){
            $contextMenuId = $gird->columns[0]->contextMenuId;
            return ['data'=>[ 'toggle' => 'context','target'=> "#".$contextMenuId ]];
        },  */          
                    
                    
                    
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

<?php 

/*
use kartik\alert\Alert;

echo Alert::widget([
	'type' => Alert::TYPE_INFO,
	'title' => 'Note',
	'titleOptions' => ['icon' => 'info-sign'],
	'body' => 'This is an informative alert'
]);



use kartik\alert\AlertBlock;

echo AlertBlock::widget([
	'type' => AlertBlock::TYPE_ALERT,
	'useSessionFlash' => true
]);

*/








?>