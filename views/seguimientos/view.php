<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Seguimientos */

$this->title = $model->id_seguimiento;
$this->params['breadcrumbs'][] = ['label' => 'Seguimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="seguimientos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_seguimiento], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_seguimiento], [
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
            'id_seguimiento',
            'codigo',
            'derivado_por',
            'derivado_a',
            'proveido:ntext',
            'fecha_derivacion',
            'hora_derivacion',
            'fecha_recepcion',
            'hora_recepcion',
            'fk_accion',
            'fk_estado',
            'padre',
            'oficial',
            'hijo',
            'fecha_registro',
            'hora_registro',
            'gestion',
            'confirmado',
            'activo',
            'fk_grupo_derivacion',
            'fk_principal_agrupacion',
            'numero_copia',
            'observado',
            'accion_archivo:ntext',
            'correlativo_copia',
        ],
    ]) ?>

</div>
