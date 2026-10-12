<meta charset="UTF-8">
<table border="1" cellpadding="5" cellspacing="0">
	<thead>
		<tr style="background-color: #cccccc; font-weight:bold;">
			<th>NUR</th>
			<th>Código</th>
			<th>Fecha Registro</th>
			<th>Usuario</th>
			<th>Gestión</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($models as $model): ?>
			<tr>
				<td><?= $model->nur ?></td>
				<td><?= $model->codigo ?></td>
				<td><?= Yii::$app->formatter->asDate($model->fecha_registro, 'php:Y-m-d') ?></td>
				<td><?= $model->fkUsuario ? $model->fkUsuario->nombre : 'No asignado' ?></td>
				<td><?= $model->gestion ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
