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

$this->params['breadcrumbs'][] = 'Reporte nur';

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
                <b><u style="font-size: 18pt;">Reporte <strong>NUR</strong></u></b>
            </h5>
        </div>
    </div>

    <div class="col-md-6" style="text-align: right;">
        <!--<?= Html::a(
                "<i class='fa fa-file-pdf-o'></i> <br>Reporte PDF",
                array_merge(['reporte/pdfsemestral'], Yii::$app->request->queryParams),
                ['class' => 'btn btn-success',]
            ); ?>

        <?= Html::a(
            "<i class='fa fa-file-excel-o'></i> <br>Reporte EXCEL",
            array_merge(['reporte/excelsemestral'], Yii::$app->request->queryParams),
            ['class' => 'btn btn-warning',]
        ); ?>-->
    </div>
</div>
<br>

<div class="reporte-semestral-index">

    <div>
        <!--<php// $form = ActiveForm::begin(['method' => 'get']); ?>

        <div class="row">
            <div class="col-md-3">
                <php/>/ Html::label('Desde', 'fecha_inicio') ?>
                <php// Html::input('date', 'fecha_inicio', Yii::$app->request->get('fecha_inicio'), ['class' => 'form-control']) ?>
            </div>
            <div class="col-md-3">
                <php// Html::label('Hasta', 'fecha_fin') ?>
                <php// Html::input('date', 'fecha_fin', Yii::$app->request->get('fecha_fin'), ['class' => 'form-control']) ?>
            </div>
            <div class="col-md-3">
                <php// Html::label('Gestión', 'gestion') ?>
                <php// Html::input('text', 'gestion', Yii::$app->request->get('gestion'), ['class' => 'form-control']) ?>
            </div>
        </div>-->
        <script>
            /*$('form').on('submit', function() {
                $(this).find('input').each(function() {
                    if (!$(this).val()) {
                        $(this).prop('disabled', true); // No enviar campos vacíos
                    }
                });
            });*/

            $('.filter-form').on('submit', function() {
                $(this).find('input').each(function() {
                    var type = $(this).attr('type') || '';
                    // no deshabilitar hidden ni botones; sólo inputs visibles que estén vacíos
                    if (type.toLowerCase() !== 'hidden' && type.toLowerCase() !== 'submit' && !$(this).val()) {
                        $(this).prop('disabled', true);
                    }
                });
            });
        </script>

        <!--<?php $form = ActiveForm::begin(['method' => 'get']); ?>
        <div class="col-md-3">
            <?= Html::label('Desde', 'fecha_inicio') ?>
            <?= Html::input('date', 'fecha_inicio', Yii::$app->request->get('fecha_inicio'), ['id' => 'fecha-inicio', 'class' => 'form-control']) ?>
        </div>
        <div class="col-md-3">
            <?= Html::label('Hasta', 'fecha_fin') ?>
            <?= Html::input('date', 'fecha_fin', Yii::$app->request->get('fecha_fin'), ['id' => 'fecha-fin', 'class' => 'form-control']) ?>
        </div>
        <div class="col-md-3">
            <?= Html::label('Gestión', 'gestion') ?>
            <?= Html::input('text', 'gestion', Yii::$app->request->get('gestion'), ['id' => 'gestion', 'class' => 'form-control']) ?>
        </div>
        <div class="col-md-3">
            <?= Html::submitButton('Filtrar', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>-->
    </div>


    <br>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Ventanilla</th>
                <th>Usuario</th>
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

                    <?php $form = ActiveForm::begin([
                        'method' => 'get',
                        'id' => 'filter-form-' . $usuario->id_usuario,
                        'action' => ['reporte/generar-reporte'], // por defecto va a PDF
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

<div class="table-responsive">

    <?php /*GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                    'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                ],

                //'id_hoja_ruta',

                [
                    'attribute' => 'nur',
                    'label' => 'NUR', //nur nuri
                    'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                    'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'tipo_nur', // usamos el atributo personalizado
                        'data' => [
                            'nur' => 'Solo NUR',   // Registros que empiezan con I/
                            'nuri' => 'Solo NURI', // Registros que no empiezan con I/
                        ],
                        'options' => [
                            'placeholder' => 'Seleccionar tipo...', // Texto por defecto
                        ],
                        'pluginOptions' => [
                            'allowClear' => true, // permite limpiar selección
                        ],

                    ]),
                    'filter' => false,
                ],

                [
                    'attribute' => 'codigo',
                    'label' => 'CITE',
                    'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                    'filter' => false,
                ],
                //'nro',
                //'proceso',

                [
                    'label' => 'Fecha Registro',
                    'attribute' => 'fecha_registro',
                    'value' => 'fecha_registro',
                    'format' => ['date', 'php:Y-m-d'],
                    'filter' => '<div class="row"><div class="col-md-6">' .
                        DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'fecha_inicio',
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'autoclose' => true,
                                'orientation' => 'bottom auto',
                            ],
                            'options' => [
                                'autocomplete' => 'off',
                                'placeholder' => 'Desde fecha...', // Aquí desde
                            ],
                        ]) . '</div><div class="col-md-6">' .
                        DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'fecha_fin',
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'autoclose' => true,
                                'orientation' => 'bottom auto',
                            ],
                            'options' => [
                                'autocomplete' => 'off',
                                'placeholder' => 'Hasta fecha...', // Aquí hasta
                            ],
                        ]) . '</div></div>',
                    'contentOptions' => ['style' => 'text-align:center; border: 1px solid #BEBFC1; font-size: 9pt;'],
                    'headerOptions' => ['style' => 'color:black;'],
                ],

                [
                    'attribute' => 'fk_usuario',
                    'label' => 'Usuario',
                    'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                    'value' => function ($model) {
                        return $model->fkUsuario ? $model->fkUsuario->nombre : 'No asignado';
                    },
                    //'filter' => false,
                    'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'fk_usuario',
                        'data' => ArrayHelper::map(\app\models\Usuarios::find()
                            ->andWhere(['like', 'usuario', 'ventanilla-'])
                            ->orderBy('usuario')
                            ->all(), 'id_usuario', 'nombre'), // Ajusta si tienes apellidos también
                        'options' => ['placeholder' => 'Filtrar por usuario'],
                        'pluginOptions' => ['allowClear' => true],
                    ]),
                ],

                [
                    'attribute' => 'gestion',
                    'label' => 'GESTIÓN',
                    'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update}', // Personaliza según tus permisos
                ],
            ],
        ]); */ ?>

</div>
</div>
