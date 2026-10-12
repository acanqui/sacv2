<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Informacionsuic */

$this->title = $model->id_informacion_suic;
$this->params['breadcrumbs'][] = ['label' => 'Informacionsuics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="informacionsuic-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_informacion_suic], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_informacion_suic], [
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
            'id_informacion_suic',
            'fk_documento_sac',
            'nuri',
            'fk_regional',
            'fk_taller',
            'fk_orden_pago',
            'fk_usuario',
            'fecha_registro',
            'hora_registro',
            'activo',
        ],
    ]) ?>

</div>
