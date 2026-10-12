<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\dialog\Dialog;
/* @var $this yii\web\View */
/* @var $searchModel app\models\EstadosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Estados';
$this->params['breadcrumbs'][] = 'Estados Seguimientos';

echo Dialog::widget([
   'options' => [
                'type' => Dialog::TYPE_WARNING,
                'btnOKClass' => 'btn-warning',
                'size' => Dialog::SIZE_MEDIUM, // large dialog text
       ], // default options
]);

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
          <h5 style="color:#0B4C5F;" ><i class="glyphicon glyphicon-sort-by-alphabet" style="font-size:30pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 18pt;">Estados de Seguimiento</u></b>
          </h5>
        </div>
    </div>
    <div class="col-md-6">
       
    </div>
</div>
<br>
<div class="estados-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="glyphicon glyphicon-file" style="font-size:14pt;" ></i> Crear nuevo registro', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-hand-left" style="font-size:14pt;" ></i> Atras', ['site/menuadministrador'], ['class' => 'btn btn-warning active']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
             'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],    
            ],

            //'id_estado',
            //'estado',
            [
                'label'=>'Estado',
                'attribute'=>'estado',
                'value'=>'estado',
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            //'descripcion',
            [
                'label'=>'Descripción',
                'attribute'=>'descripcion',
                'value'=>'descripcion',
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            //'activo',
            [
                'label'=>'Estado',
                'attribute'=>'activo',
                'value' => function ($model) {
                        return $model->activo==1?'Habilitado':'Deshabilitado';
                   },
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'activo',
                    'data' => [1=>'Habilitado', 0=>'Deshabilitado'],
                    'options' => [
                               'placeholder' => 'Seleccione'
                           ],
                       'pluginOptions' => [
                              'allowClear' => true
                          ],        
                ]),           
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],

            //['class' => 'yii\grid\ActionColumn'],
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
        ],
    ]); ?>


</div>
