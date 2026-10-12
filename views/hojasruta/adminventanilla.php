<?php

use yii\helpers\Html;
use yii\grid\GridView;


use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Usuarios;
use app\models\Documentos;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $searchModel app\models\HojasrutaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Hojasrutas';
$this->params['breadcrumbs'][] = 'Ventanilla de recepción';


use yii\httpclient\Client;




/*
$client = new Client();
$response = $client->createRequest()
    ->setMethod('POST')
    ->setFormat(Client::FORMAT_JSON)
    ->setUrl('http://repl.eecgnv.gob.bo/WsTallerOrdenPago/controller/SincronizacionDatosControl.php?op=PostOrdenPago')
    ->setData(['dCredencial' => 'WFOayG7j73BDR3434V45345as147',  'dIdTaller' => 448])
    ->send();

if ($response->isOk) {
    // use your data
   
    print_r($response);
    var_dump($response->data);
    //var_dump($response->data);
    
    //$currentObs = $response->data['current_observation']
    
    foreach($response->data as $row){
        echo "<br>".$row['CodigoOrdenPago']." => ".$row['TipoOrden'];
    
        //$talleres[$row['IdTaller']]=$row['Taller'];
    }
    
}*/



/*
$client = new Client();
$response = $client->createRequest()
    ->setMethod('POST')
    ->setFormat(Client::FORMAT_JSON)
    ->setUrl('http://repl.eecgnv.gob.bo/WsTallerOrdenPago/controller/SincronizacionDatosControl.php?op=PostInsertNuri')
    ->setData(['dCredencial'=>'WFOayG7j73BDR3434V45345as147', 'dIdOrdenPago'=>28376, 'dIdTaller'=>448, 'dNuri'=>'LP/2022-00123', 'dCite'=>'448'])
    ->send();

if ($response->isOk) {
    // use your data
   
    //print_r($response);
    var_dump($response->data);
    
    echo "status -----> ".$response->data['status'];
    echo "<br>FechaSincronizacionNuri -----> ".$response->data['FechaSincronizacionNuri'];
    
    
}*/


/*
$client = new Client();
$response = $client->createRequest()
    ->setMethod('POST')
    ->setFormat(Client::FORMAT_JSON)
    ->setUrl('http://repl.eecgnv.gob.bo/WsTallerOrdenPago/controller/SincronizacionDatosControl.php?op=PostTalleres')
    ->setData(['dCredencial' => 'WFOayG7j73BDR3434V45345as147',  'dIdRegional' => 10])
    ->send();

if ($response->isOk) {
    // use your data
    //$responseData = $response->getData();
   
   //print_r($response);
   //var_dump($response->data);
   
   //$currentObs = $response->data['Taller'];
    
    foreach($response->data as $row){
        //echo "<br>".$row['IdTaller']." => ".$row['Taller'];
        $talleres[$row['IdTaller']]=$row["Taller"];
    }
    
}*/

?>
<style>
.grid-view table thead {
    background-color: #B8C7CD;
}

.grid-view table thead a {
    color: #222D32;
}
</style>
<div class="hojasruta-index">

<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="fa fa-stack-overflow" style="font-size:30pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 16pt;">Ventanilla de recepci&oacute;n</u></b>
          </h5>
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
<div class="row">
    <div class="col-md-6">
    </div>    
    <div class="col-md-6">
        <?=" ".Html::a("<i style='font-size:12pt;' class='fa fa-file-pdf-o'></i> <br>Recepci&oacute;n<br>Documentos", ['documentos/createcartaexterna'], ['class' => 'btn btn-primary', ]);?>
        <?=" ".Html::a("<i style='font-size:12pt;' class='fa fa-external-link'></i> <br>Corregir<br>Derivaci&oacute;n", ['seguimientos/corregirderivacion'], ['class' => 'btn btn-success', ]);?>
        <?=" ".Html::a("<i style='font-size:12pt;' class='fa fa-list'></i> <br>Lista<br>Derivaci&oacute;n", ['usuarios/listaderivacion'], ['class' => 'btn btn-warning', ]);?>
        <?=" ".Html::a("<i style='font-size:12pt;' class='fa fa-file-text-o'></i> <br>Acta<br>Recepci&oacute;n", ['seguimientos/actasrecepcion'], ['class' => 'btn btn-danger', ]);?>
    </div>
</div>    

    

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
            [
              'class' => 'yii\grid\SerialColumn',
              'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],  
                
            ],

            //'id_hoja_ruta',
            //'nur',
            [
                //'label'=>'Referencia',
                'attribute'=>'nur',
                'value' => 'nur',
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            [
                //'label'=>'Referencia',
                'attribute'=>'codigo',
                'value' => 'codigo',
                
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],

            /*[
                //'label'=>'Referencia',
                'attribute'=>'codigo',
                //'value' => 'codigo',
                'value' => function ($model) {
                        return $model->mostrarCITE($model->nur);
                        //return $result->referencia;
                   },
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],*/


            //'codigo',
            //'nro',
            //'fecha',
            //'hora',
            [
                'label'=>'Fecha - Hora',
                'attribute'=>'fecha',
                //'value'=>'codigo',
                //'value'=>'$data->getMostrarCodigo()',
               'format'=>'datetime',
                'value' => function($model) { return $model->fecha  . " " . $model->hora ;},
                
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],
                'headerOptions'=>['style'=>'color:black;'],
                'filter' => DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'fecha',
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,
                        ]
                    ]),          
            ],
            [
                'label'=>'Referencia',
                'attribute'=>'fk_documento',
                //'value'=>'fk_documento',
                //'value'=>'$data->getMostrarCodigo()',
                'value' => function ($model) {
                        $result=$model->getDocumentos($model->fk_documento);
                        return $result->referencia;
                   },
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
                'filter' => false,
            ],
            [
                'label'=>'Destino',
                'attribute'=>'fk_documento',
                //'value'=>'fk_documento',
                //'value'=>'$data->getMostrarCodigo()',
                'value' => function ($model) {
                        $result=$model->getDocumentos($model->fk_documento);
                        return $result->destinatario_nombres;
                   },
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
                'filter' => false,           
            ],
            /*[
                'label'=>'Tipo Documento',
                'attribute'=>'fk_documento',
                'value'=>'fk_documento',
                //'value'=>'$data->getMostrarCodigo()',
                'value' => function ($model) {
                        $result=$model->getDocumentos($model->fk_documento);
                        return $result->fkTipoDocumento->tipo_documento;
                   },
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],
                'headerOptions'=>['style'=>'color:black;'],
                'filter' => false,           
            ],*/
        /*    [
                'label'=>'Gestión',
                'attribute' => 'gestion',
                'value'=> 'gestion',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; text-align: center;'],
                'format'=>'html',        
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'gestion',
                    'data' => \app\models\Hojasruta::getGestion(),
                    'options' => [
                        //'multiple' => true, 
                               'placeholder' => 'Sel.'
                           ],
                       'pluginOptions' => [
                              'allowClear' => true
                          ],        
                ]),           
                        
            ],  */             
                           
            //'proceso',
            //'fecha_registro',
            //'hora_registro',
            //'fk_usuario',
            //'gestion',
            //'activo',
            //'fk_documento',
            //'oficial',

            [
               'class' => 'yii\grid\ActionColumn',
               'header' => 'Opciones',
               'headerOptions' => ['style' => 'width: 100px;'],
               'contentOptions'=>['style'=>'border: 1px solid #BEBFC1;'],
               'template' => '{imprimirhs} ',
                    'buttons'=>[
                                
                        'imprimirhs'=>function($url, $model){
                            
                            if(app\models\Hojasruta::countSeguimiento($model->nur)>0){                                
                                    return Html::a(
                                        '<span class="btn btn-sm btn-primary ">
                                            <span class="fa fa-print"></span> Imprimir H.S.<span>',
                                        $url, ['title'=>'Seguimiento NUR/NURI','target' => '_blank', 'data-pjax' => '0',]
                                    );
                            }        
                        },        
                       
                    ],

                                
                    'urlCreator'=>function($action, $model, $key, $index){
                        
                            if($action=='imprimirhs'){
                               return yii\helpers\Url::to(['documentos/generarhrexternopdf', 'id_hoja_ruta' => $model->id_hoja_ruta, 'id_documento' => $model->fk_documento]); 
                            }
                                
                    }  
            ], // end buttons
            [
               'class' => 'yii\grid\ActionColumn',
               'header' => 'Opciones',
               'headerOptions' => ['style' => 'width: 100px;'],
               'contentOptions'=>['style'=>'border: 1px solid #BEBFC1;'],
               'template' => '{modificar}',
                    'buttons'=>[
                       
                        'modificar'=>function($url, $model){
                            
                          return Html::a(
                                        '<span class="btn btn-sm btn-warning">
                                            <span class="fa fa-paint-brush"></span> Modificar<span>',
                                        $url, ['title'=>'Modificar CITE',]
                                    );
                        },
                        
                    ],

                                
                    'urlCreator'=>function($action, $model, $key, $index){
                        
                            if($action=='modificar'){
                                //$direccion ='';
                                $documentos = Documentos::findOne($model->fk_documento);
				$direccion="";
//echo "<br>-->".$documentos->fk_tipo_documento;
//echo "-".$documentos->id_documento;

                                switch ($documentos->fk_tipo_documento) {
                                            case 1:
                                                $direccion='documentos/updateinforme';
                                                break;
                                            case 7:
                                                $direccion='documentos/updatecartaexterna';
                                                break;
                                        }
                                
                                return yii\helpers\Url::to([$direccion, 'id'=>$model->fk_documento]); 
                               //return yii\helpers\Url::to(['documentos/updatecartaexterna', 'nuri'=>$model->nur]); 
                            }
                                
                    }  
            ], // end buttons        
                    
                    
        ],
    ]); ?>


</div>
