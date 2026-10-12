<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DerivaciontemporalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Derivaciontemporals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="derivaciontemporal-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Derivaciontemporal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_derivacion_temporal',
            'fk_seguimiento',
            'nuri',
            'fk_usuario',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
