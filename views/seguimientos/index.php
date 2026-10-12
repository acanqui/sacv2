<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SeguimientosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Seguimientos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seguimientos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Seguimientos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_seguimiento',
            'codigo',
            'derivado_por',
            'derivado_a',
            'proveido:ntext',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
