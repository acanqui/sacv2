<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GrupoderivacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Grupoderivacions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupoderivacion-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Grupoderivacion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_grupo_derivacion',
            'nombre_grupo',
            'fk_area',
            'fk_usuario',
            'fk_regional',
            //'fecha_registro',
            //'hora_registro',
            //'activo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
