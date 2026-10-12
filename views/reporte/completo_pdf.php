<?php
namespace app\models;
use Yii;
use app\models\Seguimientos;
ini_set("pcre.backtrack_limit", "5000000");

/*use app\models\Agrupaciones;
use app\models\Usuarios;
use app\models\Hojasruta;*/
?>



<br>
<table align="center" align="center" width="90%">
	<tr>
		<td style="text-align: center; background-color: #D8D8D8; padding: 7px;">
			<b><u>REPORTE DE PENDIENTES DE USUARIO</u></b>
		</td>
	</tr>
</table>
<br>
<table align="left" width="95%" style="font-size: 10px; padding:0px;  " border="0" cellpadding="0" >	
	
	<tr>
		<th width="15%" align="right">Nombre: </th>
                <td><?= Usuarios::getNameUsuario($usuarios->id_usuario)?></td>
	</tr>
	<tr>
		<th width="15%" align="right">Cargo: </th>
		<td><?=$usuarios->cargo?></td>
	</tr>
	<tr>
		<th width="15%" align="right">Correo: </th>
		<td><?=$usuarios->correo?></td>
	</tr>
	<tr>
		<th width="15%" align="right">&Aacute;rea/Unidad: </th>
		<td><?=$usuarios->fkArea->area?></td>
	</tr>
</table>

<hr style="width: 90%;">


<br>
<center>
<p align="center" style="font-size: 11px;">DOCUMENTOS <b><u>NO RECIBIDOS</u></b> POR EL USUARIO: <b><?=$usuarios->usuario?></b></p>
</center>
	<table align="center" class="tabla_agrupacion" width="95%" cellspacing="0" cellpadding="6">
            <thead>
		<tr style="font-size: 10px; background-color: #BDBDBD; padding:6px; ">
			<th align="center" style="font-size: 10px;">N</th>
			<th align="center" style="font-size: 10px;">NUR/NURI</th>
			<th align="center" style="font-size: 10px;">Derivado por</th>
			<th align="center" style="font-size: 10px;">Fecha/Hora Derivaci&oacute;n</th>
			<!--<th align="center" style="font-size: 10px;">Derivado a</th>-->
			<th align="center" style="font-size: 10px;">Fecha/Hora Recepci&oacute;n</th>
			<th align="center" style="font-size: 10px;">Prove&iacute;do</th>
			<th align="center" style="font-size: 10px;">Estado</th>
			<th align="center" style="font-size: 10px;">Justificaci&oacute;n</th>
		</tr>
            </thead>    
        <?php 
        	$dataReader=Seguimientos::getNoRecibidosUsuario($usuarios->id_usuario); 
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
		    
                    <!--<td style="font-size: 9px;" align="left"><?=$row['usuario_destino']?></td>-->
                    
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
			<!--<th align="center" style="font-size: 10px;">Derivado a</th>-->
			<th align="center" style="font-size: 10px;">Fecha/Hora Recepci&oacute;n</th>
			<th align="center" style="font-size: 10px;">Prove&iacute;do</th>
			<th align="center" style="font-size: 10px;">Estado</th>
                        <th align="center" style="font-size: 10px;">Justificaci&oacute;n</th>
		</tr>
            </thead>    
        <?php $dataReader=Seguimientos::getNurisPendientesOficialesDigitales($usuarios->id_usuario); ?>	

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
		    <!--<td style="font-size: 9px;" align="left"><?=$row['usuario_destino']?></td>-->
		    <td style="font-size: 9px;" align="center"><?=date("d/m/Y", strtotime($row['f_recepcion']))." ".$row['h_recepcion']?></td>
		    <td style="font-size: 9px;"><?=$row['proveido']?></td>
		    <td style="font-size: 9px;" align="center"><?=$row['estado']?></td>
                    <td align="center" style="font-size: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 </tr>
		<?php } ?>
	   
	</table>
<br><br>
<center>
<p align="center" style="font-size: 11px;">TR&Aacute;MITES DERIVADOS POR EL USUARIO <b><?=$usuarios->usuario?></b> NO RECIBIDOS</p>
</center>	
	<table align="center" class="tabla_agrupacion" width="95%" cellspacing="0" cellpadding="6">
            <thead>
		<tr style="font-size: 10px; background-color: #BDBDBD; padding:6px; ">
			<th align="center" style="font-size: 10px;">N</th>
			<th align="center" style="font-size: 10px;">NUR/NURI</th>
			<th align="center" style="font-size: 10px;">Derivado por</th>
			<th align="center" style="font-size: 10px;">Fecha/Hora Derivaci&oacute;n</th>
			<!--<th align="center" style="font-size: 10px;">Derivado a</th>-->
			<th align="center" style="font-size: 10px;">Fecha/Hora Recepci&oacute;n</th>
			<th align="center" style="font-size: 10px;">Prove&iacute;do</th>
			<th align="center" style="font-size: 10px;">Estado</th>
                        <th align="center" style="font-size: 10px;">Justificaci&oacute;n</th>
		</tr>
            </thead>    
        <?php $dataReader=Seguimientos::getDerivadosNoRecibidos($usuarios->id_usuario); ?>	

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
		    <!--<td style="font-size: 9px;" align="left"><?=$row['usuario_destino']?></td>-->
		    <td style="font-size: 9px;" align="center"><?=date("d/m/Y", strtotime($row['f_recepcion']))." ".$row['h_recepcion']?></td>
		    <td style="font-size: 9px;"><?=$row['proveido']?></td>
		    <td style="font-size: 9px;" align="center"><?=$row['estado']?></td>
                    <td align="center" style="font-size: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 </tr>
		<?php } ?>
	   
	</table>


<br><br>
<center>
<p align="center" style="font-size: 11px;">TR&Aacute;MITES DERIVADOS POR EL USUARIO <b><?=$usuarios->usuario?></b> SIN CONFIRMAR</p>
</center>	
	<table align="center" class="tabla_agrupacion" width="95%" cellspacing="0" cellpadding="6">
            <thead>
		<tr style="font-size: 10px; background-color: #BDBDBD; padding:6px; ">
			<th align="center" style="font-size: 10px;">N</th>
			<th align="center" style="font-size: 10px;">NUR/NURI</th>
			<th align="center" style="font-size: 10px;">Derivado por</th>
			<th align="center" style="font-size: 10px;">Fecha/Hora Derivaci&oacute;n</th>
			<!--<th align="center" style="font-size: 10px;">Derivado a</th>-->
			<th align="center" style="font-size: 10px;">Fecha/Hora Recepci&oacute;n</th>
			<th align="center" style="font-size: 10px;">Prove&iacute;do</th>
			<th align="center" style="font-size: 10px;">Estado</th>
                        <th align="center" style="font-size: 10px;">Justificaci&oacute;n</th>
		</tr>
            </thead>    
        <?php $dataReader=Seguimientos::getDerivadosSinConfirmar($usuarios->id_usuario); ?>	

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
		    <!--<td style="font-size: 9px;" align="left"><?=$row['usuario_destino']?></td>-->
		    <td style="font-size: 9px;" align="center"><?=date("d/m/Y", strtotime($row['f_recepcion']))." ".$row['h_recepcion']?></td>
		    <td style="font-size: 9px;"><?=$row['proveido']?></td>
		    <td style="font-size: 9px;" align="center"><?=$row['estado']?></td>
                    <td align="center" style="font-size: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 </tr>
		<?php } ?>
	   
</table>	


		



