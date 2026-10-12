<?php

use yii\helpers\Html;
use yii\grid\GridView;

use kartik\date\DatePicker;

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Seguimientos;


//use kartik\editable\Editable;
use yii\helpers\Url;

use yii\widgets\Pjax;
use yii\bootstrap\Modal;

use kartik\dialog\Dialog;

//use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SeguimientosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Seguimientos';
$this->params['breadcrumbs'][] = 'Corregir Derivación';
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
          <h5 style="color:#0B4C5F;" ><i class="fa fa-history" style="font-size:30pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 18pt;">Corregir Derivaci&oacute;n</u></b>
          </h5>
        </div>
    </div>
    <div class="col-md-6">
        <!--<div class="card-body" >
          <p style="color:#0B2F3A">
          Opcionalmente, puede ingresar un operador de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> o <b>=</b>) al comienzo de cada uno de sus valores de búsqueda para especificar cómo se debe hacer la comparación.
          </p>
        </div>-->
    </div>
</div>
<br>
<div class="seguimientos-index">

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
<?php

// widget with default options
echo Dialog::widget();


/*
 
// widget with default options
echo Dialog::widget();
 
// buttons for testing the krajee dialog boxes
$btns = <<< HTML
<button type="button" id="btn-alert" class="btn btn-info">Alert</button>
<button type="button" id="btn-confirm" class="btn btn-warning">Confirm</button>
<button type="button" id="btn-prompt" class="btn btn-primary">Prompt</button>
<button type="button" id="btn-dialog" class="btn btn-secondary btn-default">Dialog</button>
HTML;
echo $btns;
 
// javascript for triggering the dialogs
$js = <<< JS
$("#btn-alert").on("click", function() {
    krajeeDialog.alert("This is a Krajee Dialog Alert!")
});
$("#btn-confirm").on("click", function() {
    krajeeDialog.confirm("Are you sure you want to proceed?", function (result) {
        if (result) {
            alert('Great! You accepted!');
        } else {
            alert('Oops! You declined!');
        }
    });
});

$("#btn-dialog").on("click", function() {
    krajeeDialog.dialog(
        'This is a <b>custom dialog</b>. The dialog box is <em>draggable</em> by default and <em>closable</em> ' +
        '(try it). Note that the Ok and Cancel buttons will do nothing here until you write the relevant JS code ' +
        'for the buttons within "options". Exit the dialog by clicking the cross icon on the top right.',
        function (result) {alert(result);}
    );
});
JS;
 
// register your javascript
$this->registerJs($js);
 */

//##############################################################################
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
    
<?php   
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        //'pjax'=>true,
        //'export'=>false,
        
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
            [
                'class' => 'yii\grid\SerialColumn',
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
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 11pt; width: 150px;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            //'derivado_por',
            //'derivado_a',
            [
                'label'=>'Derivado a',
                'attribute'=>'derivado_a',
                'value' => function ($model) {
                        return app\models\Listaderivacion::getNameDestino($model->derivado_a);
                   },
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'derivado_a',
                    'data' => Seguimientos::getListDestino(),
                    'options' => [
                        //'multiple' => true, 
                               'placeholder' => 'Seleccione Funcionario'
                           ],
                       'pluginOptions' => [
                              'allowClear' => true
                          ],        
                ]),           
                           
            ],
            [
                'label'=>'Proveido',
                'attribute'=>'proveido',
                'value' => 'proveido',
                'format' => 'raw',
                //'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 10pt;'],
                'headerOptions'=>['style'=>'color:black;'],
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
                        
                     

            [ // begins buttons
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Opciones',
                'headerOptions' => ['style' => 'width: 130px;'],
                'contentOptions'=>['style'=>' border: 1px solid #BEBFC1; text-align:center;'],
                'template' => '{modificar} ',
                'buttons'=>[
                        
                        'modificar'=>function($url, $model, $key) {
                            return Html :: a ('
                                                <span class="btn btn-sm btn-block btn-primary">
                                                 <span class="fa fa-paint-brush" style="font-size: 11pt;"></span> Modificar</span>'
                                                        , '#', [
                                                   'data-toggle' => 'modal',
                                                   'data-target' => '#update-modal',
                                                   'class' => 'data-update',
                                                   'data-id' => $key,
                                               ]);
                        },
                    ],

            ], // fin buttons
                                
            [ // begins buttons
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Opciones',
                'headerOptions' => ['style' => 'width: 130px;'],
                'contentOptions'=>['style'=>' border: 1px solid #BEBFC1; text-align:center;'],
                'template' => '{reestablecer}',
                'buttons'=>[
                    
                        'reestablecer'=>function($url, $model){
                            
                         /* return Html::a(
                                        '<span class="btn btn-sm btn-block btn-danger">
                                            <span class="fa fa-reply-all" style="font-size: 11pt;"></span> Reestablecer</span>',
                                        $url, [
                                                   'id'=>'btn-confirm',
                                                   //'class' => 'btn btn-warning',
                                                   
                                               ]
                                    );*/
                          
                          
                        return Html::a('<span class="btn btn-sm btn-block btn-danger">
                                            <span class="fa fa-reply-all" style="font-size: 11pt;"></span> Reestablecer</span>', 
                                            $url, 
                                            ['title' => Yii::t('app', 'Reestablecer derivación de: '.$model->codigo), 'data' => [ 'confirm' => Yii::t('app', '¿Esta seguro que desea reestablecer el NUR/NURI <b>'.$model->codigo.'</b>? <br>&nbsp;&nbsp;Esta derivación se eliminará del <b>Seguimiento</b> del sistema'), 'method' => 'post', ], ]);
                        },        
                        
                    ],
                    'urlCreator'=>function($action, $model, $key, $index){
                           
                            if($action=='reestablecer'){
                               return yii\helpers\Url::to(['seguimientos/reestablecerderivacion', 'id'=>$model->id_seguimiento]); 
                            }
                                
                    }               

            ], // fin buttons                    
                    
        ],
    ]); 
                ?>


</div>

<?php 

//##############################################################################################
//CODIGO PARA MOSTRAR LA VISTA DE LOS DOCUMENTOS
//use yii\bootstrap\Modal;
//Update operation
Modal::begin([
    'id' => 'update-modal',
    'header' => '<h4 class="modal-title">Modificar</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Cerrar</a>',
    'size' => 'modal-lg',
]); 

//$requestUpdateUrl=Url::toRoute('actualizar');
$requestUpdateUrl=Url::toRoute('formcorregirderivacionadmin');
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



