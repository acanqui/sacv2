<style>
.grid-view table thead {
    background-color: #B8C7CD;
}

.grid-view table thead a {
    color: #222D32;
}


</style>
<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Usuarios;
use kartik\date\DatePicker;

use app\models\Seguimientos ;

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
$this->params['breadcrumbs'][] = 'Agrupar trámites';
?>

<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="glyphicon glyphicon-duplicate" style="font-size:25pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 16pt;">Agrupar Tr&aacute;mites</u></b>
          </h5>
        </div>
    </div>
    <div class="col-md-6"></div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card-body" style="text-align:right; width:100% ">
         
            <h5 style="color:#0B4C5F;" >
                <b><span style="font-size:13pt;">NUR/NURI principal</span>&nbsp;&nbsp;&nbsp;
                    <u style="font-size:20pt;"><?=$seguimiento->codigo?></u></b>&nbsp;&nbsp;&nbsp;
            </h5>
         
        </div>
    </div>
    <div class="col-md-6">
     &nbsp;&nbsp;&nbsp;   
     <?php
        echo Html::a("<i style='font-size:15pt;' class='glyphicon glyphicon-print'></i> <br>Imprimir Caratula", ['imprimicaratulaagrupacion', 'id' => $seguimiento->id_seguimiento], ['class' => 'btn btn-primary']); 
        echo " ".Html::a("<i style='font-size:15pt;' class='glyphicon glyphicon-log-out'></i> <br>Derivar Pendiente", ['derivarpendiente', 'id' => $seguimiento->id_seguimiento], ['class' => 'btn btn-success']); 
        echo " ".Html::a("<i style='font-size:15pt;' class='fa fa-user-plus'></i> <br>Añadir Respuesta", ['anadirrespuesta', 'id' => $seguimiento->id_seguimiento], ['class' => 'btn btn-warning']); 
     ?>   
    </div>
</div>

<div class="seguimientos-index">

<div class="card-body">
  <div class="row">
    <div class="col-md-6">
     <div class="card-body pad">
         <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                
                
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
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn',
                     'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],   
                    ],

                    [
                        'label'=>'NUR/NURI',
                        'attribute'=>'codigo',
                        'value'=>'codigo',
                        //'value'=> function($data){   return $data->codigo." - ".$data->id_seguimiento;  },
                        'format'=>'html',
                        'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; text-align:center; font-size:9pt; width:110px;'],
                        'headerOptions'=>['style'=>'color:black;'],
                    ],


                    [
                        'label'=>'Tipo Trámite',
                        'attribute' => 'oficial',
                        'value'=> function($data){
                                                if($data->oficial == 1){
                                                    $info = 'ORIGINAL';
                                                }
                                                if($data->oficial == 0){
                                                    $info = 'COPIA';
                                                }
                                                return $info;
                                            },
                        'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size:9pt;'],
                        'format'=>'html',        
                        'filter'=>Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'oficial',
                            'data' => [1=>'ORIGINAL',0=>'COPIA'],
                            'options' => [
                                //'multiple' => true, 
                                       'placeholder' => 'Seleccione'
                                   ],
                               'pluginOptions' => [
                                      'allowClear' => true
                                  ],        
                        ]),           

                    ],
                    [
                        'label'=>'Proveído',
                        'attribute'=>'proveido',
                        'value'=>'proveido',
                        'format'=>'html',
                        'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; text-align:left; font-size:9pt;'],
                        'headerOptions'=>['style'=>'color:black;'],
                    ],                                


                    //['class' => 'yii\grid\ActionColumn'],
                    [ // begin buttons
                        'class' => 'yii\grid\ActionColumn',
                            'header' => 'Opciones',
                            'headerOptions' => ['style' => 'width: 150px;'],
                            'contentOptions'=>['style'=>'border: 1px solid #BEBFC1;'],
                            'template' => '{agrupar}',
                            'buttons'=>[

                                'agrupar'=>function($url, $model){
                                    
                                    if(Seguimientos::vertificarAgrupado($model->codigo, $model->id_seguimiento)==0){            

                                        return Html::a(
                                                '<span class="btn  btn-sm btn-block btn-success active">Agrupar 
                                                    <span class="glyphicon glyphicon-share-alt"></span><span>',
                                                $url, ['title'=>'Agrupar NUR/NURI']
                                            );            
                                    }    

                                },

                            ],
                            'urlCreator'=>function($action, $model, $key, $index) use ($seguimiento)  {

                                    if($action=='agrupar'){
                                       return yii\helpers\Url::to(['addnuriagrupacion', 'id_principal'=>$seguimiento->id_seguimiento, 'nuri_p'=>$seguimiento->codigo, 'id_hijo'=>$model->id_seguimiento, 'nuri_h'=>$model->codigo, 'oficial'=>$model->oficial]); 
                                                                                                                                            //$id_principal,$nuri_p,$id_hijo,$nuri_h,$oficial
                                    }

                            }         
                    ], // fin buttons                                 
                    
                                                    
                                                    
                                                    
                ],
            ]); ?>
     </div>
    </div>
    
      
    <div class="col-md-6">
     <div class="card-body pad">
         
        <br>
	<table class="table table-bordered table-striped" >
            <tr style="font-size: 10.5pt; " class="bg-success disabled color-palette">
                <th style="border: 1px solid darkgray; background-color: #B8C7CD;">NUR/NURI</th>
		<th style="border: 1px solid darkgray; background-color: #B8C7CD;">Prove&iacute;do</th>
		<th style="border: 1px solid darkgray; background-color: #B8C7CD;">Desagrupar</th>
            </tr>
            <?php $dataReader=Seguimientos::getListaNurisAgrupados($seguimiento->id_seguimiento); ?>	
            <?php foreach ($dataReader as $row) { ?>
              <tr style="font-size: 9pt;"  style="border: 1px solid darkgray;">
                <th style="border: 1px solid darkgray; text-align: center; width: 120px;" valign="middle">
                    <span style="font-size:7pt; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></span><br>  
                    <?=$row['nuri']?>
                </th>
		<td  style="border: 1px solid darkgray;" valign="middle"><?=$row['proveido']?></td>
                <td  style="border: 1px solid darkgray;" valign="middle">
                    <?=Html::a("<i style='font-size:12pt;' class='glyphicon glyphicon-resize-full'></i> Desagrupar", ['deleteagrupacion', 'id_agrupacion' => $row['id_agrupacion']], ['class' => 'btn btn-danger'])?>
                </td>
                
              </tr>
            <?php } ?>
	</table>
         
     </div>
    </div>  
  </div>
</div>    

    
    
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    


</div>
