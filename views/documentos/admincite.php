<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\date\DatePicker;

use app\models\Documentos;
use app\models\Usuarios;
use yii\bootstrap\Modal;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Documentos';
$this->params['breadcrumbs'][] = 'Administración de documentos';
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
            
          <h5 style="color:#0B4C5F;" ><i class="fa fa-file-pdf-o" style="font-size:25pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><span style="font-size: 17pt;">    <?=Documentos::getNameTipoDocumento($tipo)." - ".$gestion?></span></b><br><br>
          </h5>
        </div>
        <?=\yii\helpers\Html::a( '<span class="btn btn-success">
                                    <span class="glyphicon glyphicon-arrow-left" style="font-size: 11pt;"></span> 
                                    Retornar<span>', ['site/menucites'])." ";?>
        
        <?=\yii\helpers\Html::a( '<span class="btn btn-danger">
                                    <span class="fa fa-file-excel-o" style="font-size: 11pt;"></span> 
                                    Reporte <b>EXCEL</b><span>', ['documentos/reportecite', 'tipo'=>$tipo, 'gestion'=>$gestion, 'id_area'=>Yii::$app->user->identity->fk_area]);?>
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
            [
                'label'=>'NUR/NURI',
                'attribute'=>'activo',
                'format'=>'html',
                
                'value'=> function ($model, $key, $index, $grid){
                    return $model->getObtenerNuri($model->id_documento);
                },
                        
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;font-size: 10pt; width:120px;'],
                'filter'=>false,
                //'visible'=>'$data->fk_tipo_documento'===4?false:true,
                
            ], 
            
            [
                'label'=>'CITE',
                'attribute'=>'codigo',
                //'value'=>'proveido',
                'format'=>'html',
                'value'=> 'codigo',
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
                
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 10pt;'],
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
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 10pt;'],
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
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; text-align: center; width:180px;font-size: 10pt;'],        
            ],
            [
                'label'=>'Usuario/Autor',
                'attribute'=>'fk_usuario',
                //'value'=> 'fk_usuario',
                'value'=> function ($model, $key, $index, $grid){
                    //return $model->derivadoPor->nombre;
                    return $model->fkUsuario->nombre;
                },
                'format'=>'ntext',
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'fk_usuario',
                        'data' => ArrayHelper::map(Usuarios::find()->where(['=', 'fk_area', Yii::$app->user->identity->fk_area])->andWhere(['=', 'activo', 1])->all(), 'id_usuario', 'nombre'),
                    'options' => [
                        //'multiple' => true, 
                               'placeholder' => 'Seleccione Funcionario'
                           ],
                       'pluginOptions' => [
                              'allowClear' => true
                          ],        
                ]),
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 10pt;'],
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

            
            [
              'class' => 'yii\grid\ActionColumn',
              'header' => 'Opciones',
              'headerOptions' => ['style' => 'width: 110px;'],
              'contentOptions'=>['style'=>' border: 1px solid #BEBFC1;'],
              'template' => '{verdocumento}',
                    'buttons'=>[
                                
                        'verdocumento'=>function($url, $model, $key) {
                            return Html :: a ('
                                               <span class="btn btn-sm btn-block btn-primary" style="font-size: 11pt;">
                                                <span class="glyphicon glyphicon-eye-open"></span> Ver documento<span>'
                                                        , '#', [
                                                   'data-toggle' => 'modal',
                                                   'data-target' => '#update-modal',
                                                   'class' => 'data-update',
                                                   'data-id' => $key,
                                               ]);
                        },
                    ],
                    
            ], // fin array buttons
                    
                    
        ],
    ]); ?>
    
</div>

<?php 

//##############################################################################################
//CODIGO PARA MOSTRAR LA VISTA DE LOS DOCUMENTOS
//use yii\bootstrap\Modal;
//Update operation
Modal::begin([
    'id' => 'update-modal',
    'header' => '<h4 class="modal-title">Documento</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Cerrar</a>',
    'size' => 'modal-lg',
]); 

//$requestUpdateUrl=Url::toRoute('actualizar');
$requestUpdateUrl=Url::toRoute('seguimientos/verdocumentogenerado');
$updateJs=<<<JS
    $('.data-update').on('click', function () {
        $.get ('{$requestUpdateUrl}', {id:$(this).closest('tr').data('key')},
            function (data) {
                $('.modal-body').html (data);
            }  
        );
    });
JS;
$this->registerJs($updateJs);
Modal::end();

?>
