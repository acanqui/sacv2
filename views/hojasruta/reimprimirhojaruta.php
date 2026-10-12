<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Usuarios;
use app\models\Hojasruta;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HojasrutaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Hojasrutas';
$this->params['breadcrumbs'][] = 'Reimprimir Hoja de Ruta';
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
          <h5 style="color:#0B4C5F;" ><i class="fa fa-print" style="font-size:30pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 16pt;">Reimprimir Hojas de Ruta</u></b>
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
            [
                'label'=>'Gestión',
                'attribute' => 'gestion',
                'value'=> 'gestion',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; text-align: center;'],
                'format'=>'html',        
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'gestion',
                    'data' => Hojasruta::getGestion(),
                    'options' => [
                        //'multiple' => true, 
                               'placeholder' => 'Sel.'
                           ],
                       'pluginOptions' => [
                              'allowClear' => true
                          ],        
                ]),           
                        
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
               'template' => '{imprimirhs} {seguimiento}',
                    'buttons'=>[
                                
                        'imprimirhs'=>function($url, $model){
                            
                            
                            if(Hojasruta::countSeguimiento($model->nur)>0){
                       
                                return Html::a(
                                        '<span class="btn btn-sm btn-block btn-primary ">
                                            <span class="fa fa-print"></span> Imprimir H.S.<span>',
                                        $url, ['title'=>'Seguimiento NUR/NURI', 'target'=>'_blank']
                                    );
                            }    
                        },        
                       
                        'seguimiento'=>function($url, $model){
                            
                            if(Hojasruta::countSeguimiento($model->nur)>0){
                                return Html::a(
                                        '<span class="btn btn-sm btn-block btn-warning">
                                            <span class="fa fa-paw"></span> Seguimiento<span>',
                                        $url, ['title'=>'Seguimiento NUR/NURI',]
                                    );
                            }    
                        },
                        
                    ],

                                
                    'urlCreator'=>function($action, $model, $key, $index){
                        
                            if($action=='imprimirhs'){
                               return yii\helpers\Url::to(['documentos/generarhrinternopdf', 'id_hoja_ruta' => $model->id_hoja_ruta, 'id_documento' => $model->fk_documento]); 
                            }
                           
                            if($action=='seguimiento'){
                               return yii\helpers\Url::to(['seguimientos/seguimientonuri', 'nuri'=>$model->nur]); 
                            }
                                
                    }  
            ],
        ],
    ]); ?>


</div>
