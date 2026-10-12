<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

use app\models\Archivo;
use app\models\Seguimientos;
use app\models\Agrupaciones;
use app\models\Regionales;
use app\models\Areas;

use kartik\date\DatePicker;

use yii\bootstrap\Modal;
use yii\helpers\Url;


use kartik\dialog\Dialog;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AgrupacionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Agrupaciones';
$this->params['breadcrumbs'][] = 'Desagrupar';

echo Dialog::widget([
   'options' => [
                'type' => Dialog::TYPE_SUCCESS,
                'btnOKClass' => 'btn-success active',
                'size' => Dialog::SIZE_MEDIUM, // large dialog text
       ], // default options
]);
?>
<br><br>
<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="icon glyphicon glyphicon-transfer" style="font-size:30pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 18pt;">Desagrupar Tr&aacute;mites NUR/NURIs</u></b>
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
           // echo " ".Html::a("<i style='font-size:12pt;' class='fa fa-file-pdf-o'></i> <br>Reporte PDF", ['generararchivopdf'], ['class' => 'btn btn-success active', 'target'=>'_blank']);
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
<div class="agrupaciones-index">

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

            //'id_agrupacion',
            //'nur_padre',
            [
                'label'=>'NUR/NURI principal',
                'attribute'=>'nur_padre',
                'value'=>'nur_padre',
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            //'nur_hijo',
            [
                'label'=>'NUR/NURI secundario',
                'attribute'=>'nur_hijo',
                'value'=>'nur_hijo',
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            //'oficial',
            [
                'label'=>'Tipo Trámite',
                'attribute'=>'oficial',
                //'value'=>'oficial',
                'value'=> function ($model, $key, $index, $grid){
                    
                    if($model->oficial==1){
                        return "<span style='font-size: 7.5pt;'>ORIGINAL</span>";
                    }
                    else{
                        return "<span style='font-size: 7.5pt;'>COPIA</span>";
                    }
                },
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            [
                'label'=>'Fecha Agrupación',
                'attribute'=>'fecha_registro',
                'value'=>'fecha_registro',
                'format'=>'date',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            [
                'label'=>'Usuario Agrupación',
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
                        
            [
                'label'=>'Estado NURI principal',
                'attribute'=>'activo',
                //'value'=>'fk_usuario',
                'value'=> function ($model, $key, $index, $grid){
                    //return $model->derivadoPor->nombre;
                    return Agrupaciones::getEstadoSeguimiento($model->nur_padre);
                },
                'format'=>'html',
                'filter'=>false,
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],            
                        
            //'fk_seguimiento_padre',
            //'fk_seguimiento_hijo',
            //'fk_usuario',
            //'fecha_registro',
            //'hora_registro',
            //'activo',
                        
                        
            [ // begins buttons
                'class' => 'yii\grid\ActionColumn',
                    'header' => 'Opciones',
                    'headerOptions' => ['style' => 'width: 130px;'],
                    'contentOptions'=>['style'=>' border: 1px solid #BEBFC1;'],
                    'template' => '{desagrupar}',
                    'buttons'=>[
                                
                        'desagrupar'=>function($url, $model, $key) {
                    
                            if(Agrupaciones::getIdEstadoSeguimiento($model->nur_padre)!=3 || Agrupaciones::getIdEstadoSeguimiento($model->nur_padre)!=2){
 
                                return Html::a(
                                        '<span class="btn btn-sm btn-block btn-warning active">
                                            <span class="icon glyphicon glyphicon-transfer"></span> Desagrupar<span>',
                                        $url, [
                                                'title'=>'Desarchivar NUR/NURI',
                                                'data' => [ 'confirm' => Yii::t('app', '¿Esta seguro que desea habilitar la opción para desagrupar el NUR/NURI <b>'.$model->nur_padre.'</b>?'), 'method' => 'post', ],
                                              ]
                                    ); 
                            }
                        },        
                       
                        
                    ],
                    'urlCreator'=>function($action, $model, $key, $index){
                        
                            if($action=='desagrupar'){
                               return yii\helpers\Url::to(['habilitardesagrupar', 'nuri'=>$model->nur_padre]); 
                            }
                           
                    }         
            ], // fin buttons
                    
            [ // begins buttons
                'class' => 'yii\grid\ActionColumn',
                    'header' => 'Opciones',
                    'headerOptions' => ['style' => 'width: 130px;'],
                    'contentOptions'=>['style'=>' border: 1px solid #BEBFC1;'],
                    'template' => '{seguimiento}',
                    'buttons'=>[
                                
                       
                        'seguimiento'=>function($url, $model){
                            
                          return Html::a(
                                        '<span class="btn btn-sm btn-block btn-primary">
                                            <span class="fa fa-paw"></span> Seguimiento<span>',
                                        $url, ['title'=>'Seguimiento NUR/NURI', 'target'=>'_blank'] 
                                    );
                        },
                        
                    ],
                    'urlCreator'=>function($action, $model, $key, $index){
                        
                            if($action=='seguimiento'){
                               return yii\helpers\Url::to(['seguimientos/seguimientonuri', 'nuri'=>$model->nur_hijo]); 
                            }
                                
                    }         
            ], // fin buttons        
                    
                    

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
