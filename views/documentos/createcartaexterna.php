<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Documentos */

//$this->title = 'Create Documentos';
$this->params['breadcrumbs'][] = ['label' => 'Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Crear nueva carta';


//##############################################################################################
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
                                            


//##############################################################################################
?>
<div class="documentos-create">

    <div class="row">
        <div class="col-md-10">
            <div class="card-body">
              <h5 style="color:#0B4C5F;" >
                  <b><span style="font-size: 25pt;"><img src="<?= Yii::$app->request->baseUrl ?>/images/carta.png" style="width:45px;" /> <b>Documento Externo</b> </span></b>
                  <hr style="width: 90%; color: #DBDBDD; opacity: 0.4;">
              </h5>
            </div>
        </div>
    </div>
    
    <?= $this->render('_formcartaexterna', [
        'model' => $model,
    ]) ?>

</div>
