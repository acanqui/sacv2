<?php
namespace app\models;

use Yii;
use app\models\Seguimientos;

/*use app\models\Agrupaciones;
use app\models\Usuarios;
use app\models\Hojasruta;*/
?>



<br>
<table align="center" align="center" width="90%">
	<tr>
            <td style="text-align: center; background-color: #D8D8D8; padding: 7px;" colspan="9">
                <b><u style="font-size: 24px;">REPORTE DE PENDIENTES &Aacute;REA/UNIDAD</u></b>
		</td>
	</tr>
</table>
<br>
<table align="left" width="95%" style="font-size: 16px; padding:0px;  " border="0" cellpadding="0" >	
	
	<tr>
		<th width="15%" align="right">&Aacute;rea/Unidad: </th>
                <td colspan="3"><?=htmlentities($model->area)?></td>
	</tr>
	<tr>
		<th width="15%" align="right">Sigla: </th>
                <td colspan="3"><?=$model->sigla?></td>
	</tr>
</table>


<br>
<center>
<p align="center" style="font-size: 16px;">DOCUMENTOS <b><u>NO RECIBIDOS</u></b> POR EL &Aacute;REA/UNIDAD: <b><?=htmlentities($model->area)?></b></p>
</center>
	<table align="center" class="tabla_agrupacion" width="95%" cellspacing="0" cellpadding="6">
            <thead>
		<tr style="font-size: 14px; background-color: #BDBDBD; padding:6px; ">
			<th align="center" style="font-size: 14px;">N</th>
			<th align="center" style="font-size: 14px;">NUR/NURI</th>
			<th align="center" style="font-size: 14px;">Referencia</th>
			<th align="center" style="font-size: 14px;">Derivado por</th>
			<th align="center" style="font-size: 14px;">Fecha/Hora Derivaci&oacute;n</th>
			<th align="center" style="font-size: 14px;">Derivado a</th>
			<th align="center" style="font-size: 14px;">Fecha/Hora Recepci&oacute;n</th>
			<th align="center" style="font-size: 14px;">Prove&iacute;do</th>
			<th align="center" style="font-size: 14px;">Estado</th>
                        <th align="center" style="font-size: 14px;">Justificaci&oacute;n</th>
		</tr>
            </thead>    
        <?php 
        	$dataReader=Seguimientos::getNoRecibidosUsuarioArea($model->id_area); 
        ?>	

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
		  <tr  style="font-size: 14px; border-bottom: 0px solid #1C1C1C; <?=$color?> ">
                    <td align="center" style="font-size: 14px;"><?=$i?></td>
		    <td align="center" style="font-size: 14px;">
		   		<i style="font-size: 12px; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i><br>
		   		<?=$row['nuri']?>
		    </td>
		    <td style="font-size: 14px;" align="left"><?=htmlentities($row['referencia'])?></td>
		    <td style="font-size: 14px;" align="left"><?=htmlentities($row['usuario_origen'])?></td>
		    <td style="font-size: 14px;" align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>
		    <td style="font-size: 14px;" align="left"><?=htmlentities($row['usuario_destino'])?></td>
		    <td style="font-size: 14px;" align="center"><?=date("d/m/Y", strtotime($row['f_recepcion']))." ".$row['h_recepcion']?></td>
		    <td style="font-size: 14px;"><?=htmlentities($row['proveido'])?></td>
		    <td style="font-size: 14px;" align="left"><?=$row['estado']?></td>
                    <td align="center" style="font-size: 14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 </tr>
		<?php } ?>
	   
	</table>	
<br><br>	
<center>
<p align="center" style="font-size: 16px;"><b>PENDIENTES OFICIALES Y DIGITALES</b></p>
</center>	

	<table align="center" class="tabla_agrupacion" width="95%" cellspacing="0" cellpadding="6">
            <thead>
		<tr style="font-size: 14px; background-color: #BDBDBD; padding:6px; ">
			<th align="center" style="font-size: 14px;">N</th>
			<th align="center" style="font-size: 14px;">NUR/NURI</th>
			<th align="center" style="font-size: 14px;">Referencia</th>
			<th align="center" style="font-size: 14px;">Derivado por</th>
			<th align="center" style="font-size: 14px;">Fecha/Hora Derivaci&oacute;n</th>
			<th align="center" style="font-size: 14px;">Derivado a</th>
			<th align="center" style="font-size: 14px;">Fecha/Hora Recepci&oacute;n</th>
			<th align="center" style="font-size: 14px;">Prove&iacute;do</th>
			<th align="center" style="font-size: 14px;">Estado</th>
                        <th align="center" style="font-size: 14px;">Justificaci&oacute;n</th>
		</tr>
            </thead>    
        <?php $dataReader=Seguimientos::getNurisPendientesOficialesDigitalesArea($model->id_area); ?>	

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
		  <tr  style="font-size: 14px; border-bottom: 0px solid #1C1C1C; <?=$color?> " >
		    <td align="center" style="font-size: 14px;"><?=$i?></td>
		    <td align="center" style="font-size: 14px;">
		   		<i style="font-size: 12px; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i><br>
		   		<?=$row['nuri']?>
		    </td>
		    <td style="font-size: 14px;" align="left"><?=htmlentities($row['referencia'])?></td>
		    <td style="font-size: 14px;" align="left"><?=htmlentities($row['usuario_origen'])?></td>
		    <td style="font-size: 14px;" align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>
		    <td style="font-size: 14px;" align="left"><?=htmlentities($row['usuario_destino'])?></td>
		    <td style="font-size: 14px;" align="center"><?=date("d/m/Y", strtotime($row['f_recepcion']))." ".$row['h_recepcion']?></td>
		    <td style="font-size: 14px;"><?=htmlentities($row['proveido'])?></td>
		    <td style="font-size: 14px;" align="left"><?=$row['estado']?></td>
                    <td align="center" style="font-size: 12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 </tr>
		<?php } ?>
	   
	</table>
<br><br>
<center>
<p align="center" style="font-size: 16px;">DOCUMENTOS DERIVADOS POR EL &Aacute;REA/UNIDAD: <b><?=$model->area?></b> NO RECIBIDOS</p>
</center>	
	<table align="center" class="tabla_agrupacion" width="95%" cellspacing="0" cellpadding="6">
            <thead>
		<tr style="font-size: 14px; background-color: #BDBDBD; padding:6px; ">
			<th align="center" style="font-size: 14px;">N</th>
			<th align="center" style="font-size: 14px;">NUR/NURI</th>
			<th align="center" style="font-size: 14px;">Referencia</th>
			<th align="center" style="font-size: 14px;">Derivado por</th>
			<th align="center" style="font-size: 14px;">Fecha/Hora Derivaci&oacute;n</th>
			<th align="center" style="font-size: 14px;">Derivado a</th>
			<th align="center" style="font-size: 14px;">Fecha/Hora Recepci&oacute;n</th>
			<th align="center" style="font-size: 14px;">Prove&iacute;do</th>
			<th align="center" style="font-size: 14px;">Estado</th>
                        <th align="center" style="font-size: 14px;">Justificaci&oacute;n</th>
		</tr>
            </thead>    
        <?php $dataReader=Seguimientos::getDerivadosNoRecibidosArea($model->id_area); ?>	

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
		  <tr  style="font-size: 14px;  border-bottom: 0px solid #1C1C1C; <?=$color?>">
		  	<td align="center" style="font-size: 14px;"><?=$i?></td>
		    <td align="center" style="font-size: 14px;">
		   		<i style="font-size: 12px; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i><br>
		   		<?=$row['nuri']?>
		    </td>
		    <td style="font-size: 14px;" align="left"><?=htmlentities($row['referencia'])?></td>
        <td style="font-size: 14px;" align="left"><?=htmlentities($row['usuario_origen'])?></td>
		    <td style="font-size: 14px;" align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>
		    <td style="font-size: 14px;" align="left"><?=htmlentities($row['usuario_destino'])?></td>
		    <td style="font-size: 14px;" align="center"><?=date("d/m/Y", strtotime($row['f_recepcion']))." ".$row['h_recepcion']?></td>
		    <td style="font-size: 14px;"><?=htmlentities($row['proveido'])?></td>
		    <td style="font-size: 14px;" align="left"><?=$row['estado']?></td>
                    <td align="center" style="font-size: 14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 </tr>
		<?php } ?>
	   
	</table>


		



