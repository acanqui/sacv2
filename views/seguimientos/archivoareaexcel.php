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
                <b><u style="font-size: 24px;">REPORTE DE ARCHIVO &Aacute;REA/UNIDAD</u></b>
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
<p align="center" style="font-size: 16px;">TR&Aacute;MITES <b><u>ARCHIVADOS</u></b> POR EL &Aacute;REA/UNIDAD: <b><?=htmlentities($model->area)?></b></p>
</center>
	<table align="center" class="tabla_agrupacion" width="95%" cellspacing="0" cellpadding="6">
            <thead>
		<tr style="font-size: 14px; background-color: #BDBDBD; padding:6px; ">
			<th align="center" style="font-size: 14px;">N</th>
			<th align="center" style="font-size: 14px;">USUARIO ARCHIVO</th>
			<th align="center" style="font-size: 14px;">NUR/NURI ARCHIVADO</th>
			<th align="center" style="font-size: 14px;">ESTADO TR&Aacute;MITE</th>
			<th align="center" style="font-size: 14px;">REFERENCIA DEL NUR/NURI</th>
			<th align="center" style="font-size: 14px;">EXPEDIENTE/CARPETA</th>
			<th align="center" style="font-size: 14px;">FECHA ARCHIVO</th>
			<th align="center" style="font-size: 14px;">PROVE&Iacute;DO ARCHIVO</th>
			<!--<th align="center" style="font-size: 14px;">GESTI&Oacute;N</th>-->
			
			
		</tr>
            </thead>    
        <?php 
        	$dataReader=Seguimientos::getArchivoarea($model->id_area); 
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
		    <td style="font-size: 14px;" align="left"><?=htmlentities($row['usuario_archivo'])?></td>
		    <td style="font-size: 14px;" align="center"><?=htmlentities($row['nuri'])?></td>
		    <td style="font-size: 14px;" align="left"><?=htmlentities($row['estado'])?></td>
		    <td style="font-size: 14px;" align="left"><?=htmlentities($row['referencia'])?></td>
		    <td style="font-size: 14px;" align="left"><?=htmlentities($row['expediente'])?></td>
		    <td style="font-size: 14px;" align="center"><?=htmlentities($row['fecha_archivo'])?></td>
		    <td style="font-size: 14px;" align="left"><?=htmlentities($row['proveido_archivo'])?></td>

		    <!--<td style="font-size: 14px;" align="right"><?php //=htmlentities($row['gestion'])?></td>-->
                    
		 </tr>
		<?php } ?>
	   
	</table>	
<br><br>	
