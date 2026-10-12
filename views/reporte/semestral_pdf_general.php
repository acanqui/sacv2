<?php

/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var int $busca_usuario */

use yii\helpers\Html;
use app\models\Usuarios;

ini_set("pcre.backtrack_limit", "5000000");

?>

<br>
<table align="center" style="width: 90%;">
	<tr>
		<td style="text-align: center; background-color: #D8D8D8; padding: 7px;">
			<b><u>REPORTE GENERAL NUR/NURI</u></b>
		</td>
	</tr>
</table>
<br>

<hr style="width: 90%;">

<br>

<table class="reporte-tabla">
	<thead>
		<tr>
			<th>#</th>
			<th>NUR/NURI</th>
			<th>CITE</th>
			<th>Referencia</th>
			<th>Fecha de generación del NUR/NURI</th>
			<th>Fecha Derivación del NUR/NURI</th>
			<th>Nombre</th>
			<th>Área/Unidad</th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1; ?>
		<?php foreach ($dataProvider->getModels() as $model):
			// Usuario
			$usuario = Usuarios::findOne($model->fk_usuario);
		?>
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
				<td><?= ($usuario ? Html::encode($usuario->nombre) : 'No encontrado') ?></td>
				<td><?= ($usuario && $usuario->fkArea ? Html::encode($usuario->fkArea->area) : 'No encontrado') ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
