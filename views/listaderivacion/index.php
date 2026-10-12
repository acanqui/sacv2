<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ListaderivacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listaderivacions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="listaderivacion-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Listaderivacion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_lista_derivacion',
            'activo',
            'usuario_origen',
            'usuario_destino',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
