<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\date\DatePicker;

use app\models\Documentos;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Documentos';
$this->params['breadcrumbs'][] = 'Administración de documentos';
?>

<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <i class="glyphicon glyphicon-envelope" style="font-size:20pt;" ></i>
          <b><span style="font-size: 14pt;">CITEs sin n&uacute;mero de tr&aacute;mite (NUR/NURI)</span></b><br>
          <b style="font-size:10pt;"><?=Yii::$app->user->identity->nombre?></b>
        </div>
    </div>
    
</div>

<br>
<div class="documentos-index">
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
                'label'=>'CITE',
                'attribute'=>'codigo',
                //'value'=>'proveido',
                'format'=>'html',
                'value'=> 'codigo',
                'filter'=>false,
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;font-size: 10pt;'],
            ],
                        
            [
                'label'=>'Nombre Destino',
                'attribute'=>'destinatario_nombres',
                //'value'=>'proveido',
                'format'=>'html',
                'value'=> function ($model, $key, $index, $grid){
                    //return $model->derivadoPor->nombre;
                    return $model->destinatario_nombres."<br> <b style='font-size: 9pt'><i>".$model->destinatario_cargo."</i></b>";
                },
                'filter'=>false,
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 10pt; width:300px; '],
            ],            
            //'destinatario_titulo',
            //'destinatario_nombres',
            //'destinatario_cargo',
            [
                'label'=>'Referencia',
                'attribute'=>'referencia',
                //'value'=>'proveido',
                'format'=>'ntext',
                'value'=> 'referencia',
                'filter'=>false,
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 10pt;'],
            ],            
            //'referencia:ntext',
            [
                'label'=>'Fecha/Hora',
                'attribute'=>'fecha',
                'format'=>'datetime',
                'value' => function($model) { return $model->fecha. " " .$model->hora;},
                
                'filter'=>false,
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; text-align: center; width:180px;font-size: 10pt;'],        
            ],
                        
            [
                'label'=>'Tipo Documento',
                'attribute'=>'fk_tipo_documento',
                'value' => function($model) { return $model->fkTipoDocumento->tipo_documento;},
                
                'format'=>'html',
                'filter'=>false,
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;font-size: 10pt;'],
            ],
            [
                'label'=>'Gestión',
                'attribute'=>'gestion',
                'value' => 'gestion',
                'format'=>'html',
                'filter'=>false,
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;font-size: 10pt;'],
            ],             
                        
                        
                        
        ],
    ]); ?>


</div>
