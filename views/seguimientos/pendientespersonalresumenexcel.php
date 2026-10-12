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
                <b><u style="font-size: 24px;">RESUMEN DE PENDIENTES</u></b>
		</td>
	</tr>
</table>
<br>

<br>

	<table align="center" class="tabla_agrupacion" width="95%" cellspacing="0" cellpadding="6">
            <thead>
		<tr style="font-size: 14px; background-color: #BDBDBD; padding:6px; ">
			<th align="center" style="font-size: 14px;">N</th>
                        <th align="center" style="font-size: 14px;">&Aacute;REA</th>
			<th align="center" style="font-size: 14px;">NOMBRE</th>
			<th align="center" style="font-size: 14px;">CARGO</th>
			
			<th align="center" style="font-size: 14px;">PENDIENTES OFICIALES</th>
			<th align="center" style="font-size: 14px;">COPIAS PENDIENTES</th>
			<th align="center" style="font-size: 14px;">NO RECIBIDOS</th>
			<th align="center" style="font-size: 14px;">SIN CONFIRMAR</th>
			<th align="center" style="font-size: 14px;">PENDIENTE MAS ANTIGUO</th>
			
		</tr>
            </thead>    
        <?php 
           
            $dataReader=Seguimientos::getResumenpendientespersonal($id); 
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
		    
		    <td style="font-size: 14px;" align="left"><?=htmlentities($row['area'])?></td>
		    <td style="font-size: 14px;" align="left"><?=htmlentities($row['nombre'])?></td>
		    <td style="font-size: 14px;" align="left"><?=htmlentities($row['cargo'])?></td>
                    
		    <td style="font-size: 14px;" align="left"><?=$row['pendientes_oficiales']?></td>
		    <td style="font-size: 14px;" align="left"><?=$row['copias_pendientes']?></td>
		    <td style="font-size: 14px;" align="left"><?=$row['no_recibidos']?></td>
		    <td style="font-size: 14px;" align="left"><?=$row['sin_confirmar']?></td>
		    <td style="font-size: 14px;" align="left"><?=$row['pendiente_antiguo']?></td>

		 </tr>
		<?php } ?>
	   
	</table>	
<br><br>	
