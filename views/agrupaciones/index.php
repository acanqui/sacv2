<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AgrupacionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Agrupaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agrupaciones-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Agrupaciones', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_agrupacion',
            'nur_padre',
            'nur_hijo',
            'oficial',
            'fk_seguimiento_padre',
            //'fk_seguimiento_hijo',
            //'fk_usuario',
            //'fecha_registro',
            //'hora_registro',
            //'activo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
