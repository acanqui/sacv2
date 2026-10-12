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

use kartik\dialog\Dialog;
echo Dialog::widget([
   'options' => [
                'type' => Dialog::TYPE_PRIMARY,
                'btnOKClass' => 'btn-primary active',
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
<br>
<div class="row">
    
    <div class="col-md-8">
        <div class="card-body">
            
          <h5 style="color:#0B4C5F;" ><i class="fa fa-file-text" style="font-size:25pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><span style="font-size: 17pt;">Documentaci&oacute;n generada</span></b><br><br>
          </h5>
        </div>
        
    </div>
    <div class="col-md-2" style="text-align: right;">
            <?=\yii\helpers\Html::a( '<span class="btn btn-danger">
                                    <span class="glyphicon glyphicon-arrow-left" style="font-size: 11pt;"></span> <br>
                                    Retornar<span>', ['site/index']);?>
    </div>
    <div class="col-md-2" style="text-align: left;">
        <?=Html::a("<i style='font-size:12pt;' class='fa fa-file-pdf-o'></i> <br>Reporte PDF", 
                    ['documentosestadopdf'], 
                    ['class' => 'btn btn-success active', 'target'=>'_blank']);
        ?>
    </div>
    
</div>


<div class="documentos-index">

    <h1><?= Html::encode($this->title) ?></h1>

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
            ['class' => 'yii\grid\SerialColumn',
             'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],
            ],

            //'id_documento',
            //'fk_tipo_documento',
            //'codigo',
        /*    [
                'label'=>'NUR/NURI',
                'attribute'=>'activo',
                'format'=>'html',
                
                'value'=> function ($model, $key, $index, $grid){
                    return $model->getObtenerNuri($model->id_documento);
                },
                        
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;font-size: 10pt; width:120px;'],
                'filter'=>false,
                //'visible'=>'$data->fk_tipo_documento'===4?false:true,
                
            ], */
            
            [
                'label'=>'CITE',
                'attribute'=>'codigo',
                //'value'=>'proveido',
                'format'=>'html',
                'value'=> 'codigo',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;font-size: 9pt;'],
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
                
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
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
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
            ],            
            //'referencia:ntext',
            [
                'label'=>'Fecha/Hora',
                'attribute'=>'fecha',
                'format'=>'datetime',
                'value' => function($model) { return $model->fecha. " " .$model->hora;},
                
                'filter' => DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'fecha',
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,
                        ]
                    ]),        
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; text-align: center; width:180px;font-size: 9pt;'],        
            ],
            
            [
                'label'=>'Tipo',
                'attribute'=>'fk_tipo_documento',
                'format'=>'html',
                
                'value'=> function ($model, $key, $index, $grid){
                    return $model->fkTipoDocumento->tipo_documento;
                },
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'fk_tipo_documento',
                    'data' => Documentos::getListTipoDocumento(),
                    'options' => [
                               'placeholder' => 'Seleccione'
                           ],
                       'pluginOptions' => [
                              'allowClear' => true
                          ],        
                ]),            
                        
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;font-size: 9pt; width:120px;'],
                //'visible'=>'$data->fk_tipo_documento'===4?false:true,
                
            ],
                        
            [
                'label'=>'Estado',
                'attribute'=>'fk_estado_documento',
                'format'=>'html',
                
                'value'=> function ($model, $key, $index, $grid){
                    return $model->fkEstadoDocumento->estado_documento;
                },
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'fk_estado_documento',
                    'data' => Documentos::getListEstadoDocumento(),
                    'options' => [
                               'placeholder' => 'Seleccione'
                           ],
                       'pluginOptions' => [
                              'allowClear' => true
                          ],        
                ]),         
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;font-size: 9pt; width:120px;'],
                //'visible'=>'$data->fk_tipo_documento'===4?false:true,
                
            ],            
            
            //'fecha_registro',
            //'hora_registro',
            //'destinatario_institucion',
            //'remitente_nombres',
            //'remitente_cargo',
            //'remitente_institucion',
            
            //'contenido:ntext',
            //'fecha',
            //'hora',
            //'adjuntos',
            //'copias',
            //'via_nombres',
            //'via_cargo',
            //'nro_hojas',
            //'gestion',
            
            //'fk_usuario',
            //'fk_tipo_documento',
            //'fk_estado_documento',
            //'fk_area',
            //'fk_documento',
            //'ruta_documento',
            //'activo',
            //'usuario_destino',
            //'grupo_destino',
            //'nombre_grupo',
            //'fk_motivo',
            //'observado',
            //'enlace_nube',
            //'fk_regional_suic',
            //'fk_taller_suic',
            //'fk_orden_pago_suic',
            //'carpeta_pago',

        /*    [
              'class' => 'yii\grid\ActionColumn',
              'header' => 'Opciones',
              'headerOptions' => ['style' => 'width: 110px;'],
              'contentOptions'=>['style'=>' border: 1px solid #BEBFC1;'],
              'template' => '{asignarnuevocite}',
                    'buttons'=>[
                                
                        'asignarnuevocite'=>function($url, $model){
                            
                                return Html::a(
                                        '<span class="btn  btn-sm btn-block btn-warning">
                                            <span class="glyphicon glyphicon-plus-sign" style="font-size: 11pt;"></span> Nuevo <b>CITE</b><span>',
                                        $url, ['title'=>'Nuevo CITE', 'data' => [ 'confirm' => Yii::t('app', '¿Esta seguro que desea generar un nuevo <b>CITE</b>?'), 'method' => 'post', ] ]
                                    );            
                                                    
                        },
                    ],
                    'urlCreator'=>function($action, $model, $key, $index){
                        
                            if($action=='asignarnuevocite'){
                               return yii\helpers\Url::to(['asignarnuevocite', 'id_documento'=>$key]); 
                            }
                    }  
            ], // fin array buttons */
        /*    [
              'class' => 'yii\grid\ActionColumn',
              'header' => 'Opciones',
              'headerOptions' => ['style' => 'width: 110px;'],
              'contentOptions'=>['style'=>' border: 1px solid #BEBFC1;'],
              'template' => '{modificardocumento}',
                    'buttons'=>[
                                
                        'modificardocumento'=>function($url, $model){
                            
                                return Html::a(
                                        '<span class="btn  btn-sm btn-block btn-primary">
                                            <span class="fa fa-paint-brush" style="font-size: 11pt;"></span> Modificar<span>',
                                        $url, ['title'=>'Modificar CITE']
                                    );            
                                                    
                        },
                    ],
                    'urlCreator'=>function($action, $model, $key, $index){
                        
                            if($action=='modificardocumento'){
                                
                                        switch ($model->fk_tipo_documento) {
                                            case 1:
                                                $direccion='updateinforme';
                                                break;
                                            case 2:
                                                $direccion='updatenotainterna';
                                                break;
                                            case 3:
                                                $direccion='updatememorandum';
                                                break;
                                            case 4:
                                                $direccion='updatecarta';
                                                break;
                                            case 5:
                                                $direccion='updatecircular';
                                                break;
                                            case 8:
                                                $direccion='updateinstructivo';
                                                break;
                                        }
                                
                                return yii\helpers\Url::to([$direccion, 'id'=>$key]); 
                            }
                    }  
            ], // fin array buttons */
                    
                    
        ],
    ]); ?>


</div>
