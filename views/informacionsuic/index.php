<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InformacionsuicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Informacionsuics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="informacionsuic-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Informacionsuic', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_informacion_suic',
            'fk_documento_sac',
            'nuri',
            'fk_regional',
            'fk_taller',
            //'fk_orden_pago',
            //'fk_usuario',
            //'fecha_registro',
            //'hora_registro',
            //'activo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
