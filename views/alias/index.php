<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AliasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Aliases';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alias-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Alias', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_alias',
            'nombre',
            'cargo',
            'descripcion',
            'fk_usuario',
            //'activo',
            //'fecha_registro',
            //'hora_registro',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
