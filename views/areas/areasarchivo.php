<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\dialog\Dialog;
use app\models\Regionales;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AreasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Areas';
$this->params['breadcrumbs'][] = 'Áreas/Unidades';

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
          <h5 style="color:#0B4C5F;" ><i class="fa fa-sitemap" style="font-size:30pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 18pt;">&Aacute;reas/Unidades</u></b>
          </h5>
        </div>
    </div>
    <div class="col-md-6">
       
    </div>
</div>

<div class="areas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //= Html::a('<i class="glyphicon glyphicon-hand-left" style="font-size:14pt;" ></i> Reporte de pendientes', ['site/menuadministrador'], ['class' => 'btn btn-success active']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
             'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
            ],

            //'id_area',
            //'area',
            [
                'label'=>'ÁREA/UNIDAD',
                'attribute'=>'area',
                'value'=>'area',
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            //'sigla',
            [
                'label'=>'SIGLA',
                'attribute'=>'sigla',
                'value'=>'sigla',
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            //'cite',
            [
                'label'=>'CITE',
                'attribute'=>'cite',
                'value'=>'cite',
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            //'descripcion',
            /*[
                'label'=>'Regional',
                'attribute'=>'fk_regional',
                'value' => function ($model) {
                        return $model->fkRegional->regional;
                   },
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'fk_regional',
                    'data' => ArrayHelper::map(Regionales::find()->all(), 'id_regional', 'regional'),
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
            ],*/

            //['class' => 'yii\grid\ActionColumn'],
            [ // begin buttons
                'class' => 'yii\grid\ActionColumn',
                'header' => 'PENDIENTES',
                'headerOptions' => ['style' => 'width: 230px;'],
                'contentOptions'=>['style'=>'border: 1px solid #BEBFC1; text-align: center'],
                'template' => '{pendientes_general} {pendientes_resumen}',
                'buttons'=>[

                    
                    'pendientes_general'=>function($url, $model){
                        return Html::a(
                            '<span class="btn btn-sm btn-success active">
                             <span class="fa fa-folder-open"></span> General<span>',
                             $url, ['title' => Yii::t('app', 'Pendientes general'),] 
                        );
                    },
                            
                    'pendientes_resumen'=>function($url, $model){
                        return Html::a(
                            '<span class="btn btn-sm btn-warning active">
                             <span class="fa fa-folder-open-o"></span> Resumen<span>',
                             $url, ['title' => Yii::t('app', 'Resumen de pendientes'),] 
                        );
                    },          
                            
                            
                ],
                    'urlCreator'=>function($action, $model, $key, $index){

                        
                        if($action=='pendientes_general'){
                            return yii\helpers\Url::to(['seguimientos/pendientesareaexcel', 'id'=>$key]); 
                        }
                        if($action=='pendientes_resumen'){
                            return yii\helpers\Url::to(['seguimientos/pendientesarearesumenexcel', 'id'=>$key]); 
                        }

                    }         
            ], // fin buttons
                    
                    
            [ // begin buttons
                'class' => 'yii\grid\ActionColumn',
                'header' => 'OPCIONES',
                'headerOptions' => ['style' => 'width: 300px;'],
                'contentOptions'=>['style'=>'border: 1px solid #BEBFC1; text-align: center'],
                'template' => '{cites} {personal} {archivo}',
                'buttons'=>[

                    'cites'=>function($url, $model, $key) {
                        
                       return Html::a(
                            '<span class="btn btn-sm btn-primary active">
                             <span class="fa fa-file-text-o"></span> CITES<span>',
                             $url, ['title' => Yii::t('app', 'CITES DE AREA'),] 
                        );  
                    },     
                    
                    'personal'=>function($url, $model){
                        return Html::a(
                            '<span class="btn btn-sm btn-danger active">
                             <span class="fa fa-users"></span> Personal<span>',
                             $url, ['title' => Yii::t('app', 'Detalle de personal'),] 
                        );
                    },
                            
                    'archivo'=>function($url, $model){
                        return Html::a(
                            '<span class="btn btn-sm btn-default active">
                             <span class="  fa fa-archive"></span> Archivo<span>',
                             $url, ['title' => Yii::t('app', 'Reporte de archivo'),] 
                        );
                    },       
                            
                    
                            
                            
                ],
                    'urlCreator'=>function($action, $model, $key, $index){

                        if($action=='cites'){
                            return yii\helpers\Url::to(['site/menudocumentosarchivo', 'id'=>$key]); 
                        }
                        if($action=='personal'){
                            return yii\helpers\Url::to(['usuarios/usuariosarea', 'id_area'=>$key]); 
                        }
                        if($action=='archivo'){
                            return yii\helpers\Url::to(['seguimientos/archivoareaexcel', 'id'=>$key]); 
                        }
                        

                    }         
            ], // fin buttons
                    
                    
                    
        ],
    ]); ?>


</div>
