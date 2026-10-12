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

?>

<center>
<span style="font-size: 12pt; width: 100%; text-align:center;" >
    
    <b style="font-size:12pt;">TR&Aacute;MITES COPIAS PENDIENTES</b><br>
    <b style="font-size:10pt;"><?=Yii::$app->user->identity->nombre?></b>
    
</span>
</center>    
    
<br>

<div class="seguimientos-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        //'options' => [ 'class' => 'YourCustomTableClass', ],
        
        
        'tableOptions'=> ['class'=>'table table-striped table-bordered table-hover'],
        
        'showFooter'=>true,
        'showHeader' => true,
        //'showFooter' => true,
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
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size:12pt;'],
                'headerOptions'=>['style'=>'color:black;'],
                'filter'=>false,           
            ],
            
            
            
            //'derivado_por',
            
            [
                'label'=>'Derivado Por',
                'attribute' => 'derivado_por',
                'value'=> function ($model, $key, $index, $grid){
                    //return $model->derivadoPor->nombre;
                    return $model->getUsuarioPendientes($model->derivado_por);
                },
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;  width:280px;  font-size:12pt;'],
                'format'=>'html',        
                'filter'=>false,           
                        
            ],
            
            //'derivado_a',
            //'proveido:ntext',
            
            [
                'label'=>'Proveído',
                'attribute'=>'proveido',
                //'value'=>'proveido',
                'format'=>'html',
                'value'=> function ($model, $key, $index, $grid){
                    //return $model->derivadoPor->nombre;
                    return $model->getReferenciaSintesis($model->codigo, $model->proveido);
                },
                
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],
                'filter'=>false,        
            ],
            
            [
                'label'=>'Fecha Derivación',
                'attribute'=>'fecha_derivacion',
                //'value'=>'fecha_derivacion',
                'format'=>'datetime',
                'value' => function($model) { return $model->fecha_derivacion  . " " . $model->hora_derivacion ;},
                
                'filter' => false,        
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; text-align: center; width:180px; font-size:11.5pt;'],        
            ],
                        
            [
                'label'=>'Acción/Tipo',
                'attribute'=>'fk_accion',
                'value' => function ($model) {
                        return $model->fkAccion->accion;
                   },
                'filter'=>false,           
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size:11.5pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],            
            
                        
        ],
    ]); ?>


</div>



<script src="<?=Yii::$app->request->baseUrl; ?>/js/jquery.js"></script>

