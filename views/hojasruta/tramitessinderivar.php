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
$this->params['breadcrumbs'][] = 'Trámites sin derivar';
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

<h1><?= Html::encode($this->title) ?></h1>

<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="glyphicon glyphicon-duplicate" style="font-size:30pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><span style="font-size: 16pt;">(NURI/NUR) Tramites Sin derivar/Sin confirmar</span></b>
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
                //'value'=>'codigo',
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
                //'value'=>'codigo',
                //'value'=>'$data->getMostrarCodigo()',
                'value' => function ($model) {
                        $result=$model->getDocumentos($model->fk_documento);
                        return $result->destinatario_nombres;
                   },
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],
                'headerOptions'=>['style'=>'color:black;'],
                'filter' => false,           
            ],
            [
                'label'=>'Tipo Documento',
                'attribute'=>'fk_documento',
                //'value'=>'codigo',
                //'value'=>'$data->getMostrarCodigo()',
                'value' => function ($model) {
                        $result=$model->getDocumentos($model->fk_documento);
                        return $result->fkTipoDocumento->tipo_documento;
                   },
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],
                'headerOptions'=>['style'=>'color:black;'],
                'filter' => false,           
            ],
              
                           
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
               'headerOptions' => ['style' => 'width: 150px;'],
               'contentOptions'=>['style'=>'border: 1px solid #BEBFC1;'],
               'template' => '{imprimirhs} {modificar}',
                    'buttons'=>[
                                
                        'imprimirhs'=>function($url, $model){
                            
                          return Html::a(
                                        '<span class="btn btn-block btn-primary ">
                                            <span class="glyphicon glyphicon-hand-right"></span> Derivar H.S.<span>',
                                        $url, ['title'=>'Derivar',]
                                    );
                        },        
                       
                        'modificar'=>function($url, $model){

                                $documentos = Documentos::findOne($model->fk_documento);
                                if($documentos->fk_tipo_documento!=7){
                            
                                    return Html::a(
                                        '<span class="btn btn-block btn-warning">
                                            <span class="fa fa-paint-brush"></span> Modificar<span>',
                                        $url, ['title'=>'Modificar CITE',]
                                    );
                                 }   
                        },
                        
                    ],

                                
                    'urlCreator'=>function($action, $model, $key, $index){
                        
                            if($action=='imprimirhs'){
                               return yii\helpers\Url::to(['seguimientos/derivardocumento', 'id_documento' => $model->fk_documento, 'id_documento' => $model->fk_documento]); 
                            }
                           
                            if($action=='modificar'){
                               //return yii\helpers\Url::to(['seguimientos/seguimientonuri', 'nuri'=>$model->nur]); 
                                    $documentos = Documentos::findOne($model->fk_documento);

                                            //$direccion="";
                                            switch ($documentos->fk_tipo_documento) {
                                                case 1:
                                                    $direccion='documentos/updateinforme';
                                                    break;
                                                case 2:
                                                    $direccion='documentos/updatenotainterna';
                                                    break;
                                                case 3:
                                                    $direccion='documentos/updatememorandum';
                                                    break;
                                                case 4:
                                                    $direccion='documentos/updatecarta';
                                                    break;
                                                case 5:
                                                    $direccion='documentos/updatecircular';
                                                    break;
                                                case 8:
                                                    $direccion='documentos/updateinstructivo';
                                                    break;
                                                case 7:
                                                    $direccion='documentos/updatecartaexterna';
                                                    break;    
                                            }

                                        return yii\helpers\Url::to([$direccion, 'id'=>$documentos->id_documento]); 
                                    
                            }
                                
                    }  
            ],
        ],
    ]); ?>


</div>
