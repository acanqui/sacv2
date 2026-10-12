<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CarpetaarchivoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use kartik\dialog\Dialog;

echo Dialog::widget([
   'options' => [
                'type' => Dialog::TYPE_WARNING,
                'btnOKClass' => 'btn-warning',
                'size' => Dialog::SIZE_MEDIUM, // large dialog text
       ], // default options
]);
//$this->title = 'Carpetaarchivos';
$this->params['breadcrumbs'][] = 'Carpeta archivo';


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
    'title' => '<b>ERROR EN LA OPERACIÓN</b>',
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
.grid-view table thead {
    background-color: #B8C7CD;
}

.grid-view table thead a {
    color: #222D32;
}
</style>

<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="fa fa-folder-open-o" style="font-size:30pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 18pt;">Carpetas para archivo </u></b>
          </h5>
        </div>
    </div>
    <div class="col-md-6">
       
    </div>
</div>
<br>
<div class="carpetaarchivo-index">
    
    <?= Html::a('<i class="fa fa-file-text"></i> Crear nueva carpeta', ['create'], ['class' => 'btn btn-success']) ?>
    <br>
    <br>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
             'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],   
            ],

            //'id_carpeta_archivo',
            //'nombre_carpeta',
            [
                'label'=>'Nombre Carpeta',
                'attribute'=>'nombre_carpeta',
                'value'=>'nombre_carpeta',
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            //'fk_area',
            //'fk_usuario',
            //'fecha_registro',
            [
                'label'=>'Fecha Registro',
                'attribute'=>'fecha_registro',
                'value'=>'fecha_registro',
                'format'=>'date',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            //'hora_registro',
            //'activo',
            
            [ // begin buttons
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Opciones',
                'headerOptions' => ['style' => 'width: 140px;'],
                'contentOptions'=>['style'=>'border: 1px solid #BEBFC1; text-align: center'],
                'template' => '{view} {editar} {delete}',
                'buttons'=>[

                    'view'=>function($url, $model, $key) {
                        
                       return Html::a(
                            '<span class="btn btn-sm btn-warning active">
                             <span class="glyphicon glyphicon-eye-open"></span><span>',
                             $url, ['title' => Yii::t('app', 'Ver información de resgitro '),] 
                        );  
                    },     
                    
                    'editar'=>function($url, $model){
                        return Html::a(
                            '<span class="btn btn-sm btn-primary active">
                             <span class="fa fa-paint-brush"></span><span>',
                             $url, ['title' => Yii::t('app', 'Modificar datos de registro'),] 
                        );
                    },        
                            
                    'delete'=>function($url, $model){
                        
                        if($model->activo==1){
                            return Html::a(
                                '<span class="btn btn-sm btn-danger active">
                                 <span class="glyphicon glyphicon-trash"></span><span>',
                                 $url, ['title' => Yii::t('app', 'Baja de registro'),
                                        'data' => [
                                                     'confirm' => 'Esta seguro que desea eliminar este registro?',
                                                     'method' => 'post',
                                                  ],
                                      ] 
                            );
                        }
                        else{
                            return Html::a(
                                '<span class="btn btn-sm btn-info active">
                                 <span class="glyphicon glyphicon-ok" style="font-size:12pt;"></span><span>',
                                 $url, ['title' => Yii::t('app', 'Habilitar registro'),
                                        'data' => [
                                                     'confirm' => 'Esta seguro que desea habilitar este usuario?',
                                                     'method' => 'post',
                                                  ],
                                      ] 
                            );
                        }
                    },

                ],
                    'urlCreator'=>function($action, $model, $key, $index){

                        if($action=='view'){
                            return yii\helpers\Url::to(['view', 'id'=>$key]); 
                        }
                        if($action=='editar'){
                            return yii\helpers\Url::to(['update', 'id'=>$key]); 
                        }
                        if($action=='delete'){
                            return yii\helpers\Url::to(['delete', 'id'=>$key]); 
                        }
                        

                    }         
            ], // fin buttons   

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
