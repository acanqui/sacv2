<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Archivo */

$this->title = $model->id_archivo;
$this->params['breadcrumbs'][] = ['label' => 'Archivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="archivo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_archivo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_archivo], [
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
            'id_archivo',
            'nuri',
            'acciones',
            'nombre_carpeta',
            'fecha_archivo',
            'tipo_tramite',
            'observaciones',
            'terminado',
            'gestion',
            'fecha_registro',
            'hora_registro',
            'fk_usuario',
            'fk_seguimiento',
            'fk_regional',
            'activo',
            'oficial',
            'fk_area',
        ],
    ]) ?>

</div>
