<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Documentos */

$this->title = $model->id_documento;
$this->params['breadcrumbs'][] = ['label' => 'Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="documentos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_documento], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_documento], [
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
            'id_documento',
            'codigo',
            'destinatario_titulo',
            'destinatario_nombres',
            'destinatario_cargo',
            'destinatario_institucion',
            'remitente_nombres',
            'remitente_cargo',
            'remitente_institucion',
            'referencia:ntext',
            'contenido:ntext',
            'fecha',
            'hora',
            'adjuntos',
            'copias',
            'via_nombres',
            'via_cargo',
            'nro_hojas',
            'gestion',
            'fecha_registro',
            'hora_registro',
            'fk_usuario',
            'fk_tipo_documento',
            'fk_estado_documento',
            'fk_area',
            'fk_documento',
            'ruta_documento',
            'activo',
            'usuario_destino',
            'grupo_destino',
            'nombre_grupo',
            'fk_motivo',
            'observado',
            'enlace_nube',
            'fk_regional_suic',
            'fk_taller_suic',
            'fk_orden_pago_suic',
            'carpeta_pago',
        ],
    ]) ?>

</div>
