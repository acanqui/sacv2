<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Usuarios;
use app\models\Acciones;
use app\models\Seguimientos;

use kartik\date\DatePicker;

use yii\bootstrap\Modal;
use yii\helpers\Url;



use kartik\dialog\Dialog;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SeguimientosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Seguimientos';
$this->params['breadcrumbs'][] = 'Seguimientos';
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
<style>
.texto {
  font-size:28px;
  font-family:helvetica;
  font-weight:bold;
  color:#DF4040;
  text-transform:uppercase;
}
.parpadear {
  
  animation-name: parpadeo;
  animation-duration: 3s;
  animation-timing-function: linear;
  animation-iteration-count: infinite;

  -webkit-animation-name:parpadeo;
  -webkit-animation-duration: 3s;
  -webkit-animation-timing-function: linear;
  -webkit-animation-iteration-count: infinite;
}

@-moz-keyframes parpadeo{  
  0% { opacity: 1.0; }
  50% { opacity: 0.0; }
  100% { opacity: 1.0; }
}

@-webkit-keyframes parpadeo {  
  0% { opacity: 1.0; }
  50% { opacity: 0.0; }
   100% { opacity: 1.0; }
}

@keyframes parpadeo {  
  0% { opacity: 1.0; }
   50% { opacity: 0.0; }
  100% { opacity: 1.0; }
}
</style>

<div class="row">
    <div class="col-md-12">
        <div class="card-body">
            
            <?php 
            
                //echo "------------->".\app\models\Seguimientos::restarDiasfecha(date('Y-m-d'),1);

                //$fecha=Seguimientos::restarDiasfecha(date('Y-m-d'),1);
                //$total=Seguimientos::bloqueonorecibidos($fecha);

                //echo "<br> total==> ".$total;
            
                //echo "----------> ".Seguimientos::countTotalQueDebenLlegar();
            
            ?>
            
            <center>
                <div class="parpadear texto">
                  <i style="font-size: 20pt; color: #DF4040;" class="fa fa-warning"></i>
                    USUARIO BLOQUEADO<br>
                  <i style="font-size: 40pt; color: #37484F;" class="fa fa-user-times"></i>  
                </div>
                <span style="font-size: 13pt; color: #37484F;"><b>LOS TRÁMITES (NUR/NURIS) DERIVADOS DEBEN SER RECIBIDOS EN UN MÁXIMO DE DOS DÍAS HÁBILES<br>
                LOS SIGUIENTES NUR/NURIS NO FUERON RECIBIDOS POR EL DESTINATARIO    
                </b></span>
            </center>    
        </div>
    </div>
    <!--<div class="col-md-4" style="text-align: right;">
        <?php 
           // echo " ".Html::a("<i style='font-size:12pt;' class='fa fa-file-pdf-o'></i> <br>Reporte PDF", ['generarquedebenllegarpdf'], ['class' => 'btn btn-success', 'target'=>'_blank']);
        ?>
    </div>-->
</div>

<style>
.grid-view table thead {
    background-color: #B8C7CD;
}

.grid-view table thead a {
    color: #222D32;
}
</style>

<!--<hr style="opacity: 0.3;">-->

<div class="seguimientos-index">

    
    <?php //= Html::encode($this->title) ?>

    
        <?php //= Html::a('Create Seguimientos', ['create'], ['class' => 'btn btn-success']) ?>
    

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
                'label'=>'NUR/NURI',
                'attribute'=>'codigo',
                //'value'=>'codigo',
                //'value'=>'$data->getMostrarCodigo()',
                'value' => function ($model) {
                        return $model->getMostrarCodigo($model->oficial, $model->codigo, $model->numero_copia);
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

            [
                'label'=>'Derivado A',
                'attribute' => 'derivado_a',
                'value'=> function ($model, $key, $index, $grid){
                    //return $model->derivadoPor->nombre;
                    return $model->getUsuarioPendientes($model->derivado_a);
                },
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],
                'format'=>'html',        
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'derivado_a',
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




            [ // begins buttons
                'class' => 'yii\grid\ActionColumn',
                    'header' => 'Opciones',
                    'headerOptions' => ['style' => 'width: 130px;'],
                    'contentOptions'=>['style'=>' border: 1px solid #BEBFC1;'],
                    'template' => '{seguimiento}',
                    'buttons'=>[
                        
                        
                       /* 'view'=>function($url, $model){
                            
                          return Html::a(
                                        '<span class="btn btn-sm btn-block btn-warning">
                                                <span class="glyphicon glyphicon-eye-open"></span> Ver documento<span>',
                                        $url, ['title'=>'Generar Solicitud']
                                    );
                        },*/
                        'seguimiento'=>function($url, $model){
                            
                          return Html::a(
                                        '<span class="btn btn-sm btn-primary">
                                            <span class="fa fa-paw"></span> Seguimiento<span>',
                                        $url, ['title'=>'Seguimiento NUR/NURI',]
                                    );
                        },
                        
                    ],
                    'urlCreator'=>function($action, $model, $key, $index){
                           
                            if($action=='seguimiento'){
                               return yii\helpers\Url::to(['seguimientos/seguimientonuri', 'nuri'=>$model->codigo]); 
                            }
                                
                    }         
            ], // fin buttons
            
                    
            [ // begin buttons
                'class' => 'yii\grid\ActionColumn',
                    'header' => 'Opciones',
                    'headerOptions' => ['style' => 'width: 100px;'],
                    'contentOptions'=>['style'=>'border: 1px solid #BEBFC1;'],
                    'template' => '{restaurar}',
                    'buttons'=>[
                        'restaurar'=>function($url, $model){
                            
                                return Html::a(
                                        '<span class="btn btn-sm btn-danger">
                                            <span class="fa fa-upload"></span> Restaurar<span>',
                                        $url, ['title' => Yii::t('app', 'Recibir nNUR/NURI'.$model->codigo), 'data' => [ 'confirm' => Yii::t('app', '¿Esta seguro que desea restaurar el NUR/NURI <b>'.$model->codigo.'</b>?'), 'method' => 'post', ], ] 
                                    );
                        },
                    ],
                    'urlCreator'=>function($action, $model, $key, $index){
                        
                            if($action=='restaurar'){
                               return yii\helpers\Url::to(['seguimientos/reestablecerderivacionnorecibidos', 'id'=>$key]); 
                            }
                                
                    }         
            ], // fin buttons        
                    
                    
       
                        
                        
        ],
    ]); ?>


</div>



<script src="<?=Yii::$app->request->baseUrl; ?>/js/jquery.js"></script>

<?php 

echo Growl::widget([
            'type' => Growl::TYPE_DANGER,
            'title' => '&nbsp; <b>ADVERTENCIA</b>',
            //'icon' => '/images/kartik.png',
            'icon' => 'glyphicon glyphicon-alert',
            'iconOptions' => ['class'=>'img-circle pull-left'],
            'body' => 'Es necesario todos los <b>NUR/NURIs</b> detallados en la parte inferior del sistema sean recibidos. SAC-EEC GNV.',
            'showSeparator' => true,

            //'delay' => 7500,
            'pluginOptions' => [
                //'icon_type'=>'image',
                'showProgressbar' => true,
                'timer'=>3500,
                'mouse_over'=>'pause',
                'placement' => [
                    'from' => 'top',
                    'align' => 'right',
                ],
            ]
        ]);

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