<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Archivadosdigitales */

$this->title = $model->id_archivado_digital;
$this->params['breadcrumbs'][] = ['label' => 'Archivadosdigitales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="archivadosdigitales-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_archivado_digital], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_archivado_digital], [
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
            'id_archivado_digital',
            'codigo',
            'fecha_archivo',
            'hora_archivo',
            'lugar',
            'observaciones',
            'fk_usuario',
            'fk_seguimiento',
            'fecha_registro',
            'hora_registro',
            'gestion',
            'activo',
            'fk_regional',
        ],
    ]) ?>

</div>
