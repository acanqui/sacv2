<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CorrelativosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Correlativos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="correlativos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Correlativos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_correlativo',
            'correlativo',
            'gestion',
            'fk_correlativo',
            'fk_area',
            //'fk_regional',
            //'activo',
            //'fk_tipo_documento',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
