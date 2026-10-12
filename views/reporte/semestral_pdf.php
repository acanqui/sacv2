<?php

/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var int $busca_usuario */

use yii\helpers\Html;
use app\models\Usuarios;

$usuario = Usuarios::findOne($busca_usuario);
?>

<br>
<table align="center" style="width: 90%;">
	<tr>
		<td style="text-align: center; background-color: #D8D8D8; padding: 7px;">
			<b><u>REPORTE NUR</u></b>
		</td>
	</tr>
</table>
<br>
<table align="center" width="90%" style="font-size: 10px;">
	<tr>
		<th width="15%" align="right">Nombre: </th>
		<td><?= $usuario ? Html::encode($usuario->nombre) : 'No encontrado' ?></td>
	</tr>
	<tr>
		<th width="15%" align="right">&Aacute;rea/Unidad: </th>
		<td><?= $usuario && $usuario->fkArea ? Html::encode($usuario->fkArea->area) : 'No encontrado' ?></td>
	</tr>
</table>

<hr style="width: 90%;">

<br>

<table class="reporte-tabla">
	<thead>
		<tr>
			<th>#</th>
			<th>NUR</th>
			<th>CITE</th>
			<th>Referencia</th>
			<th>Fecha de generación del NUR</th>
			<th>Fecha Derivación del NUR</th>
			<th>Estado</th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1; ?>
		<?php foreach ($dataProvider->getModels() as $model): ?>
			<tr>
				<td><?= $i++ ?></td>
				<td><?= Html::encode($model->nur) ?></td>
				<td><?= Html::encode($model->codigo) ?></td>
				<td><?= ($model->documento && $model->documento->referencia !== null && strtolower(trim($model->documento->referencia)) !== 'null'
						? Html::encode($model->documento->referencia)
						: 'Sin referencia'
					) ?></td>
				<td><?= Yii::$app->formatter->asDate($model->fecha_registro, 'php:Y-m-d') ?></td>
				<td><?= $model->seguimiento
						? Yii::$app->formatter->asDate($model->seguimiento->fecha_derivacion, 'php:Y-m-d')
						: '<i>No disponible</i>' ?>
				</td>
				<td><?= ($model->seguimiento && $model->seguimiento->fkEstado)
				        ? Html::encode($model->seguimiento->fkEstado->estado)
				        : '<i>Sin estado</i>' ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
