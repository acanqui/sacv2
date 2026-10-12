<?php
namespace app\models;

use Yii;
use app\models\Seguimientos;

/*use app\models\Agrupaciones;
use app\models\Usuarios;
use app\models\Hojasruta;*/

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename=" reporte pendiente '.$usuarios->usuario.'.xls"');
header('Cache-Control: max-age=0');

?>

<?php /*$this->widget('application.extensions.qrcode.QRCodeGenerator',array(
    'data' => 'http://www.abc.gob.bo',
    'subfolderVar' => false,
    'matrixPointSize' => 5,
    'displayImage'=>true, // default to true, if set to false display a URL path
    'errorCorrectionLevel'=>'L', // available parameter is L,M,Q,H
    'matrixPointSize'=>4, // 1 to 10 only
))*/ ?>


<br>
<table align="center" align="center" width="90%">
	<tr>
		<td colspan="8" style="text-align: center; background-color: white; padding: 7px; font-size: 25px; ">
			<br>
			<b><u>REPORTE DE PENDIENTES DE USUARIO</u></b>
			<br><br>
		</td>
	</tr>
</table>
<table align="center" align="center" width="95%" style="font-size: 17px; " border="0">
	<tr>
		<td style="text-align: center; " rowspan="6" width="25%">



		</td>
	</tr>
	<tr>
		<th width="15%" align="right">Nombre: </th>
                <td colspan="4"><?=htmlentities(Usuarios::getNameUsuario($usuarios->id_usuario))?></td>
	</tr>
	<tr>
		<th width="15%" align="right">Cargo: </th>
		<td colspan="4"><?=htmlentities($usuarios->cargo)?></td>
	</tr>
	<tr>
		<th width="15%" align="right">Correo: </th>
		<td colspan="4"><?=htmlentities($usuarios->correo)?></td>
	</tr>
	<tr>
		<th width="15%" align="right">&Aacute;rea/Unidad: </th>
		<td colspan="4"><?=htmlentities($usuarios->fkArea->area)?></td>
	</tr>
	<tr>
		<th width="15%" align="right">CITE: </th>
		<td colspan="4"><?=htmlentities($usuarios->fkArea->cite)?></td>
	</tr>
</table>


<br>
<center>
<p align="center" style="font-size: 17px;">DOCUMENTOS <b><u>NO RECIBIDOS</u></b> POR EL USUARIO: <b><?=$usuarios->usuario?></b></p>
</center>
	<table align="center" border="0" width="95%" cellspacing="0" cellpadding="6">
		<tr style="font-size: 14px; background-color: #D0D1D3; color: black;  padding:6px;">
			<th align="center" style="font-size: 14px;">Tipo</th>
			<th align="center" style="font-size: 14px;">NUR/NURI</th>
			<th align="center" style="font-size: 14px;">CITE</th>
			<th align="center" style="font-size: 14px;">Referencia</th>
			<th align="center" style="font-size: 14px;">Derivado por</th>
			<th align="center" style="font-size: 14px;">Fecha/Hora Derivaci&oacute;n</th>
			<th align="center" style="font-size: 14px;">Derivado a</th>
			<th align="center" style="font-size: 14px;">Fecha/Hora Recepci&oacute;n</th>
			<th align="center" style="font-size: 14px;">Prove&iacute;do</th>
			<th align="center" style="font-size: 14px;">Estado</th>
			<th align="center" style="font-size: 14px;">Justificaci&oacute;n</th>
		</tr>
        <?php $dataReader=Seguimientos::getNoRecibidosUsuario($usuarios->id_usuario); ?>

		<?php
		 	$i=0;

			foreach ($dataReader as $row) { 
				$i++;	
				if($i%2==0){
                      $color=" background:#EAECEE;";
                  }
                  else{
                      $color="";
                  }	

		?>
		  <tr  style="font-size: 13px; <?=$color?>">
		    <td align="center" style="font-size: 13px;">
		   		<i style="font-size: 11px; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i><br>
		    </td>
		    <td align="center" style="font-size: 13px;">
		   		<?=$row['nuri']?>
		    </td>
        <td align="center" style="font-size: 13px;"><?=$row['cite_inicio']?></td>
        <td align="left" style="font-size: 13px;"><?=htmlentities($row['referencia'])?></td>
		    <td style="font-size: 13px;" align="center" valign="top"><?=htmlentities($row['usuario_origen'])?></td>
		    <td style="font-size: 13px;" align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>
		    <td style="font-size: 13px;" align="center"><?=htmlentities($row['usuario_destino'])?></td>
		    <td style="font-size: 13px;" align="center"><?=date("d/m/Y", strtotime($row['f_recepcion']))." ".$row['h_recepcion']?></td>
		    <td style="font-size: 13px;"><?=htmlentities($row['proveido'])?></td>
		    <td style="font-size: 13px;" align="center"><?=$row['estado']?></td>
		    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 </tr>
		<?php } ?>

	</table>
<br><br>
<center>
<p align="center" style="font-size: 17px;">PENDIENTES OFICIALES Y DIGITALES</p>
</center>

	<table align="center" border="0"  width="95%" cellspacing="0" cellpadding="6">
		<tr style="font-size: 14px; background-color: #D0D1D3; color: black;  padding:6px; ">
			<th align="center" style="font-size: 14px;">Tipo</th>
			<th align="center" style="font-size: 14px;">NUR/NURI</th>
      <th align="center" style="font-size: 14px;">CITE</th>
			<th align="center" style="font-size: 14px;">Referencia</th>
			<th align="center" style="font-size: 14px;">Derivado por</th>
			<th align="center" style="font-size: 14px;">Fecha/Hora Derivaci&oacute;n</th>
			<th align="center" style="font-size: 14px;">Derivado a</th>
			<th align="center" style="font-size: 14px;">Fecha/Hora Recepci&oacute;n</th>4
			<th align="center" style="font-size: 14px;">Tiempo en bandeja de usuario (dias)<br> desde la fecha de recepci&oacute;n</th>
			<th align="center" style="font-size: 14px;">Prove&iacute;do</th>
			<th align="center" style="font-size: 14px;">Estado</th>
			<th align="center" style="font-size: 14px;">Justificaci&oacute;n</th>
		</tr>
        <?php $dataReader=Seguimientos::getNurisPendientesOficialesDigitales($usuarios->id_usuario); ?>

		<?php
		 	$i=0;

			foreach ($dataReader as $row) { 
				$i++;	
				if($i%2==0){
                      $color=" background:#EAECEE;";
                  }
                  else{
                      $color="";
                  }	

		?>
		  <tr  style="font-size: 13px; <?=$color?>" class="fila">

		    <td align="center" style="font-size: 13px;">
		   		<i style="font-size: 11px; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i><br>
		    </td>
		    <td align="center" style="font-size: 13px;">
		   		<?=$row['nuri']?>
		    </td>
        <td align="center" style="font-size: 13px;"><?=$row['cite_inicio']?></td>
        <td align="left" style="font-size: 13px;"><?=htmlentities($row['referencia'])?></td>
		    <td style="font-size: 13px;" align="center"><?=htmlentities($row['usuario_origen'])?></td>
		    <td style="font-size: 13px;" align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>
		    <td style="font-size: 13px;" align="center"><?=htmlentities($row['usuario_destino'])?></td>
		    <td style="font-size: 13px;" align="center"><?=date("d/m/Y", strtotime($row['f_recepcion']))." ".$row['h_recepcion']?></td>
				<td style="font-size: 13px;" align="center"><?php echo Seguimientos::diferencia_entre_fechas($row['f_recepcion'])?></td>
		    <td style="font-size: 13px;"><?=htmlentities($row['proveido'])?></td>
		    <td style="font-size: 13px;" align="center"><?=$row['estado']?></td>
		    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 </tr>
		<?php } ?>

	</table>


<br><br>
<center>
<p align="center" style="font-size: 17px;">TR&Aacute;MITES DERIVADOS POR EL USUARIO <b><?=$usuarios->usuario?></b> NO RECIBIDOS</p>
</center>
	<table align="center" border="0"  width="95%" cellspacing="0" cellpadding="6">
		<tr style="font-size: 14px; background-color: #D0D1D3; color: black;  padding:6px; ">
			<th align="center" style="font-size: 14px;">Tipo</th>
			<th align="center" style="font-size: 14px;">NUR/NURI</th>
      <th align="center" style="font-size: 14px;">CITE</th>
			<th align="center" style="font-size: 14px;">Referencia</th>
			<th align="center" style="font-size: 14px;">Derivado por</th>
			<th align="center" style="font-size: 14px;">Fecha/Hora Derivaci&oacute;n</th>
			<th align="center" style="font-size: 14px;">Derivado a</th>
			<th align="center" style="font-size: 14px;">Fecha/Hora Recepci&oacute;n</th>
			<th align="center" style="font-size: 14px;">Prove&iacute;do</th>
			<th align="center" style="font-size: 14px;">Estado</th>
			<th align="center" style="font-size: 14px;">Justificaci&oacute;n</th>
		</tr>
        <?php $dataReader=Seguimientos::getDerivadosNoRecibidos($usuarios->id_usuario); ?>

		<?php
		 	$i=0;

			foreach ($dataReader as $row) { 
				$i++;	
				if($i%2==0){
                      $color=" background:#EAECEE;";
                  }
                  else{
                      $color="";
                  }	

		?>
		  <tr  style="font-size: 13px; <?=$color?>">
		  	<td align="center" style="font-size: 13px;">
		   		<i style="font-size: 11px; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i><br>
		    </td>
		    <td align="center" style="font-size: 13px;">
		   		<?=$row['nuri']?>
		    </td>
        <td align="center" style="font-size: 13px;"><?=$row['cite_inicio']?></td>
        <td align="left" style="font-size: 13px;"><?=htmlentities($row['referencia'])?></td>
		    <td style="font-size: 13px;" align="center"><?=htmlentities($row['usuario_origen'])?></td>
		    <td style="font-size: 13px;" align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>
		    <td style="font-size: 13px;" align="center"><?=htmlentities($row['usuario_destino'])?></td>
		    <td style="font-size: 13px;" align="center"><?=date("d/m/Y", strtotime($row['f_recepcion']))." ".$row['h_recepcion']?></td>
		    <td style="font-size: 13px;"><?=htmlentities($row['proveido'])?></td>
		    <td style="font-size: 13px;" align="center"><?=$row['estado']?></td>
		    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 </tr>
		<?php } ?>

	</table>



<br><br>
<center>
<p align="center" style="font-size: 17px;">TR&Aacute;MITES DERIVADOS POR EL USUARIO <b><?=$usuarios->usuario?></b> SIN CONFIRMAR</p>
</center>
	<table align="center" border="0"  width="95%" cellspacing="0" cellpadding="6">
		<tr style="font-size: 14px; background-color: #D0D1D3; color: black;  padding:6px; ">
			<th align="center" style="font-size: 14px;">Tipo</th>
			<th align="center" style="font-size: 14px;">NUR/NURI</th>
      <th align="center" style="font-size: 14px;">CITE</th>
			<th align="center" style="font-size: 14px;">Referencia</th>
			<th align="center" style="font-size: 14px;">Derivado por</th>
			<th align="center" style="font-size: 14px;">Fecha/Hora Derivaci&oacute;n</th>
			<th align="center" style="font-size: 14px;">Derivado a</th>
			<th align="center" style="font-size: 14px;">Fecha/Hora Recepci&oacute;n</th>
			<th align="center" style="font-size: 14px;">Prove&iacute;do</th>
			<th align="center" style="font-size: 14px;">Estado</th>
			<th align="center" style="font-size: 14px;">Justificaci&oacute;n</th>
		</tr>
        <?php $dataReader=Seguimientos::getDerivadosSinConfirmar($usuarios->id_usuario); ?>

		<?php
		 	$i=0;

			foreach ($dataReader as $row) { 
				$i++;	
				if($i%2==0){
                      $color=" background:#EAECEE;";
                  }
                  else{
                      $color="";
                  }	

		?>
		  <tr  style="font-size: 13px; <?=$color?>">
		  	<td align="center" style="font-size: 13px;">
		   		<i style="font-size: 11px; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i><br>
		    </td>
		    <td align="center" style="font-size: 13px;">
		   		<?=$row['nuri']?>
		    </td>
        <td align="center" style="font-size: 13px;"><?=$row['cite_inicio']?></td>
        <td align="left" style="font-size: 13px;"><?=htmlentities($row['referencia'])?></td>
		    <td style="font-size: 13px;" align="center"><?=htmlentities($row['usuario_origen'])?></td>
		    <td style="font-size: 13px;" align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>
		    <td style="font-size: 13px;" align="center"><?=htmlentities($row['usuario_destino'])?></td>
		    <td style="font-size: 13px;" align="center"><?=date("d/m/Y", strtotime($row['f_recepcion']))." ".$row['h_recepcion']?></td>
		    <td style="font-size: 13px;"><?=htmlentities($row['proveido'])?></td>
		    <td style="font-size: 13px;" align="center"><?=$row['estado']?></td>
		    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 </tr>
		<?php } ?>

	</table>	
