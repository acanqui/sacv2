<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InstitucionremitenteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Institucionremitentes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="institucionremitente-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Institucionremitente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_institucion_remitente',
            'institucion_remitente',
            'descripcion:ntext',
            'activo',
            'nombre_remitente',
            //'cargo_remitente',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
