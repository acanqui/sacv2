<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HojasrutaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hojasrutas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hojasruta-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Hojasruta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_hoja_ruta',
            'nur',
            'codigo',
            'nro',
            'fecha',
            //'hora',
            //'proceso',
            //'fecha_registro',
            //'hora_registro',
            //'fk_usuario',
            //'gestion',
            //'activo',
            //'fk_documento',
            //'oficial',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
