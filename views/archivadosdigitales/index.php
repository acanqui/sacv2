<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArchivadosdigitalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Archivadosdigitales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="archivadosdigitales-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Archivadosdigitales', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_archivado_digital',
            'codigo',
            'fecha_archivo',
            'hora_archivo',
            'lugar',
            //'observaciones',
            //'fk_usuario',
            //'fk_seguimiento',
            //'fecha_registro',
            //'hora_registro',
            //'gestion',
            //'activo',
            //'fk_regional',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
