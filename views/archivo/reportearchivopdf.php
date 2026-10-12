<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

use app\models\Usuarios;
use app\models\Seguimientos;
use app\models\Archivo;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArchivoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Archivos';
?>

<center>
<span style="font-size: 12pt; width: 100%; text-align:center;" >
    
    <b style="font-size:12pt;">REPORTE DE ARCHIVO SAC-GNV </b><br>
    <b style="font-size:10pt;"><?=Yii::$app->user->identity->nombre?></b>
    
</span>
</center>    
    
<br>

<div class="archivo-index">

    <?php //= Html::a('Create Archivo', ['create'], ['class' => 'btn btn-success']) ?>
    

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
              'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],  
            ],
            
            [
                'label'=>'Tipo',
                'attribute'=>'oficial',
                //'value'=>'oficial',
                'value' => function ($model) {
                       return $model->oficial==1?'ORIGINAL':'COPIA';
                        
                   },
                'filter'=>false,
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            [
                'label'=>'NUR/NURI',
                'attribute'=>'nuri',
                'value'=>'nuri',
                'format'=>'html',
                'filter'=>false,
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
 	    [
                'label'=>'Fecha Nuri',
                'attribute'=>'oficial',
                //'value'=>'proveido',
                'format'=>'html',
                'value'=> function ($model, $key, $index, $grid){
                    //return $model->derivadoPor->nombre;
                     $row=Seguimientos::getObtenerReferenciaRemitente($model->nuri);
                     return $row['fecha'];

                },
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt;'],
                'filter'=>false,
            ],

            [
                'label'=>'CITE',
                'attribute'=>'oficial',
                //'value'=>'proveido',
                'format'=>'html',
                'value'=> function ($model, $key, $index, $grid){
                    //return $model->derivadoPor->nombre;
                     $row=Seguimientos::getObtenerReferenciaRemitente($model->nuri);
                     return $row['cite'];

                },
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt;'],
                'filter'=>false,
            ],

            [
                'label'=>'Referencia',
                'attribute'=>'oficial',
                //'value'=>'proveido',
                'format'=>'html',
                'value'=> function ($model, $key, $index, $grid){
                    //return $model->derivadoPor->nombre;
                     $row=Seguimientos::getObtenerReferenciaRemitente($model->nuri);
                     return $row['referencia'];

                },
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt;'],
                'filter'=>false,
            ],

            [
                'label'=>'Acciones',
                'attribute'=>'acciones',
                //'value'=>'acciones',
                'value' => function ($model) {
                        return $model->acciones;
                   },
                'format'=>'html',
                'filter'=>false,
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            [
                'label'=>'Nombre Carpeta',
                'attribute'=>'nombre_carpeta',
                'value'=>'nombre_carpeta',
                'filter'=>false,
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            [
                'label'=>'Fecha Archivo',
                'attribute'=>'fecha_archivo',
                'value'=>'fecha_archivo',
                'format'=>'date',
                'filter'=>false,
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; width: 150px; font-size: 9pt; text-align:center;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            [
                'label'=>'Tipo Trámite',
                'attribute'=>'tipo_tramite',
                'value'=>'tipo_tramite',
                'format'=>'html',
                'filter'=>false,
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            
        /*    [
                'label'=>'Usuario Archivo',
                'attribute'=>'fk_usuario',
                //'value'=>'fk_usuario',
                'value'=> function ($model, $key, $index, $grid){
                    //return $model->derivadoPor->nombre;
                    return Seguimientos::getUsuarioPendientes($model->fk_usuario);
                },
                'filter'=>false,        
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ], */              
                           
            /*[
                'label'=>'Observaciones',
                'attribute'=>'observaciones',
                'value'=>'observaciones',
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],*/
                           
            [
                'label'=>'Gestión',
                'attribute'=>'gestion',
                'value'=>'gestion',
                'filter'=>false, 
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt; text-align:right;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],  
            [
                'label'=>'Estado Archivo',
                'attribute'=>'activo',
                //'value'=>'fk_usuario',
                'value'=> function ($model, $key, $index, $grid){
                    return $model->activo==1?'ARCHIVADO':'DESARCHIVADO';
                },
                'filter'=>false,
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],            
           
        ],
    ]); ?>


</div>
