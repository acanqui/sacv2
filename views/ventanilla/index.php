<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VentanillaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ventanillas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ventanilla-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ventanilla', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_ventanilla',
            'correlativo',
            'gestion',
            'fk_usuario',
            'activo',
            //'fk_regional',
            //'sigla',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
