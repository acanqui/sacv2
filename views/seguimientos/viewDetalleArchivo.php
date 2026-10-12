<?php
use app\models\Seguimientos;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//$row=Seguimientos::getInfoArchivo($id_seguimiento);

// codigo para verificar si existe el id de seguimiento
if (Seguimientos::countIdSeguimiento($id_seguimiento)) {
	
	//$seguimientos=Seguimientos::model()->findByPk($id_seguimiento);
        
        $seguimientos = Seguimientos::findOne($id_seguimiento);
	$nur=$seguimientos->codigo;
	$estado=$seguimientos->oficial==1?'Original':'Copia Digital';


	// codigo para ibtener los valores del archivo

	$row=Seguimientos::returnIdArchivo($id_seguimiento);	
}
else{
	//$nur=$row['fil_nur'];
	//$estado=$row['fil_estadoseguimiento']==100?'Original':'Copia Digital';
}
//exit();

?>

<table width="80%" align="center" cellspacing="10px" cellpadding="5" border="0" style="font-size: 14px;" class="table table-bordered table-hover" >
	<tr>
		<th colspan="2" style="text-align: center; font-size: 18px;" > <u>DOCUMENTO ARCHIVADO</u></th>
	</tr>
	<tr>
		<td colspan="2">
                    <center>
			<img src="<?php echo Yii::$app->request->baseUrl; ?>/images/archivo.png" width="20%" height="20%"; >
                    </center>
		</td>
	</tr>

	
	<tr style="border-bottom: 1px solid white; ">
		<th style="color: white; background:#086A87; text-align:right; font-size:17px;">NUR/NURI:</th>
		<td style="background:#E6E6E6; font-size:17px;"><b><?=$row['nuri']?></b></td>
	</tr>
	<tr style="border-bottom: 1px solid white;">
		<th style="color: white; background:#086A87; text-align:right;">Tipo:</th>
		<td style="background:#E6E6E6;"><b><?=$estado?><b></td>
	</tr>
	<tr style="border-bottom: 1px solid white;">
		<th style="color: white; background:#086A87; text-align:right;">Acciones:</th>
		<td style="background:#E6E6E6;"><?=htmlentities($row['acciones'])?></td>
	</tr>
	<tr style="border-bottom: 1px solid white;">
		<th style="color: white; background:#086A87; text-align:right;">Nombre Carpeta:</th>
		<td style="background:#E6E6E6;"><?=htmlentities($row['nombre_carpeta'])?></td>
	</tr>
	<tr style="border-bottom: 1px solid white;">
		<th style="color: white; background:#086A87; text-align:right;">Tipo Tramite:</th>
		<td style="background:#E6E6E6;"><?=$row['tipo_tramite']?></td>
	</tr>
	

	<tr style="border-bottom: 1px solid white;">
		<th style="color: white; background:#086A87; text-align:right;">Fecha Archivo:</th>
		<td style="background:#E6E6E6;"><?=date("d/m/Y", strtotime($row['fecha_archivo']));?></td>
	</tr>
	
</table>
