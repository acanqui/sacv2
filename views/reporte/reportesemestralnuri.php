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

use yii\widgets\ActiveForm;

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

$this->params['breadcrumbs'][] = 'Reporte completo';

echo Dialog::widget();
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
    <div class="col-md-6">
        <div class="card-body">
            <h5 style="color:#0B4C5F;"><i class="fa fa-calendar" style="font-size:30pt;"></i>&nbsp;&nbsp;&nbsp;
                <b><u style="font-size: 18pt;">Reporte <strong>NURI</strong></u></b>
            </h5>
        </div>
    </div>

    <div class="col-md-6" style="text-align: right;">
        <!--<?= Html::a(
                "<i class='fa fa-file-pdf-o'></i> <br>Reporte NURI PDF",
                array_merge(['reporte/pdfsemestralnuri'], Yii::$app->request->queryParams),
                ['class' => 'btn btn-success', 'target' => '_blank']
            ); ?>

        <?= Html::a(
            "<i class='fa fa-file-excel-o'></i> <br>Reporte NURI EXCEL",
            array_merge(['reporte/excelsemestralnuri'], Yii::$app->request->queryParams),
            ['class' => 'btn btn-warning', 'target' => '_blank']
        ); ?>-->
    </div>
</div>
<br>

<div class="reporte-semestral-index">

    <h5 style="color:#0B4C5F;"><i class="fa fa-circle" style="font-size:10pt;"></i>&nbsp;&nbsp;&nbsp;
        <b><u style="font-size: 18pt;">General </u></b>
    </h5>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>F. inicio</th>
                <th>F. hasta</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $form = ActiveForm::begin([
                'method' => 'get',
                'id' => 'filter-form-general',
                'action' => ['reporte/generar-reporte-general'], // por defecto va a PDF
            ]); ?>

            <td>
                <?= DatePicker::widget([
                    'name' => 'fecha_inicio_general',
                    'value' => Yii::$app->request->get('fecha_inicio_general'), // mantiene el valor
                    'options' => [
                        'id' => 'fecha-inicio-general',
                        'class' => 'form-control',
                        'autocomplete' => 'off'
                    ],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,
                    ],
                ]); ?>
            </td>

            <td>
                <?= DatePicker::widget([
                    'name' => 'fecha_fin_general',
                    'value' => Yii::$app->request->get('fecha_fin_general'), // mantiene el valor
                    'options' => [
                        'id' => 'fecha-fin-general',
                        'class' => 'form-control',
                        'autocomplete' => 'off'
                    ],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,
                    ],
                ]); ?>
            </td>

            <td>
                <?= Html::submitButton('PDF', [
                    'class' => 'btn btn-danger',
                    'name' => 'submit',
                    'value' => 'pdf'
                ]) ?>

                <?= Html::submitButton('Excel', [
                    'class' => 'btn btn-success',
                    'name' => 'submit',
                    'value' => 'excel'
                ]) ?>
            </td>

            <?php ActiveForm::end(); ?>
        </tbody>
    </table>

    <h5 style="color:#0B4C5F;"><i class="fa fa-circle" style="font-size:10pt;"></i>&nbsp;&nbsp;&nbsp;
        <b><u style="font-size: 18pt;">Usuario </u></b>
    </h5>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Cargo</th>
                <th>Area/unidad</th>
                <th>F. desde</th>
                <th>F. hasta</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= Html::encode($usuario->nombre) ?></td>
                    <td><?= Html::encode($usuario->usuario) ?></td>
                    <td><?= Html::encode($usuario->cargo) ?></td>
                    <td><?= Html::encode($usuario->fkArea->area) ?></td>
                    <?php $form = ActiveForm::begin([
                        'method' => 'get',
                        'id' => 'filter-form-' . $usuario->id_usuario,
                        'action' => ['reporte/generar-reporte-nuri'], // por defecto va a PDF
                    ]); ?>

                    <!-- ID oculto -->
                    <?= Html::hiddenInput('id_usuario', $usuario->id_usuario) ?>

                    <td>
                        <?= DatePicker::widget([
                            'name' => 'fecha_inicio',
                            'value' => Yii::$app->request->get('fecha_inicio'), // mantiene el valor
                            'options' => [
                                'id' => 'fecha-inicio-' . $usuario->id_usuario,
                                'class' => 'form-control',
                                'autocomplete' => 'off'
                            ],
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'autoclose' => true,
                            ],
                        ]); ?>
                    </td>

                    <td>
                        <?= DatePicker::widget([
                            'name' => 'fecha_fin',
                            'value' => Yii::$app->request->get('fecha_fin'), // mantiene el valor
                            'options' => [
                                'id' => 'fecha-fin-' . $usuario->id_usuario,
                                'class' => 'form-control',
                                'autocomplete' => 'off'
                            ],
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'autoclose' => true,
                            ],
                        ]); ?>
                    </td>

                    <td>
                        <?= Html::submitButton('PDF', [
                            'class' => 'btn btn-danger',
                            'name' => 'submit',
                            'value' => 'pdf'
                        ]) ?>

                        <?= Html::submitButton('Excel', [
                            'class' => 'btn btn-success',
                            'name' => 'submit',
                            'value' => 'excel'
                        ]) ?>
                    </td>

                    <?php ActiveForm::end(); ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
