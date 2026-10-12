<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\TipoDocumento;
use app\models\Documentos;


/* @var $this yii\web\View */
/* @var $model app\models\Documentos */

$this->title = $model->id_documento;
$this->params['breadcrumbs'][] = ['label' => 'Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="documentos-view">


<?php
/* @var $this SeguimientosController */
/* @var $model Seguimientos */


//$tipo=TipoDocumento::model()->findByPk($model->fk_tipo_documento);
$tipo = TipoDocumento::findOne($model->fk_tipo_documento)
?>
<!-- codigo para mostrar la cabereca -->
<table width="40%" align="center" >
	<tr align="center">
		<td><h3><b><?=$tipo->tipo_documento?></b></h3></td>
	</tr>
	<tr align="center">
		<td><b><?=$model->codigo?></b></td>
	</tr>
	<tr align="center">
		<td><b><?=Documentos::getObtenerNuri($model->id_documento)?></b></td>
	</tr>
</table>
<!--<hr>-->
<table width="70%" align="center" border="0" id="viewCabecera">
<!-- codigo para mostrar al destinatario y via -->
        <?php if ($model->fk_tipo_documento==5) { ?>
	
		<tr>
			<td><b>A: </b></td><td><strong><?=$model->nombre_grupo?></strong></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
			<td><b>De: </b></td><td><?=$model->remitente_nombres?><br><strong><?=$model->remitente_cargo?></strong></td>
		</tr>
		<tr><td><br></td></tr>
		

        <?php } ?>
		<tr>
			<td><b>Fecha: </b></td><td><?=date('d/m/Y',strtotime($model->fecha));?></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
			<td><b>Referencia: </b></td><td><?=$model->referencia?></td>
		</tr>
	</table>	
	<hr>
	<table  width="90%" align="center" border="0" id="viewContenido">
		<tr>
			<td>
				<?=$model->contenido?>
			</td>
		</tr>
	</table>

        
        
        
    <?php //= Html::encode($this->title) ?>
    <?php /*= DetailView::widget([
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
            'contenido:html',
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
    ])*/ ?>

</div>
