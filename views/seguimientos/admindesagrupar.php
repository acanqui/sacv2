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
/* @var $this yii\web\View */
/* @var $searchModel app\models\SeguimientosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Seguimientos';
$this->params['breadcrumbs'][] = 'Desagrupar NUR/NURI';
?>
<br><br>
<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="glyphicon glyphicon-transfer" style="font-size:30pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 18pt;">Desagrupar Tr&aacute;mites (NUR/NURI)</u></b>
          </h5>
        </div>
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
<div class="seguimientos-index">

    
    <h1><?php //= Html::encode($this->title) ?></h1>

    <p>
        <?php //= Html::a('Create Seguimientos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        //'options' => [ 'class' => 'YourCustomTableClass', ],
        
        
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
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            
            
            
            //'derivado_por',
            
            [
                'label'=>'Derivado Por',
                'attribute' => 'derivado_por',
                'value'=> function ($model, $key, $index, $grid){
                    //return $model->derivadoPor->nombre;
                    return $model->getUsuarioPendientes($model->derivado_por);
                },
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],
                'format'=>'html',        
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'derivado_por',
                    'data' => ArrayHelper::map(Usuarios::find()->all(), 'id_usuario', 'nombre'),
                    'options' => [
                        //'multiple' => true, 
                               'placeholder' => 'Seleccione Funcionario'
                           ],
                       'pluginOptions' => [
                              'allowClear' => true
                          ],        
                ]),           
                        
            ],
            
            //'derivado_a',
            //'proveido:ntext',
            
            [
                'label'=>'Proveido',
                'attribute'=>'proveido',
                //'value'=>'proveido',
                'format'=>'html',
                'value'=> function ($model, $key, $index, $grid){
                    //return $model->derivadoPor->nombre;
                    return $model->getReferenciaSintesis($model->codigo, $model->proveido);
                },
                
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],
            ],
            
            [
                'label'=>'Fecha Derivación',
                'attribute'=>'fecha_derivacion',
                //'value'=>'fecha_derivacion',
                'format'=>'datetime',
                'value' => function($model) { return $model->fecha_derivacion  . " " . $model->hora_derivacion ;},
                
                'filter' => DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'fecha_derivacion',
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,
                        ]
                    ]),        
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; text-align: center; width:180px;'],        
            ],
                        
            [
                'label'=>'Accion/Tipo',
                'attribute'=>'fk_accion',
                'value' => function ($model) {
                        return $model->fkAccion->accion;
                   },
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'fk_accion',
                    'data' => ArrayHelper::map(Acciones::find()->all(), 'id_accion', 'accion'),
                    'options' => [
                               'placeholder' => 'Seleccione'
                           ],
                       'pluginOptions' => [
                              'allowClear' => true
                          ],        
                ]),           
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size:9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],            
            
            //'fecha_derivacion',
            //'hora_derivacion',
            //'fecha_recepcion',
            //'hora_recepcion',
            //'fk_accion',
            //'fk_estado',
            //'padre',
            //'oficial',
            //'hijo',
            //'fecha_registro',
            //'hora_registro',
            //'gestion',
            //'confirmado',
            //'activo',
            //'fk_grupo_derivacion',
            //'fk_principal_agrupacion',
            //'numero_copia',
            //'observado',
            //'accion_archivo:ntext',
            //'correlativo_copia',

           /* [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],
            ],*/
            
            [ // begins buttons
                'class' => 'yii\grid\ActionColumn',
                    'header' => 'Opciones',
                    'headerOptions' => ['style' => 'width: 150px;'],
                    'contentOptions'=>['style'=>' border: 1px solid #BEBFC1;'],
                    'template' => '{verdocumento} {seguimiento}',
                    'buttons'=>[
                        
                        
                       /* 'view'=>function($url, $model){
                            
                          return Html::a(
                                        '<span class="btn btn-sm btn-block btn-warning">
                                                <span class="glyphicon glyphicon-eye-open"></span> Ver documento<span>',
                                        $url, ['title'=>'Generar Solicitud']
                                    );
                        },*/
                                
                         'verdocumento'=>function($url, $model, $key) {
                            return Html :: a ('
                                                    <span class="btn btn-sm btn-block btn-warning">
                                                <span class="glyphicon glyphicon-eye-open"></span> Ver documento<span>'
                                                        , '#', [
                                                   'data-toggle' => 'modal',
                                                   'data-target' => '#update-modal',
                                                   'class' => 'data-update',
                                                   'data-id' => $key,
                                               ]);
                        },        
                       
                        'seguimiento'=>function($url, $model){
                            
                          return Html::a(
                                        '<span class="btn btn-sm btn-block btn-primary">
                                            <span class="fa fa-paw"></span> Seguimiento<span>',
                                        $url, ['title'=>'Seguimiento NUR/NURI',]
                                    );
                        },
                        
                    ],
                    'urlCreator'=>function($action, $model, $key, $index){
                        
                            if($action=='view'){
                               return yii\helpers\Url::to(['garantias/view', 'id'=>$key]); 
                            }
                           
                            if($action=='seguimiento'){
                               return yii\helpers\Url::to(['seguimientos/seguimientonuri', 'nuri'=>$model->codigo]); 
                            }
                                
                    }         
            ], // fin buttons
            
                    
            [ // begin buttons
                'class' => 'yii\grid\ActionColumn',
                    'header' => 'Opciones',
                    'headerOptions' => ['style' => 'width: 150px;'],
                    'contentOptions'=>['style'=>'border: 1px solid #BEBFC1;'],
                    'template' => '{desagrupar}',
                    'buttons'=>[
                                
                        'desagrupar'=>function($url, $model){
                            
                                return Html::a(
                                        '<span class="btn  btn-sm btn-block btn-danger">
                                            <span class="glyphicon glyphicon-transfer"></span> Desagrupar<span>',
                                        $url, ['title'=>'Derivar NUR/NURI']
                                    );            
                                                    
                        },
                                
                    ],
                    'urlCreator'=>function($action, $model, $key, $index){
                        
                            if($action=='desagrupar'){
                               return yii\helpers\Url::to(['desagrupar', 'id'=>$key]); 
                            }
                    }         
            ], // fin buttons        
                    
                    
            
                    
                    
                    
                        
                        
                        
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
$requestUpdateUrl=Url::toRoute('verdocumentopendiente');
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

<script src="<?=Yii::$app->request->baseUrl; ?>/js/jquery.js"></script>

