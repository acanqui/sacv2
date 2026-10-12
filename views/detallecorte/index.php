<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DetallecorteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detallecortes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detallecorte-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Detallecorte', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_corte',
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
            //'fk_corte',
            //'activo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
