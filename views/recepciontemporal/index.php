<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RecepciontemporalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Recepciontemporals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recepciontemporal-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Recepciontemporal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_recepcion_temporal',
            'fk_seguimiento',
            'nuri',
            'fk_usuario',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
