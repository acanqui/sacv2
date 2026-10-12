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


use yii\data\SqlDataProvider;
use kartik\dialog\Dialog;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SeguimientosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

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

//$this->title = 'Seguimientos';
$this->params['breadcrumbs'][] = 'Pendientes Bloque';

echo Dialog::widget();
?>
<br><br>
<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="glyphicon glyphicon-folder-open" style="font-size:20pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 16pt;">Tr&aacute;mites Pendientes (Bloque)</u></b>
          </h5>
        </div>
    </div>
    <div class="col-md-6" style="text-align: right;">
       <?php 
            echo " ".Html::a("<i style='font-size:12pt;' class='fa fa-file-pdf-o'></i> <br>Reporte PDF", ['pendientesbloquepdf'], ['class' => 'btn btn-success', 'target'=>'_blank']);
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
<div class="row">
    <div class="col-md-12" style="text-align: center;">
       <?php 
            if(Seguimientos::countderivartemp()>0){
                echo Html::a("<i style='font-size:14pt;' class='glyphicon glyphicon-circle-arrow-right'></i> Siguiente", 
                    ['derivarpendientesbloque'], 
                    [ 'class' => 'btn btn-primary']);
            }    
        ?> 
    </div>   
</div>

<div class="row">
   <div class="col-md-9">
        
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
                    return $model->derivadoPor->nombre;
                    //return $model->getUsuarioPendientes($model->derivado_por);
                },
                
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
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],        
                        
            ],
            
            //'derivado_a',
            //'proveido:ntext',
            
            [
                'label'=>'Proveido',
                'attribute'=>'proveido',
                'value'=>'proveido',
                'format'=>'html',
                /*'value'=> function ($model, $key, $index, $grid){
                    //return $model->derivadoPor->nombre;
                    return $model->getReferenciaSintesis($model->codigo, $model->proveido);
                },*/
                
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
            ],
            
            [
                'label'=>'Fecha Derivación',
                'attribute'=>'fecha_derivacion',
                //'value'=>'fecha_derivacion',
                'format'=>'datetime',
                //'format'=>'datetime',
                'value' => function($model) { return $model->fecha_derivacion  . " " . $model->hora_derivacion ;},
                //'value' => function($model) { return $model->fecha_derivacion  . " " . $model->hora_derivacion ;},
                
                'filter' => DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'fecha_derivacion',
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,
                        ]
                    ]),        
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; text-align: center; width:180px; font-size: 9pt; '],        
            ],
            
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
                    
            [ // begin buttons
                        'class' => 'yii\grid\ActionColumn',
                            'header' => 'Opciones',
                            'headerOptions' => ['style' => 'width: 110px;'],
                            'contentOptions'=>['style'=>'border: 1px solid #BEBFC1; text-align: center'],
                            'template' => '{recibir}',
                            'buttons'=>[





                                'recibir'=>function($url, $model){

                                        return Html::a(
                                                '<span class="btn btn-sm btn-warning">
                                                    <span class="glyphicon glyphicon-log-out"></span> Añadir<span>',
                                                $url, ['title' => Yii::t('app', 'Añadir NUR/NURI para recibir: '.$model->codigo)  ] 
                                            );




                                },

                            ],
                            'urlCreator'=>function($action, $model, $key, $index){

                                    if($action=='recibir'){
                                       return yii\helpers\Url::to(['adderivartemporal', 'id_seguimiento'=>$key]); 
                                    }

                            }         
            ], // fin buttons        
                    
                    
            
                        
                        
        ],
    ]); ?>


</div>
       
   </div>
   <div class="col-md-3">
       
       <br><br>
      <table class="table table-hover table-bordered" style="width: 100%;">
            <thead>
              <tr style="background: #337AB7; color: white;" >
                <th>N.</th>
                <th>NUR/NURI</th>
                <th>Eliminar</th>
              </tr>
            </thead>
            
            <tbody>
              <?php 
                
              $dataReader=Seguimientos::getderivacionbloque();
              $i=0;
               foreach ($dataReader as $row) { 
                        $id_seguimiento=$row['id_derivacion_temporal']  ;
               $i++;  
               if (($i % 2)==0) {
                    $color="style='background: #D5E3F0; opacity:1;'";
                  }
                else{
                  $color="";
                }    

              ?>
                <tr <?=$color?>>
                  <td style="font-size: 9pt; text-align:center;"><?=$i?></td>
                  <td style="font-size: 9pt; text-align:center;"><b><?=$row['tipo']?></b><br><?=$row['nuri']?></td>
                  <td style="font-size: 9pt; text-align:center;">
                    <?=Html::a("<i style='font-size:12pt;' class='fa fa-trash'></i> Eliminar", ['deletederivartemp', 'id'=>$row['id_derivacion_temporal']], ['class' => 'btn btn-sm btn-danger']);?>
                  </td>
                </tr>
              <?php
              } 
              ?>  
            </tbody>
          </table>
       
   </div>   
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

