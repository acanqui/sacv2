<?php
use app\models\Documentos;
use app\models\TipoDocumento;
use app\models\Seguimientos;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (is_numeric($id)) {
//print_r($documentos);

$documentos = Documentos::findOne($id);
$tipo = TipoDocumento::findOne($documentos->fk_tipo_documento);
$nuri = Seguimientos::getObtenerNuri($id);
        
        
/*$documentos=Documentos::model()->findByPk($id);
$tipo=TipoDocumento::model()->findByPk($documentos->fk_tipo_documento);
$nuri=Seguimientos::getObtenerNuri($id);*/
?>

<div style="border: solid 0.1em #474747; box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);">
    
<img align="center" src='./images/logo_gnv.png' crossOrigin='Anonymous' width="225px" height="80px" style="position:absolute; margin-left:0.1cm;">

<!-- codigo para mostrar la cabereca -->
<br><br>
<table width="40%" align="center" >
	<tr align="center">
		<td><h3><b><?=$tipo->tipo_documento?></b></h3></td>
	</tr>
	<tr align="center">
		<td><b><?=$documentos->codigo?></b></td>
	</tr>
	<tr align="center">
		<td><b><?=$nuri?></b></td>
	</tr>
</table>
<hr style="width: 90%; opacity: 0.4; ">

<?php if ($documentos->fk_tipo_documento==4 OR $documentos->fk_tipo_documento==7) { 

 $row_mes=Documentos::getRowExplode($documentos->fecha,'-');
                        $name_mes=Documentos::getNameMonth($row_mes[1]);
?>


<table  width="90%" align="center" border="0" id="viewContenido">
		<tr>
			<td>
				<?=$documentos->fkUsuario->fkRegional->descripcion.", ".$row_mes[2]." de ".$name_mes." de ".$row_mes[0]."<br>"?>
				<?="<b>".$documentos->codigo."</b>"?>
				<br><br>
			</td>
		</tr>
		<td>
			<p></p><br>
                        <span><?php echo $documentos->destinatario_titulo; ?></span><br> 

                        <span><?php echo $documentos->destinatario_nombres; ?></span><br>
                        
                        <span><?php if ($documentos->destinatario_cargo!='null') {

                            echo "<b>".$documentos->destinatario_cargo."</b>"; 
                        } ?></span><br>

                        <span><?php echo "<b>".$documentos->destinatario_institucion."</b>"; ?><p></p>
                        Presente.-    
                        
                        <br><br>
                         REF.: <b><?php echo $documentos->referencia."<br>"; ?></b>
		</td>
	</table>





<?php } else { ?>

<table align="center" width="70%" border="0" cellpadding="4"  id="viewCabecera">

	<?php 

    if($documentos->destinatario_nombres!='null')
    {

    $row_destinatario= Documentos::getRowExplode($documentos->destinatario_nombres,';');
    $row_cargo_destinatario= Documentos::getRowExplode($documentos->destinatario_cargo,';');
      
    for($i=0; $i<count($row_destinatario); $i++) {
  ?>
  <tr>
      <th width="15%" style="text-align: right;" > 
      <?php if($i==0){ echo "A:&nbsp;&nbsp;&nbsp;&nbsp;";} 
          else{ echo " "; } 
        ?>
        
    </th>
    <td align="left"  width="85%" >
      <?=$row_destinatario[$i]; ?><br>
      <b><?php 

          if ($row_cargo_destinatario[$i]=='null') {
            $cargo='';
          }
          else{
           $cargo=$row_cargo_destinatario[$i]; 
          }
          echo $cargo;
          

        ?></b>
    </td>
  </tr>
  <?php   } //for($i=0; $i<count($row_via); $i++)

    } ?>

	<?php 

		if($documentos->via_nombres!='')
		{

			$row_via= Documentos::getRowExplode($documentos->via_nombres,';');
			$row_cargo_via= Documentos::getRowExplode($documentos->via_cargo,';');
			
			for($i=0; $i<count($row_via); $i++) {
	?>
	<tr>
		<th align="right"  style="text-align: right;" width="15%" > 
			<?php if($i==0){ echo "V&iacute;a:&nbsp;&nbsp;&nbsp;&nbsp;";} 
				  else{ echo " "; }	
				?>
			  
		</th>
		<td align="left"  width="85%" >
			<?=$row_via[$i]; ?><br>
			<b><?=$row_cargo_via[$i]; ?></b>
		</td>
	</tr>
	<?php 	} //for($i=0; $i<count($row_via); $i++)

		}

		$row_remitente=Documentos::getRowExplode($documentos->remitente_nombres,';'); 
		$row_remitente_via=Documentos::getRowExplode($documentos->remitente_cargo,';');

		for($j=0; $j<count($row_remitente); $j++) {
					
	?>
	<tr>
		<th style="text-align: right;" width="15%" >
			<?php if($j==0){ echo "De:&nbsp;&nbsp;&nbsp;&nbsp;";} 
				  else{ echo " "; }	
				?>
		</th>
		<td align="left"  width="85%" >
			<?=$row_remitente[$j]; ?><br>
			<b><?=$row_remitente_via[$j]; ?></b>
		</td>
	</tr>
	<?php } ?>
</table>
<br>
<table width="70%" align="center" border="0" id="viewCabecera">
<!-- codigo para mostrar al destinatario y via -->
	<?php if ($documentos->fk_tipo_documento==5) { ?>
	
		<!--<tr>
			<td><b>A: </b></td><td><strong><? //=$documentos->nombre_grupo?></strong></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
			<td><b>De: </b></td><td><? //=$documentos->remitente_nombres?><br><strong><? //=$documentos->remitente_cargo?></strong></td>
		</tr>
		<tr><td><br></td></tr>-->
		

	<?php } ?>
		<tr>
			<td align="right" width="15%" ><b>Fecha:&nbsp;&nbsp;&nbsp;</b></td>
                        <td align="left"  width="85%" ><?=date('d/m/Y',strtotime($documentos->fecha));?></td>
		</tr>
		
                
		<tr>
			<td align="right" width="15%" ><b>Referencia:&nbsp;&nbsp;&nbsp;</b></td>
                        <td align="left"  width="85%" ><?=$documentos->referencia?></td>
		</tr>
</table>

<?php } ?>


<hr style="width: 90%; opacity: 0.4;">

	<table  width="90%" align="center" border="0" id="viewContenido">
		<tr>
			<td>
				<?php if ($documentos->fk_estado_documento==6) {
					echo "&nbsp;&nbsp;&nbsp;&nbsp;";
				} else { ?>
				<?=$documentos->contenido?>
				<?php } ?>

			</td>
		</tr>
	</table>
	<br>
	<table  width="90%" align="center" border="0" id="viewContenido">
		<tr>
			<td style="font-size: 9px;">
                                <?=$documentos->fkUsuario->mosca?></i><br>
                                <?=$documentos->copias?><br>
				<i>Adj.<?=$documentos->adjuntos?>
				
				
			</td>
		</tr>
	</table>
	<br>

<?php
   }  
?>

        
        
</div>