<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Agrupaciones */

$this->title = $model->id_agrupacion;
$this->params['breadcrumbs'][] = ['label' => 'Agrupaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="agrupaciones-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_agrupacion], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_agrupacion], [
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
            'id_agrupacion',
            'nur_padre',
            'nur_hijo',
            'oficial',
            'fk_seguimiento_padre',
            'fk_seguimiento_hijo',
            'fk_usuario',
            'fecha_registro',
            'hora_registro',
            'activo',
        ],
    ]) ?>

</div>
