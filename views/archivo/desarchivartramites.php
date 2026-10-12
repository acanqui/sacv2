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


use kartik\dialog\Dialog;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ArchivoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Archivos';
$this->params['breadcrumbs'][] = 'Desarchivar NUR/NURIs';

echo Dialog::widget([
   'options' => [
                'type' => Dialog::TYPE_PRIMARY,
                'btnOKClass' => 'btn-primary active',
                'size' => Dialog::SIZE_MEDIUM, // large dialog text
       ], // default options
]);


?>

<br><br>
<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="icon fa fa-archive" style="font-size:30pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 18pt;">Desarchivar Tr&aacute;mites NUR/NURIs</u></b>
          </h5>
        </div>
    </div>
    <div class="col-md-6" style="text-align: right;">
            <?php              
                //$params = array_merge(['seguimientos/exportexcel'], Yii::$app->request->getQueryParams());
            ?>
            <!--<a href="<?php //= Url::to($params); ?>">Export Sasaran Pokok</a>-->
        
        <?php 
            
            echo " ".Html::a("<i style='font-size:12pt;' class='glyphicon glyphicon-hand-left'></i> <br>&nbsp;&nbsp;&nbsp;Atras&nbsp;&nbsp;&nbsp;", ['site/menuopciones'], ['class' => 'btn btn-danger active']);
            echo " ".Html::a("<i style='font-size:12pt;' class='fa fa-file-pdf-o'></i> <br>Reporte PDF", ['generararchivopdf'], ['class' => 'btn btn-success active', 'target'=>'_blank']);
        ?>
    </div>
</div>

<style>
.grid-view table thead {
    background-color: #B8C7CD;
}

.grid-view table thead a {
    color: #222D32;
}
</style>

<hr style="opacity: 0.3;">
<div class="archivo-index">

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
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            //'acciones',
            [
                'label'=>'Acciones',
                'attribute'=>'acciones',
                'value'=>'acciones',
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            //'nombre_carpeta',
            [
                'label'=>'Carpeta',
                'attribute'=>'nombre_carpeta',
                'value'=>'nombre_carpeta',
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            //'fecha_archivo',
            [
                'label'=>'Fecha Archivo',
                'attribute'=>'fecha_archivo',
                'value'=>'fecha_archivo',
                'format'=>'date',
                'filter' => DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'fecha_archivo',
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,
                        ]
                    ]),
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt; text-align: center;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            //'tipo_tramite',
        /*    [
                'label'=>'Tipo Trámite',
                'attribute'=>'tipo_tramite',
                'value'=>'tipo_tramite',
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],*/
            //'observaciones',
            //'terminado',
            //'gestion',
            [
                'label'=>'Gestión',
                'attribute'=>'gestion',
                'value'=>'gestion',
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'gestion',
                    'data' => Archivo::getListGestion(),
                    'options' => [
                               'placeholder' => 'Sel'
                           ],
                       'pluginOptions' => [
                              'allowClear' => true
                          ],        
                ]),
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
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'fk_area',
                    'data' => ArrayHelper::map(Areas::find()->all(), 'id_area', 'area'),
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
            [
                'label'=>'Estado Archivo',
                'attribute'=>'activo',
                //'value'=>'fk_usuario',
                'value'=> function ($model, $key, $index, $grid){
                    return $model->activo==1?'ARCHIVADO':'DESARCHIVADO';
                },
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'activo',
                    'data' => [1=>'ARCHIVADO', 0=>'DESARCHIVADO'],
                    'options' => [
                               'placeholder' => 'Sel.'
                           ],
                       'pluginOptions' => [
                              'allowClear' => true
                          ],        
                ]),        
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],               

            [ // begins buttons
                'class' => 'yii\grid\ActionColumn',
                    'header' => 'Opciones',
                    'headerOptions' => ['style' => 'width: 130px;'],
                    'contentOptions'=>['style'=>' border: 1px solid #BEBFC1;'],
                    'template' => '{dearchivar} {seguimiento}',
                    'buttons'=>[
                                
                        'dearchivar'=>function($url, $model, $key) {
 
                            if($model->activo==1){
                                return Html::a(
                                        '<span class="btn btn-sm btn-block btn-warning active">
                                            <span class="fa fa-archive"></span> Desarchivar<span>',
                                        $url, [
                                                'title'=>'Desarchivar NUR/NURI',
                                                'data' => [ 'confirm' => Yii::t('app', '¿Esta seguro que desea desarchivar el NUR/NURI <b>'.$model->nuri.'</b>?'), 'method' => 'post', ],
                                              ]
                                    ); 
                            }    
                        },        
                       
                        'seguimiento'=>function($url, $model){
                            
                          return Html::a(
                                        '<span class="btn btn-sm btn-block btn-primary">
                                            <span class="fa fa-paw"></span> Seguimiento<span>',
                                        $url, ['title'=>'Seguimiento NUR/NURI', 'target'=>'_blank']
                                    );
                        },
                        
                    ],
                    'urlCreator'=>function($action, $model, $key, $index){
                        
                            if($action=='dearchivar'){
                               return yii\helpers\Url::to(['desarchivar', 'id_seguimiento'=>$model->fk_seguimiento, 'id_archivo'=>$model->id_archivo]); 
                            }
                           
                            if($action=='seguimiento'){
                               return yii\helpers\Url::to(['seguimientos/seguimientonuri', 'nuri'=>$model->nuri]); 
                            }
                                
                    }         
            ], // fin buttons
                    
                    
                           
                           
        ],
    ]); ?>


</div>
