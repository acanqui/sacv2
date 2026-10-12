<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Usuarios;
use app\models\Acciones;
use app\models\Seguimientos;
use kartik\date\DatePicker;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\data\SqlDataProvider;
use kartik\dialog\Dialog;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SeguimientosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use kartik\widgets\Growl;

if (Yii::$app->session->getFlash('success')) {
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
            'timer' => 1700,
        ]
    ]);
}

if (Yii::$app->session->getFlash('error')) {
    echo Growl::widget([
        'type' => Growl::TYPE_DANGER,
        'title' => '<b>ERROR EN LA OPERACION</b>',
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
            'timer' => 1700,
        ]
    ]);
}

//$this->title = 'Seguimientos';
$this->params['breadcrumbs'][] = 'Reporte completo';

echo Dialog::widget();
?>

<br><br>
<div class="row">
    <div class="col-md-6">
        <div class="card-body">
            <h5 style="color:#0B4C5F;"><i class="fa fa-newspaper-o" style="font-size:20pt;"></i>&nbsp;&nbsp;&nbsp;
                <b><u style="font-size: 16pt;">Reporte completo</u></b>
            </h5>
        </div>
    </div>
    <div class="col-md-6" style="text-align: right;">
        <?php
        echo " " . Html::a("<i style='font-size:12pt;' class='fa fa-file-pdf-o'></i> <br>Reporte PDF", ['pdf-completo'], ['class' => 'btn btn-success', 'target' => '_blank']);
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
<div class="row">
    <div class="col-md-12" style="text-align: center;">
        <h1>filtrado</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-9">

        <div class="reporte-index">
            <h2>campos filtrado</h2>
        </div>

    </div>
    <div class="col-md-3">

        <br><br>

    </div>
</div>
