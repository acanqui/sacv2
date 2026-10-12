<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Documentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Documentos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_documento',
            'codigo',
            'destinatario_titulo',
            'destinatario_nombres',
            'destinatario_cargo',
            //'destinatario_institucion',
            //'remitente_nombres',
            //'remitente_cargo',
            //'remitente_institucion',
            //'referencia:ntext',
            //'contenido:ntext',
            //'fecha',
            //'hora',
            //'adjuntos',
            //'copias',
            //'via_nombres',
            //'via_cargo',
            //'nro_hojas',
            //'gestion',
            //'fecha_registro',
            //'hora_registro',
            //'fk_usuario',
            //'fk_tipo_documento',
            //'fk_estado_documento',
            //'fk_area',
            //'fk_documento',
            //'ruta_documento',
            //'activo',
            //'usuario_destino',
            //'grupo_destino',
            //'nombre_grupo',
            //'fk_motivo',
            //'observado',
            //'enlace_nube',
            //'fk_regional_suic',
            //'fk_taller_suic',
            //'fk_orden_pago_suic',
            //'carpeta_pago',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
