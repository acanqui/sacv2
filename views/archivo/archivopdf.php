<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

use app\models\Archivo;
use app\models\Seguimientos;

use app\models\Regionales;
use app\models\Areas;

use kartik\date\DatePicker;

use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ArchivoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Archivos';
$this->params['breadcrumbs'][] = 'Desarchivar NUR/NURIs';
?>

<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:black;" >
              <b><span style="font-size: 15pt;">REPORTE DE ARCHIVO SAC-GNV</span></b>
          </h5>
        </div>
    </div>
    <div class="col-md-6" style="text-align: right;">
    </div>
</div>
<br>
<div class="archivo-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions'=> ['class'=>'table table-striped table-bordered table-hover'],
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
             'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;font-size: 9pt;'],   
            ],

            //'id_archivo',
            //'nuri',
            [
                'label'=>'NUR/NURI',
                'attribute'=>'nuri',
                //'value'=>'nuri',
                'value'=> function ($model, $key, $index, $grid){
                    
                    if($model->oficial==1){
                        return $model->nuri."<br><b style='font-size: 7.5pt;'>ORIGINAL</b>";
                    }
                    else{
                        return $model->nuri."<br><b style='font-size: 7.5pt;'>COPIA</b>";
                    }
                },
                'format'=>'html',
                'filter'=>false,
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            //'acciones',
            [
                'label'=>'Acciones',
                'attribute'=>'acciones',
                //'value'=>'acciones',
                'value' => function ($model) {
                        return htmlentities($model->acciones);
                   },
                'format'=>'html',
                'filter'=>false,
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            //'nombre_carpeta',
            [
                'label'=>'Carpeta',
                'attribute'=>'nombre_carpeta',
                'value'=>'nombre_carpeta',
                'format'=>'html',
                'filter'=>false,
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            //'fecha_archivo',
            [
                'label'=>'Fecha Archivo',
                'attribute'=>'fecha_archivo',
                'value'=>'fecha_archivo',
                'format'=>'date',
                'filter'=>false,
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt; text-align: center;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            //'tipo_tramite',
            [
                'label'=>'Tipo Trámite',
                'attribute'=>'tipo_tramite',
                'value'=>'tipo_tramite',
                'format'=>'html',
                'filter'=>false,
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            //'observaciones',
            //'terminado',
            //'gestion',
            [
                'label'=>'Gestión',
                'attribute'=>'gestion',
                'value'=>'gestion',
                'filter'=>false,
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt; text-align: center;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            //'fecha_registro',
            //'hora_registro',
            //'fk_usuario',
            [
                'label'=>'Usuario Archivo',
                'attribute'=>'fk_usuario',
                //'value'=>'fk_usuario',
                'value'=> function ($model, $key, $index, $grid){
                    //return $model->derivadoPor->nombre;
                    return Seguimientos::getUsuarioPendientes($model->fk_usuario);
                },
                'filter'=>false,        
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            //'fk_seguimiento',
            //'fk_regional',
            /*[
                'label'=>'Regional',
                'attribute'=>'fk_regional',
                'value'=>'fk_regional',
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],*/
            [
                'label'=>'Regional',
                'attribute'=>'fk_regional',
                'value' => function ($model) {
                        return $model->getNameRegional($model->fk_regional);
                   },
                'filter'=>false,            
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],            
            //'activo',
            //'oficial',
            /*[
                'label'=>'Oficial',
                'attribute'=>'oficial',
                'value'=>'oficial',
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ], */
            //'fk_area',
            [
                'label'=>'Área/Unidad',
                'attribute'=>'fk_area',
                //'value'=>'fk_area',
                'value' => function ($model) {
                        return $model->getNameArea($model->fk_area);
                   },
                'filter'=>false,           
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],

            
                           
                           
        ],
    ]); ?>


</div>
