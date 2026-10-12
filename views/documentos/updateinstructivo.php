<?php

use yii\helpers\Html;
use app\models\Documentos;
use app\models\Seguimientos;
use kartik\dialog\Dialog;

use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;


// CODIGO PARA DIALOG
echo Dialog::widget([
   'options' => [
                'type' => Dialog::TYPE_DANGER,
                'btnOKClass' => 'btn-danger',
                'size' => Dialog::SIZE_MEDIUM, // large dialog text
       ], // default options
]);

/* @var $this yii\web\View */
/* @var $model app\models\Documentos */

//$this->title = 'Update Documentos: ' . $model->id_documento;
$this->params['breadcrumbs'][] = ['label' => 'Documentos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id_documento, 'url' => ['view', 'id' => $model->id_documento]];
$this->params['breadcrumbs'][] = 'Actualizar Información';
?>
<link href="<?= Yii::$app->request->baseUrl ?>/css/estilos.css" rel="stylesheet" type="text/css">
<div class="documentos-update">


<?php 


use kartik\widgets\Growl;
if (Yii::$app->session->getFlash('success')){
    echo Growl::widget([
        'type' => Growl::TYPE_SUCCESS,
        'title' => '<b>REGISTRO CORRECTO</b>',
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
    'title' => '<b>ERROR DE REGISTRO</b>',
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
                                            


//##############################################################################################
//CODIGO PARA MOSTRAR LOS NUR/NURIS PENDIENTES
//use yii\bootstrap\Modal;
//Update operation
Modal::begin([
    'id' => 'update-modal',
    'header' => '<h4 class="modal-title">Asignar pendiente</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Cerrar</a>',
    'size' => 'modal-lg',
]); 

//$requestUpdateUrl=Url::toRoute('actualizar');
$requestUpdateUrl=Url::toRoute('hojasruta/asignarpendiente');
$updateJs=<<<JS
    $('.data-update').on('click', function () {
        $.get ('{$requestUpdateUrl}', {id:$(this).data('id')},
            function (data) {
                $('.modal-body').html (data);
            }  
        );
    });
JS;
$this->registerJs($updateJs);
Modal::end();


//##############################################################################################
//CODIGO MOSTRAR LOS DOUCMENTOS CREADOS SIN DERIVAR
Modal::begin([
    'id' => 'creados-modal',
    'header' => '<h4 class="modal-title">Asignar NUR/NURI</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Cerrar</a>',
    'size' => 'modal-lg',
]); 

//$requestUpdateUrl=Url::toRoute('actualizar');
$requestUpdateUrl=Url::toRoute('hojasruta/asignarnuricreado');
$updateJs=<<<JS
    $('.data-creados').on('click', function () {
        $.get ('{$requestUpdateUrl}', {id:$(this).data('id')},
            function (data) {
                $('.modal-body').html (data);
            }  
        );
    });
JS;
$this->registerJs($updateJs);
Modal::end();

?>

    
<?php 
    
    /*$documento_original = Documentos::findOne($model->id_documento);
    $documento_copy = new Documentos();
    $documento_copy->attributes = $documento_original->attributes;
    $documento_copy->isNewRecord = true;
    //$documento_copy->id_documento = null;
    $documento_copy->save();*/
    
?>
    
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card-body">
              <h5 style="color:#0B4C5F;" > 
                  <b><span style="font-size: 25pt;"><img src="<?= Yii::$app->request->baseUrl ?>/images/instructivo.png" style="width:45px;" /> <b>Instructivo</b></span></b>
                  <hr style="width: 90%; color: #DBDBDD; opacity: 0.4;">
              </h5>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card-body">
                
                <?=Html::a("<i style='font-size:15pt;' class='fa fa-plus-square'></i><br><span style='font-size:9pt;'> Nuevo <b>CITE</b></span>", ['documentos/asignarnuevocite', 'id_documento' => $model->id_documento], ['class' => 'btn btn-primary']); ?>
                <?php //=Html::a("<i style='font-size:15pt;' class='fa fa-clipboard'></i><br><span style='font-size:9pt;'> Asignar <b>NURI</b></span>", ['documentos/asignarnuri', 'id_documento' => $model->id_documento], ['class' => 'btn btn-danger']); ?>
                
        <?php if(Documentos::verificarAsignacionNURI($model->id_documento)==0){ ?>
                
                <?=Html::a("<i style='font-size:15pt;' class='fa fa-clipboard'></i><br><span style='font-size:9pt;'> Asignar <b>NURI</b></span>", 
                        ['documentos/asignarnuri', 'id_documento' => $model->id_documento], 
                        [
                            'class' => 'btn btn-danger',
                            'data' => [
                                    'confirm' => Yii::t('app', '¿Seguro desea asignar un nuevo NUR/NURI al cite <b style="color:#222D32">'.$model->codigo.'</b> ?'),
                                    'method' => 'post',
                            ],
                        ]) 
                ?>
                
                <?=Html :: a ("<i style='font-size:15pt;' class='fa fa-list-alt'></i><br><span style='font-size:9pt;'> <b>NURI</b> pendiente</span>"
                                , '#', [
                                        'data-toggle' => 'modal',
                                        'data-target' => '#update-modal',
                                        'class' => 'data-update btn btn-warning',
                                        'data-id' => $model->id_documento,
                                ]);?>
                
                <?=Html :: a ("<i style='font-size:15pt;' class='fa fa-list-ol'></i><br><span style='font-size:9pt;'> <b>NURIs</b> Creados</span>"
                                , '#', [
                                        'data-toggle' => 'modal',
                                        'data-target' => '#creados-modal',
                                        'class' => 'data-creados btn btn-primary',
                                        'data-id' => $model->id_documento,
                                ]);?>
        <?php } // FIN IF ?>
                
                
                
                <?php //=Html::a("<i style='font-size:15pt;' class='fa fa-list-alt'></i><br><span style='font-size:9pt;'> <b>NURI</b> pendiente</span>", ['confirmarpendiente', 'id_seguimiento' => $model->id_documento], ['class' => 'btn btn-warning']); ?>
                <?php //=Html::a("<i style='font-size:15pt;' class='fa fa-list-ol'></i><br><span style='font-size:9pt;'> <b>NURIs</b> Creados</span>", ['confirmarpendiente', 'id_seguimiento' => $model->id_documento], ['class' => 'btn btn-success']); ?>
        <?php if(Documentos::verificarAsignacionNURI($model->id_documento)==1){ ?>  
                <?=Html::a("<i style='font-size:15pt;' class='fa fa-file-word-o'></i><br><span style='font-size:9pt;'> Generar Word</span>", ['instructivoword', 'id_documento' => $model->id_documento], ['class' => 'btn btn-success active']); ?>
        <?php } // FIN IF ?>         
                
                
                <?php 
                    //echo "-----> ".Documentos::getCountChar($model->id_documento);
                    if(Documentos::getCountChar($model->id_documento)>=300){
                        if(Seguimientos::verificarNuriPendiente($model->id_documento)){
                            //echo Html::a("<i style='font-size:15pt;' class='fa fa-share-square'></i><br><span style='font-size:9pt;'>&nbsp;&nbsp;&nbsp; Derivar&nbsp;&nbsp;&nbsp;&nbsp;</span>", ['seguimientos/derivardocumento', 'id_documento' => $model->id_documento], ['class' => 'btn btn-warning']); 
                            // CODIGO PARA MOSTRAR EL BOTON DE DERIVAR NUEVO DOCUMENTO O PENDIENTE
                            Seguimientos::verificarNuriPendienteNuevo($model->id_documento);
                        }
                        else{
                            echo Html::a("<i style='font-size:15pt;' class='fa fa-paw'></i><br><span style='font-size:9pt;'>&nbsp;&nbsp;&nbsp; Seguimiento&nbsp;&nbsp;&nbsp;&nbsp;</span>", ['seguimientos/seguimientonuri', 'nuri' => Documentos::getNuriAsignado($model->id_documento)], ['class' => 'btn btn-warning']); 
                        }
                    }else{
                       
                        echo Growl::widget([
                                'type' => Growl::TYPE_GROWL,
                                'icon' => 'glyphicon glyphicon-warning-sign',
                                'title' => ' Advertencia',
                                'showSeparator' => true,
                                'body' => 'Es necesario que el documento con CITE <b>'.$model->codigo.'</b>, tenga al menos 300 caracteres en el contenido para habilitar la opción de <b>DERIVAR</b>'
                        ]);
                    }    
                ?>
                <p>
                <div style="padding-left: 240px; width: 80%;" class="nurnuri" >
                    <u><?= Documentos::getNuriAsignado($model->id_documento)?></u>
                </div></p>
                
            </div>
        </div>    
    </div>
    

    <?= $this->render('_forminstructivo', [
        'model' => $model,
    ]) ?>

</div>








