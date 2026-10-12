<?php
namespace app\models;
ini_set("pcre.backtrack_limit", "5000000");


use Yii;
use app\models\Seguimientos;

/*use app\models\Agrupaciones;
use app\models\Usuarios;
use app\models\Hojasruta;*/
?>



<br>
<table align="center" align="center" width="90%">
	<tr>
		<td style="text-align: center; background-color: #D8D8D8; padding: 7px;">
			<b><u>REPORTE DE PENDIENTES AREA/UNIDAD</u></b>
		</td>
	</tr>
</table>
<br>
<table align="left" width="95%" style="font-size: 10px; padding:0px;  " border="0" cellpadding="0" >
	<tr>
		<th width="15%" align="right">&Aacute;rea/Unidad: </th>
		<td><?=$model->area?></td>
	</tr>
	<tr>
		<th width="15%" align="right">Sigla: </th>
		<td><?=$model->sigla?></td>
	</tr>
</table>

<hr style="width: 90%;">


<br>
<center>
<p align="center" style="font-size: 11px;">DOCUMENTOS <b><u>NO RECIBIDOS</u></b> POR EL &Aacute;REA/UNIDAD: <b><?=$model->area?></b></p>
</center>
	<table align="center" class="tabla_agrupacion" width="95%" cellspacing="0" cellpadding="6">
            <thead>
		<tr style="font-size: 10px; background-color: #BDBDBD; padding:6px; ">
			<th align="center" style="font-size: 10px;">N</th>
			<th align="center" style="font-size: 10px;">NUR/NURI</th>
			<th align="center" style="font-size: 10px;">Derivado por</th>
			<th align="center" style="font-size: 10px;">Fecha/Hora Derivaci&oacute;n</th>
			<th align="center" style="font-size: 10px;">Derivado a</th>
			<th align="center" style="font-size: 10px;">Fecha/Hora Recepci&oacute;n</th>
			<th align="center" style="font-size: 10px;">Prove&iacute;do</th>
			<th align="center" style="font-size: 10px;">Estado</th>
                        <th align="center" style="font-size: 10px;">Justificaci&oacute;n</th>
		</tr>
            </thead>    
        <?php 
        	$dataReader=Seguimientos::getNoRecibidosUsuarioArea($model->id_area); 
        ?>	

		<?php 
          $i=0;
		  foreach ($dataReader as $row) { 
		  $i++;	
		  ?>	
		  <tr  style="font-size: 9px; border-bottom: 0.1em solid #1C1C1C;">
		  	<td align="center" style="font-size: 9px;"><?=$i?></td>
		    <td align="center" style="font-size: 9px;">
		   		<i style="font-size: 7px; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i><br>
		   		<?=$row['nuri']?>
		    </td>
		    <td style="font-size: 9px;" align="left"><?=$row['usuario_origen']?></td>
		    <td style="font-size: 9px;" align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>
		    <td style="font-size: 9px;" align="left"><?=$row['usuario_destino']?></td>
		    <td style="font-size: 9px;" align="center"><?=date("d/m/Y", strtotime($row['f_recepcion']))." ".$row['h_recepcion']?></td>
		    <td style="font-size: 9px;"><?=$row['proveido']?></td>
		    <td style="font-size: 9px;" align="center"><?=$row['estado']?></td>
                    <td align="center" style="font-size: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 </tr>
		<?php } ?>
	   
	</table>	
<br><br>	
<center>
<p align="center" style="font-size: 11px;"><b>PENDIENTES OFICIALES Y DIGITALES</b></p>
</center>	

	<table align="center" class="tabla_agrupacion" width="95%" cellspacing="0" cellpadding="6">
            <thead>
		<tr style="font-size: 10px; background-color: #BDBDBD; padding:6px; ">
			<th align="center" style="font-size: 10px;">N</th>
			<th align="center" style="font-size: 10px;">NUR/NURI</th>
			<th align="center" style="font-size: 10px;">Derivado por</th>
			<th align="center" style="font-size: 10px;">Fecha/Hora Derivaci&oacute;n</th>
			<th align="center" style="font-size: 10px;">Derivado a</th>
			<th align="center" style="font-size: 10px;">Fecha/Hora Recepci&oacute;n</th>
			<th align="center" style="font-size: 10px;">Prove&iacute;do</th>
			<th align="center" style="font-size: 10px;">Estado</th>
                        <th align="center" style="font-size: 10px;">Justificaci&oacute;n</th>
		</tr>
            </thead>    
        <?php $dataReader=Seguimientos::getNurisPendientesOficialesDigitalesArea($model->id_area); ?>	

		<?php 
		$i=0;
		foreach ($dataReader as $row) { 
		$i++;	
		?>	
		  <tr  style="font-size: 9px;" class="fila">
		  	<td align="center" style="font-size: 9px;"><?=$i?></td>
		    <td align="center" style="font-size: 9px;">
		   		<i style="font-size: 7px; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i><br>
		   		<?=$row['nuri']?>
		    </td>
		    <td style="font-size: 9px;" align="left"><?=$row['usuario_origen']?></td>
		    <td style="font-size: 9px;" align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>
		    <td style="font-size: 9px;" align="left"><?=$row['usuario_destino']?></td>
		    <td style="font-size: 9px;" align="center"><?=date("d/m/Y", strtotime($row['f_recepcion']))." ".$row['h_recepcion']?></td>
		    <td style="font-size: 9px;"><?=$row['proveido']?></td>
		    <td style="font-size: 9px;" align="center"><?=$row['estado']?></td>
                    <td align="center" style="font-size: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 </tr>
		<?php } ?>
	   
	</table>
<br><br>
<center>
<p align="center" style="font-size: 11px;">DOCUMENTOS DERIVADOS POR EL &Aacute;REA/UNIDAD: <b><?=$model->area?></b> NO RECIBIDOS</p>
</center>	
	<table align="center" class="tabla_agrupacion" width="95%" cellspacing="0" cellpadding="6">
            <thead>
		<tr style="font-size: 10px; background-color: #BDBDBD; padding:6px; ">
			<th align="center" style="font-size: 10px;">N</th>
			<th align="center" style="font-size: 10px;">NUR/NURI</th>
			<th align="center" style="font-size: 10px;">Derivado por</th>
			<th align="center" style="font-size: 10px;">Fecha/Hora Derivaci&oacute;n</th>
			<th align="center" style="font-size: 10px;">Derivado a</th>
			<th align="center" style="font-size: 10px;">Fecha/Hora Recepci&oacute;n</th>
			<th align="center" style="font-size: 10px;">Prove&iacute;do</th>
			<th align="center" style="font-size: 10px;">Estado</th>
                        <th align="center" style="font-size: 10px;">Justificaci&oacute;n</th>
		</tr>
            </thead>    
        <?php $dataReader=Seguimientos::getDerivadosNoRecibidosArea($model->id_area); ?>	

		<?php 
		$i=0;
		foreach ($dataReader as $row) { 
		$i++;	
		?>	
		  <tr  style="font-size: 9px; border: .3px solid #1C1C1C;">
		  	<td align="center" style="font-size: 9px;"><?=$i?></td>
		    <td align="center" style="font-size: 9px;">
		   		<i style="font-size: 7px; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i><br>
		   		<?=$row['nuri']?>
		    </td>
		    <td style="font-size: 9px;" align="left"><?=$row['usuario_origen']?></td>
		    <td style="font-size: 9px;" align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>
		    <td style="font-size: 9px;" align="left"><?=$row['usuario_destino']?></td>
		    <td style="font-size: 9px;" align="center"><?=date("d/m/Y", strtotime($row['f_recepcion']))." ".$row['h_recepcion']?></td>
		    <td style="font-size: 9px;"><?=$row['proveido']?></td>
		    <td style="font-size: 9px;" align="center"><?=$row['estado']?></td>
                    <td align="center" style="font-size: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 </tr>
		<?php } ?>
	   
	</table>


		



