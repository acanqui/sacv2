<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Hojasruta */

$this->title = $model->id_hoja_ruta;
$this->params['breadcrumbs'][] = ['label' => 'Hojasrutas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="hojasruta-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_hoja_ruta], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_hoja_ruta], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_hoja_ruta',
            'nur',
            'codigo',
            'nro',
            'fecha',
            'hora',
            'proceso',
            'fecha_registro',
            'hora_registro',
            'fk_usuario',
            'gestion',
            'activo',
            'fk_documento',
            'oficial',
        ],
    ]) ?>

</div>
