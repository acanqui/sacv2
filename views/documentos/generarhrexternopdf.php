<?php 
use app\models\Hojasruta;
use app\models\Documentos;
use app\models\Seguimientos;
use Da\QrCode\QrCode;
use yii\httpclient\Client;

?>
<!--
<style>
        .cuerpo {
            width: 100%;
            font-family:Verdana, Geneva, sans-serif;
        }
        .tabla_hs{
        	font-family:Verdana, Geneva, sans-serif;
        }
        .tabla_hs tr td, tr th{
        	border: .3px solid #1C1C1C;   
        	border-collapse: collapse;
        }
</style>-->
<?php 
switch($documentos->fk_tipo_documento) {
					    case 1:
					        $tipo='INFORME';
					        break;
					    case 2:
					        $tipo='NOTA INTERNA';
					        break;
					    case 3:
					        $tipo='MEMORANDUM';
					        break;
					    case 4:
					        $tipo='CARTA';
					        break;
					    case 5:
					        $tipo='CIRCULAR';
					        break;        
					}
?>

<div class="cuerpo">
<!--#####################################################################-->		

	<table border="0" cellpadding="4px" cellspacing="0" width="100%" class="tabla_hs">
		<tr align="center">
			<th style="width:14.7%;">

				<img src="./images/logo_hr.jpg" width="95px" height="70px" />	
			</th>
			<th style="width:68%;">
                            <center>
                                <span style="font-size: 14pt; text-align: center;">
                                    HOJA DE SEGUIMIENTO EXTERNA<br> NUR
                                </span>
                            </center>    
			</th>
			
			<th style="width:18%;" colspan="2">
                            <center>    
				<span style="font-size: 12pt; text-align:center;">
					<?=$hojasruta->nur?>
					
					<br>

					<?php 
                                            $texto='NURI: '.$hojasruta->fecha.'CITE: '.$documentos->codigo.' FECHA:'.$documentos->fecha;
                                            $qrCode = (new QrCode($texto))
                                                ->setSize(60)
                                                ->setMargin(5)
                                                ->useForegroundColor(51, 153, 255);

                                            $qrCode->writeFile(__DIR__ . '/code.png'); // writer defaults to PNG when none is specified

                                            // display directly to the browser 
                                            header('Content-Type: '.$qrCode->getContentType());
                                            //echo $qrCode->writeString();

                                            // or even as data:uri url
                                            echo '<img src="' . $qrCode->writeDataUri() . '">';
                                        ?>


				</span>
                            </center>    
			</th>
		</tr>
        </table>

        <table border="0" cellpadding="4px" cellspacing="0" width="100%" class="tabla_hs">
		<tr style="font-size: 8pt; ">
			<th style="font-size:8pt; text-align:left; background-color:#BDBDBD; width: 14.7%;"><span>Procedencia: </span></th>
			<td style=" text-align:left; font-size:8pt; width:55%;" align="left" ><?=$documentos->remitente_institucion?></td>
			<th style="font-size:8pt; background-color:#BDBDBD;  width:10%;"><span>Fecha HR: </span></th>
			<td align="left" style="font-size:8pt;" ><?=date("d/m/Y", strtotime($hojasruta->fecha));?>&nbsp;&nbsp;<?=$hojasruta->hora?></td>
		</tr>
		<tr>
			<th style="font-size:8pt; text-align:left; background-color:#BDBDBD;"><span>CITE: </span></th>
			<td align="left" style="font-size: 8pt;"><?php //=$hojasruta->codigo?><?=Documentos::mostrarhr($hojasruta->nur)?></td>
            <th style="font-size:8pt; background-color:#BDBDBD;"><span>Acci&oacute;n/Tipo: </span></th>
                        <td align="left" style="font-size:8pt;" ><?=Seguimientos::getAccion($hojasruta->nur)?></td>
		</tr>
		
		<tr style="font-size: 8pt;">
			<th style="font-size: 8pt; text-align:left; background-color:#BDBDBD;"><span>Remitente: </span></th>
			<td style="text-align:left; font-size: 8pt;" colspan="3">
				<?=$documentos->remitente_nombres?>&nbsp;|&nbsp;
				<?=$documentos->remitente_cargo?>
			</td>
			
		</tr>
		<tr style="font-size: 8pt;">
			<th style="font-size: 8pt; text-align:left; background-color:#BDBDBD;"><span>Referencia: </span></th>
			<td style="text-align:left; font-size: 8pt;"  align="left"  colspan="3" >
				<?=$documentos->referencia?>
			</td>
			
		</tr>
		<tr style="font-size: 8pt;">
			<th  style="font-size: 8pt; text-align:left; background-color:#BDBDBD;"><span>Adjuntos: </span></th>
                        <td align="left"  style="text-align:left; font-size: 8pt;">
				<?=$documentos->adjuntos?>
			</td>
			<th  style="font-size: 8pt; background-color:#BDBDBD;"><span>Hojas: </span></th>
			<td align="left" style="font-size: 8pt;" ><?=$documentos->nro_hojas?></td>
		</tr>

	</table>

        <!--#########################################################################-->
	<?php $row=Documentos::getDetalleSeguimiento($hojasruta->nur); ?>
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr style="border-top:0mm;">
			<th style="width: 14.7%; font-size:8pt; background-color:#BDBDBD;  text-align: left;" ><div style="width:100%; text-align: left; font-size: 8pt;">Destinatario: </div></th>
			<td style="width: 51%; text-align: left; font-size:8pt;">
				<?=Documentos::getNameAreaDerivacion($row['derivado_a'])?>
			</td>
			
			
			<td style="width:18%; font-size:8pt;  text-align: left; background-color:#BDBDBD;">
				<b>Fecha/Hora Derivaci&oacute;n: </b>
			</td>
			<td style="width:16%; font-size:8pt; text-align: left;">
				<?=date("d/m/Y", strtotime($row['fecha_derivacion']));?> <?=$row['hora_derivacion']?>
			</td>
			
		</tr>
	</table>	
	
    <?php 
        
        // CODIGO PARA MOSTRAR EL NOMBRE DE CARPETA DE PAGO SOLO EN DOCUMENTOS EXTERNOS

        if(Documentos::countNURIsuic($hojasruta->nur)==1){


        $row_taller=Documentos::getDetalleTaller($hojasruta->nur);

            

			$client = new Client();
			$response = $client->createRequest()
			    ->setMethod('POST')
			    ->setFormat(Client::FORMAT_JSON)
			    ->setUrl('http://10.0.10.12/WsTallerOrdenPago/controller/SincronizacionDatosControl.php?op=PostInfOrdenPago')
			    ->setData(['dCredencial' => 'WFOayG7j73BDR3434V45345as147',  'dIdOrdenPago' => ($row_taller['fk_orden_pago']+0),  'dIdTaller' => ($row_taller['fk_taller']+0) ])
			    ->send();

			//->setUrl('http://repl.eecgnv.gob.bo/WsTallerOrdenPago/controller/SincronizacionDatosControl.php?op=PostInfOrdenPago')

			if ($response->isOk) {
			    // use your data
			   
			    //print_r($response);
			    //var_dump($response->data);
			    //var_dump($response->data);
			    
			    //$currentObs = $response->data['current_observation']
			    
			    foreach($response->data as $row9){
			        //echo "<br>".$row['Taller']." => ".$row['TipoOrden']." => ".$row['CodigoOrdenPago'];
			    	$taller=$row9['Taller'];
			    	$tipo_orden=$row9['TipoOrden'];
			    	$codigo_orden=$row9['CodigoOrdenPago'];
			        //$talleres[$row['IdTaller']]=$row['Taller'];
			    }
			    
			}
        
        
        ?>
        
        
        <table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr style="border-top:0mm;">
			<th style="width: 14.7%; font-size:8.5pt; background-color:#BDBDBD;  text-align: left;" >
                            <div style="width:100%; text-align: left; font-size: 8.5pt;">Taller: </div>
                        </th>
			<td style="width: 45%; text-align: left; font-size:8.5pt;">
				<?php echo utf8_encode(htmlentities($taller)); ?>
			</td>
			
<!--
			<td style="width:10%; font-size:8.5pt;  text-align: left; background-color:#BDBDBD;">
                            <b>N° Carpetas: </b>
			</td>
                        <td style="width:10%; font-size:8.5pt;  text-align: left;">
                            <?php echo $codigo_orden ?>
			</td>
                        
			<td style="width:6%; font-size:8.5pt; text-align: left; background-color:#BDBDBD; ">
                            <b>Tipo: </b>
			</td>
                        <td style="width:14%; font-size:8.5pt; text-align: left; ">
                            <?php echo $tipo_orden?>
			</td>
-->
			
		</tr>

		
	</table>
        <?php 
            } //end else

            
        ?>
        <p></p>

	
	<!-- codigo añadido para ostrar carpetas de pago -->
	<?php  

        /*
	$row_orden_suic=Documentos::getTallerSUIC($documentos->fk_orden_pago_suic);

	

	if($documentos->carpeta_pago==1) 
	{
	?>
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr style="border-top:0mm;">
			<th style="width: 14.7%; font-size:7pt; background-color:#BDBDBD;  text-align: left;" ><div style="width:100%; text-align: left; font-size: 8pt;">Taller: </div></th>
			<td style="width: 60%; text-align: left; font-size:7pt;">
				<?php echo utf8_encode($row_orden_suic['Taller']); ?>
			</td>
			
			<td style="width:15%; font-size:7pt;  text-align: left; background-color:#BDBDBD;">
				<b>N° Carpeta: </b>
					<?=$row_orden_suic['NumeroOrdenPago']."-".$row_orden_suic['Gestion']?>
				<div style="width:0px; text-align:left; ">
				</div>
			</td>
			<td style="width:15%; font-size:7pt; text-align: left; background-color:#BDBDBD;">
				<div style="width:100%;">
					<b>Tipo: </b>
					<?=$row_orden_suic['TipoOrden']?>
				</div>
			</td>
			
		</tr>

		
	</table>	
	<?php } */ ?>


	<table class="tabla_hs" cellpadding="4px" cellspacing="0" style="border-top: 1.5mm;"  width="100%">
		
		<tr style="font-size: 8pt;">
			
			<td style="border-bottom: 0mm; width:0mm; width: 40%;" >
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				
			
			</td>
			<th  style="border-bottom: 0mm; width:0; font-size: 8pt; text-align: left;  width: 60%; background-color:#BDBDBD;" >
                            MOTIVO:&nbsp;&nbsp; <?=Documentos::getMotivo($documentos->fk_motivo)?> 
			</th>
			
		</tr>
		<tr style=" border-top:0mm; ">
			<td style="border-bottom: 0mm; border-top: 0mm; text-align: center; font-size: 8pt; " valign="middle">
				<span style="color:gray;">Sello de derivaci&oacute;n</span><br><br><br><br><br><br><br><br><br><br><br>
			</td>
			
			<td width="60%" valign="top"  style="font-size: 8pt;">
				<div style="width: 100%;">
					<?=$row['proveido']?> 
				</div>
			</td>
			
		</tr>
	</table>
<!--	<table class="tabla_hs" cellpadding="4px" cellspacing="0" style="border-top: 1.5mm;"  width="100%">
		
		<tr style="font-size: 8pt;">
			<th  style="border-bottom: 0mm; width:0; font-size: 8pt; text-align: left;  width: 60%; background-color:#BDBDBD;" >
				PROVE&Iacute;DO:
			</th>
			
		</tr>
		<tr style=" border-top:0mm; ">
			<td width="100%" valign="top"  style="font-size: 8pt; height:3cm;">
				<div style="width: 100%; ">
					<?=$row['proveido']?> 
				</div>
			</td>
			
		</tr>
	</table> -->

	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		
		<tr style="font-size:7pt;">
			<td  style="width:65%; font-size:7pt; background-color:#BDBDBD;"  align="left" colspan="2" >
				<b>Copias:</b>&nbsp;&nbsp;
				<?=Documentos::getNameCopias($hojasruta->nur)?>
			</td>

			
			<td style="width:35%; font-size:7pt; background-color:#BDBDBD;" align="left">
				<b>Firma de derivaci&oacute;n :</b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
			
			
		</tr>
	</table>	
	

	<p></p>	
	<!-- ######################################################################### -->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr style="border-top:0mm;">
			<th style="width:443px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
				<b>Destinatario: </b>
			</th>
			
			<td style="width: 135px; font-size: 8pt;text-align: left; background-color:#BDBDBD;"  align="left">
				<b>Fecha: </b>
			</td>
			<td align="20"  align="left" style="width: 116px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
					<b>Hora: </b>
			</td>
			
		</tr>
	</table>
	<!--<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			<td style="border-bottom: 0mm; width: 40%; font-size: 8pt;"></td>
			<th style="width: 25%; font-size: 8pt; text-align: left; background-color:#BDBDBD;" ><b>Firma de Recepci&oacute;n: </b></th>
			<th style="width: 15%;  text-align: left; text-align: left; font-size: 8pt;  background-color:#BDBDBD;"><b>Hora: </b></th>
			<th style="width: 20%; text-align: left; font-size: 8pt; background-color:#BDBDBD;"><b>Fecha: </b></th>
		</tr>
	</table>-->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			
			<td align="center"  style="border-bottom: 0mm; border-top: 0mm; width:40%;font-size:8pt;" >
				<br><span style="color:gray;">Sello de Recepci&oacute;n</span><br><br><br><br><br><br><br><br><br><br><br><br>
			</td>
			<td style="border-bottom: 0mm; border-top: 0mm; width:60%;font-size:8pt;" > &nbsp;</td>
			
		</tr>
		<tr style="font-size: 7pt;">
			<td style="border-top: 0mm; border-bottom: 0mm; width: 40%;"></td>
			
			<th width="60%" style="font-size:8pt; text-align: left; width: 60%; border-bottom:0mm; background-color:#BDBDBD;" >
					Adjuntos:			
			</th>
		</tr>
	</table>

	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		
		<tr style="font-size: 9pt;">
			<td style="width:40%; border-top:0mm;"></td>
			<td  style="width:25%; font-size: 8pt; background-color:#BDBDBD;"  align="left">
				<b>Copias :</b>
			</td>
			<td style="width:35%; font-size: 8pt; background-color:#BDBDBD;" align="left">
				<b>Firma de derivaci&oacute;n :</b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>	
	

	<!-- ######################################################################### -->
	<p></p>	
	<!-- ######################################################################### -->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr style="border-top:0mm;">
			<th style="width:443px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
				<b>Destinatario: </b>
			</th>
			
			<td style="width: 135px; font-size: 8pt;text-align: left; background-color:#BDBDBD;"  align="left">
				<b>Fecha: </b>
			</td>
			<td align="20"  align="left" style="width: 116px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
					<b>Hora: </b>
			</td>
			
		</tr>
	</table>
	<!--<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			<td style="border-bottom: 0mm; width: 40%; font-size: 8pt;"></td>
			<th style="width: 25%; font-size: 8pt; text-align: left; background-color:#BDBDBD;" ><b>Firma de Recepci&oacute;n: </b></th>
			<th style="width: 15%;  text-align: left; text-align: left; font-size: 8pt;  background-color:#BDBDBD;"><b>Hora: </b></th>
			<th style="width: 20%; text-align: left; font-size: 8pt; background-color:#BDBDBD;"><b>Fecha: </b></th>
		</tr>
	</table>-->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			
			<td align="center"  style="border-bottom: 0mm; border-top: 0mm; width:40%;font-size:8pt;" >
				<br><span style="color:gray;">Sello de Recepci&oacute;n</span><br><br><br><br><br><br><br><br><br><br><br><br>
			</td>
			<td style="border-bottom: 0mm; border-top: 0mm; width:60%;font-size:8pt;" > &nbsp;</td>
			
		</tr>
		<tr style="font-size: 7pt;">
			<td style="border-top: 0mm; border-bottom: 0mm; width: 40%;"></td>
			
			<th width="60%" style="font-size:8pt; text-align: left; width: 60%; border-bottom:0mm; background-color:#BDBDBD;" >
					Adjuntos:			
			</th>
		</tr>
	</table>

	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		
		<tr style="font-size: 9pt;">
			<td style="width:40%; border-top:0mm;"></td>
			<td  style="width:25%; font-size: 8pt; background-color:#BDBDBD;"  align="left">
				<b>Copias :</b>
			</td>
			<td style="width:35%; font-size: 8pt; background-color:#BDBDBD;" align="left">
				<b>Firma de derivaci&oacute;n :</b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>
        
        
        <!-- ######################################################################### -->

	
	<div style="page-break-after: always"></div>
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->


	<!-- SEGUNDA PAGINA -->
	<!-- ######################################################################### -->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr style="border-top:0mm;">
			<th style="width:443px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
				<b>Destinatario: </b>
			</th>
			
			<td style="width: 135px; font-size: 8pt;text-align: left; background-color:#BDBDBD;"  align="left">
				<b>Fecha: </b>
			</td>
			<td align="20"  align="left" style="width: 116px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
					<b>Hora: </b>
			</td>
			
		</tr>
	</table>
	<!--<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			<td style="border-bottom: 0mm; width: 40%; font-size: 8pt;"></td>
			<th style="width: 25%; font-size: 8pt; text-align: left; background-color:#BDBDBD;" ><b>Firma de Recepci&oacute;n: </b></th>
			<th style="width: 15%;  text-align: left; text-align: left; font-size: 8pt;  background-color:#BDBDBD;"><b>Hora: </b></th>
			<th style="width: 20%; text-align: left; font-size: 8pt; background-color:#BDBDBD;"><b>Fecha: </b></th>
		</tr>
	</table>-->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			
			<td align="center"  style="border-bottom: 0mm; border-top: 0mm; width:40%;font-size:8pt;" >
				<br><span style="color:gray;">Sello de Recepci&oacute;n</span><br><br><br><br><br><br><br><br><br><br><br><br>
			</td>
			<td style="border-bottom: 0mm; border-top: 0mm; width:60%;font-size:8pt;" > &nbsp;</td>
			
		</tr>
		<tr style="font-size: 7pt;">
			<td style="border-top: 0mm; border-bottom: 0mm; width: 40%;"></td>
			
			<th width="60%" style="font-size:8pt; text-align: left; width: 60%; border-bottom:0mm; background-color:#BDBDBD;" >
					Adjuntos:			
			</th>
		</tr>
	</table>

	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		
		<tr style="font-size: 9pt;">
			<td style="width:40%; border-top:0mm;"></td>
			<td  style="width:25%; font-size: 8pt; background-color:#BDBDBD;"  align="left">
				<b>Copias :</b>
			</td>
			<td style="width:35%; font-size: 8pt; background-color:#BDBDBD;" align="left">
				<b>Firma de derivaci&oacute;n :</b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>	
	

	<!-- ######################################################################### -->
	<p></p>	
	<!-- ######################################################################### -->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr style="border-top:0mm;">
			<th style="width:443px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
				<b>Destinatario: </b>
			</th>
			
			<td style="width: 135px; font-size: 8pt;text-align: left; background-color:#BDBDBD;"  align="left">
				<b>Fecha: </b>
			</td>
			<td align="20"  align="left" style="width: 116px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
					<b>Hora: </b>
			</td>
			
		</tr>
	</table>
	<!--<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			<td style="border-bottom: 0mm; width: 40%; font-size: 8pt;"></td>
			<th style="width: 25%; font-size: 8pt; text-align: left; background-color:#BDBDBD;" ><b>Firma de Recepci&oacute;n: </b></th>
			<th style="width: 15%;  text-align: left; text-align: left; font-size: 8pt;  background-color:#BDBDBD;"><b>Hora: </b></th>
			<th style="width: 20%; text-align: left; font-size: 8pt; background-color:#BDBDBD;"><b>Fecha: </b></th>
		</tr>
	</table>-->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			
			<td align="center"  style="border-bottom: 0mm; border-top: 0mm; width:40%;font-size:8pt;" >
				<br><span style="color:gray;">Sello de Recepci&oacute;n</span><br><br><br><br><br><br><br><br><br><br><br><br>
			</td>
			<td style="border-bottom: 0mm; border-top: 0mm; width:60%;font-size:8pt;" > &nbsp;</td>
			
		</tr>
		<tr style="font-size: 7pt;">
			<td style="border-top: 0mm; border-bottom: 0mm; width: 40%;"></td>
			
			<th width="60%" style="font-size:8pt; text-align: left; width: 60%; border-bottom:0mm; background-color:#BDBDBD;" >
					Adjuntos:			
			</th>
		</tr>
	</table>

	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		
		<tr style="font-size: 9pt;">
			<td style="width:40%; border-top:0mm;"></td>
			<td  style="width:25%; font-size: 8pt; background-color:#BDBDBD;"  align="left">
				<b>Copias :</b>
			</td>
			<td style="width:35%; font-size: 8pt; background-color:#BDBDBD;" align="left">
				<b>Firma de derivaci&oacute;n :</b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>	
	

	<!-- ######################################################################### -->
	<p></p>
	<!-- ######################################################################### -->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr style="border-top:0mm;">
			<th style="width:443px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
				<b>Destinatario: </b>
			</th>
			
			<td style="width: 135px; font-size: 8pt;text-align: left; background-color:#BDBDBD;"  align="left">
				<b>Fecha: </b>
			</td>
			<td align="20"  align="left" style="width: 116px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
					<b>Hora: </b>
			</td>
			
		</tr>
	</table>
	<!--<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			<td style="border-bottom: 0mm; width: 40%; font-size: 8pt;"></td>
			<th style="width: 25%; font-size: 8pt; text-align: left; background-color:#BDBDBD;" ><b>Firma de Recepci&oacute;n: </b></th>
			<th style="width: 15%;  text-align: left; text-align: left; font-size: 8pt;  background-color:#BDBDBD;"><b>Hora: </b></th>
			<th style="width: 20%; text-align: left; font-size: 8pt; background-color:#BDBDBD;"><b>Fecha: </b></th>
		</tr>
	</table>-->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			
			<td align="center"  style="border-bottom: 0mm; border-top: 0mm; width:40%;font-size:8pt;" >
				<br><span style="color:gray;">Sello de Recepci&oacute;n</span><br><br><br><br><br><br><br><br><br><br><br><br>
			</td>
			<td style="border-bottom: 0mm; border-top: 0mm; width:60%;font-size:8pt;" > &nbsp;</td>
			
		</tr>
		<tr style="font-size: 7pt;">
			<td style="border-top: 0mm; border-bottom: 0mm; width: 40%;"></td>
			
			<th width="60%" style="font-size:8pt; text-align: left; width: 60%; border-bottom:0mm; background-color:#BDBDBD;" >
					Adjuntos:			
			</th>
		</tr>
	</table>

	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		
		<tr style="font-size: 9pt;">
			<td style="width:40%; border-top:0mm;"></td>
			<td  style="width:25%; font-size: 8pt; background-color:#BDBDBD;"  align="left">
				<b>Copias :</b>
			</td>
			<td style="width:35%; font-size: 8pt; background-color:#BDBDBD;" align="left">
				<b>Firma de derivaci&oacute;n :</b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>	
	

	<!-- ######################################################################### -->
	<p></p>
	<!-- ######################################################################### -->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr style="border-top:0mm;">
			<th style="width:443px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
				<b>Destinatario: </b>
			</th>
			
			<td style="width: 135px; font-size: 8pt;text-align: left; background-color:#BDBDBD;"  align="left">
				<b>Fecha: </b>
			</td>
			<td align="20"  align="left" style="width: 116px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
					<b>Hora: </b>
			</td>
			
		</tr>
	</table>
	<!--<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			<td style="border-bottom: 0mm; width: 40%; font-size: 8pt;"></td>
			<th style="width: 25%; font-size: 8pt; text-align: left; background-color:#BDBDBD;" ><b>Firma de Recepci&oacute;n: </b></th>
			<th style="width: 15%;  text-align: left; text-align: left; font-size: 8pt;  background-color:#BDBDBD;"><b>Hora: </b></th>
			<th style="width: 20%; text-align: left; font-size: 8pt; background-color:#BDBDBD;"><b>Fecha: </b></th>
		</tr>
	</table>-->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			
			<td align="center"  style="border-bottom: 0mm; border-top: 0mm; width:40%;font-size:8pt;" >
				<br><span style="color:gray;">Sello de Recepci&oacute;n</span><br><br><br><br><br><br><br><br><br><br><br><br>
			</td>
			<td style="border-bottom: 0mm; border-top: 0mm; width:60%;font-size:8pt;" > &nbsp;</td>
			
		</tr>
		<tr style="font-size: 7pt;">
			<td style="border-top: 0mm; border-bottom: 0mm; width: 40%;"></td>
			
			<th width="60%" style="font-size:8pt; text-align: left; width: 60%; border-bottom:0mm; background-color:#BDBDBD;" >
					Adjuntos:			
			</th>
		</tr>
	</table>

	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		
		<tr style="font-size: 9pt;">
			<td style="width:40%; border-top:0mm;"></td>
			<td  style="width:25%; font-size: 8pt; background-color:#BDBDBD;"  align="left">
				<b>Copias :</b>
			</td>
			<td style="width:35%; font-size: 8pt; background-color:#BDBDBD;" align="left">
				<b>Firma de derivaci&oacute;n :</b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>	
	

	<!-- ######################################################################### -->
        
	<div style="page-break-after: always"></div>
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->


	<!-- TERCERA PAGINA -->
	<!-- ######################################################################### -->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr style="border-top:0mm;">
			<th style="width:443px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
				<b>Destinatario: </b>
			</th>
			
			<td style="width: 135px; font-size: 8pt;text-align: left; background-color:#BDBDBD;"  align="left">
				<b>Fecha: </b>
			</td>
			<td align="20"  align="left" style="width: 116px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
					<b>Hora: </b>
			</td>
			
		</tr>
	</table>
	<!--<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			<td style="border-bottom: 0mm; width: 40%; font-size: 8pt;"></td>
			<th style="width: 25%; font-size: 8pt; text-align: left; background-color:#BDBDBD;" ><b>Firma de Recepci&oacute;n: </b></th>
			<th style="width: 15%;  text-align: left; text-align: left; font-size: 8pt;  background-color:#BDBDBD;"><b>Hora: </b></th>
			<th style="width: 20%; text-align: left; font-size: 8pt; background-color:#BDBDBD;"><b>Fecha: </b></th>
		</tr>
	</table>-->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			
			<td align="center"  style="border-bottom: 0mm; border-top: 0mm; width:40%;font-size:8pt;" >
				<br><span style="color:gray;">Sello de Recepci&oacute;n</span><br><br><br><br><br><br><br><br><br><br><br><br>
			</td>
			<td style="border-bottom: 0mm; border-top: 0mm; width:60%;font-size:8pt;" > &nbsp;</td>
			
		</tr>
		<tr style="font-size: 7pt;">
			<td style="border-top: 0mm; border-bottom: 0mm; width: 40%;"></td>
			
			<th width="60%" style="font-size:8pt; text-align: left; width: 60%; border-bottom:0mm; background-color:#BDBDBD;" >
					Adjuntos:			
			</th>
		</tr>
	</table>

	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		
		<tr style="font-size: 9pt;">
			<td style="width:40%; border-top:0mm;"></td>
			<td  style="width:25%; font-size: 8pt; background-color:#BDBDBD;"  align="left">
				<b>Copias :</b>
			</td>
			<td style="width:35%; font-size: 8pt; background-color:#BDBDBD;" align="left">
				<b>Firma de derivaci&oacute;n :</b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>	
	

	<!-- ######################################################################### -->
	<p></p>	
	<!-- ######################################################################### -->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr style="border-top:0mm;">
			<th style="width:443px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
				<b>Destinatario: </b>
			</th>
			
			<td style="width: 135px; font-size: 8pt;text-align: left; background-color:#BDBDBD;"  align="left">
				<b>Fecha: </b>
			</td>
			<td align="20"  align="left" style="width: 116px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
					<b>Hora: </b>
			</td>
			
		</tr>
	</table>
	<!--<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			<td style="border-bottom: 0mm; width: 40%; font-size: 8pt;"></td>
			<th style="width: 25%; font-size: 8pt; text-align: left; background-color:#BDBDBD;" ><b>Firma de Recepci&oacute;n: </b></th>
			<th style="width: 15%;  text-align: left; text-align: left; font-size: 8pt;  background-color:#BDBDBD;"><b>Hora: </b></th>
			<th style="width: 20%; text-align: left; font-size: 8pt; background-color:#BDBDBD;"><b>Fecha: </b></th>
		</tr>
	</table>-->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			
			<td align="center"  style="border-bottom: 0mm; border-top: 0mm; width:40%;font-size:8pt;" >
				<br><span style="color:gray;">Sello de Recepci&oacute;n</span><br><br><br><br><br><br><br><br><br><br><br><br>
			</td>
			<td style="border-bottom: 0mm; border-top: 0mm; width:60%;font-size:8pt;" > &nbsp;</td>
			
		</tr>
		<tr style="font-size: 7pt;">
			<td style="border-top: 0mm; border-bottom: 0mm; width: 40%;"></td>
			
			<th width="60%" style="font-size:8pt; text-align: left; width: 60%; border-bottom:0mm; background-color:#BDBDBD;" >
					Adjuntos:			
			</th>
		</tr>
	</table>

	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		
		<tr style="font-size: 9pt;">
			<td style="width:40%; border-top:0mm;"></td>
			<td  style="width:25%; font-size: 8pt; background-color:#BDBDBD;"  align="left">
				<b>Copias :</b>
			</td>
			<td style="width:35%; font-size: 8pt; background-color:#BDBDBD;" align="left">
				<b>Firma de derivaci&oacute;n :</b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>	
	

	<!-- ######################################################################### -->
	<p></p>
	<!-- ######################################################################### -->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr style="border-top:0mm;">
			<th style="width:443px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
				<b>Destinatario: </b>
			</th>
			
			<td style="width: 135px; font-size: 8pt;text-align: left; background-color:#BDBDBD;"  align="left">
				<b>Fecha: </b>
			</td>
			<td align="20"  align="left" style="width: 116px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
					<b>Hora: </b>
			</td>
			
		</tr>
	</table>
	<!--<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			<td style="border-bottom: 0mm; width: 40%; font-size: 8pt;"></td>
			<th style="width: 25%; font-size: 8pt; text-align: left; background-color:#BDBDBD;" ><b>Firma de Recepci&oacute;n: </b></th>
			<th style="width: 15%;  text-align: left; text-align: left; font-size: 8pt;  background-color:#BDBDBD;"><b>Hora: </b></th>
			<th style="width: 20%; text-align: left; font-size: 8pt; background-color:#BDBDBD;"><b>Fecha: </b></th>
		</tr>
	</table>-->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			
			<td align="center"  style="border-bottom: 0mm; border-top: 0mm; width:40%;font-size:8pt;" >
				<br><span style="color:gray;">Sello de Recepci&oacute;n</span><br><br><br><br><br><br><br><br><br><br><br><br>
			</td>
			<td style="border-bottom: 0mm; border-top: 0mm; width:60%;font-size:8pt;" > &nbsp;</td>
			
		</tr>
		<tr style="font-size: 7pt;">
			<td style="border-top: 0mm; border-bottom: 0mm; width: 40%;"></td>
			
			<th width="60%" style="font-size:8pt; text-align: left; width: 60%; border-bottom:0mm; background-color:#BDBDBD;" >
					Adjuntos:			
			</th>
		</tr>
	</table>

	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		
		<tr style="font-size: 9pt;">
			<td style="width:40%; border-top:0mm;"></td>
			<td  style="width:25%; font-size: 8pt; background-color:#BDBDBD;"  align="left">
				<b>Copias :</b>
			</td>
			<td style="width:35%; font-size: 8pt; background-color:#BDBDBD;" align="left">
				<b>Firma de derivaci&oacute;n :</b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>	
	

	<!-- ######################################################################### -->
	<p></p>
	<!-- ######################################################################### -->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr style="border-top:0mm;">
			<th style="width:443px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
				<b>Destinatario: </b>
			</th>
			
			<td style="width: 135px; font-size: 8pt;text-align: left; background-color:#BDBDBD;"  align="left">
				<b>Fecha: </b>
			</td>
			<td align="20"  align="left" style="width: 116px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
					<b>Hora: </b>
			</td>
			
		</tr>
	</table>
	<!--<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			<td style="border-bottom: 0mm; width: 40%; font-size: 8pt;"></td>
			<th style="width: 25%; font-size: 8pt; text-align: left; background-color:#BDBDBD;" ><b>Firma de Recepci&oacute;n: </b></th>
			<th style="width: 15%;  text-align: left; text-align: left; font-size: 8pt;  background-color:#BDBDBD;"><b>Hora: </b></th>
			<th style="width: 20%; text-align: left; font-size: 8pt; background-color:#BDBDBD;"><b>Fecha: </b></th>
		</tr>
	</table>-->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			
			<td align="center"  style="border-bottom: 0mm; border-top: 0mm; width:40%;font-size:8pt;" >
				<br><span style="color:gray;">Sello de Recepci&oacute;n</span><br><br><br><br><br><br><br><br><br><br><br><br>
			</td>
			<td style="border-bottom: 0mm; border-top: 0mm; width:60%;font-size:8pt;" > &nbsp;</td>
			
		</tr>
		<tr style="font-size: 7pt;">
			<td style="border-top: 0mm; border-bottom: 0mm; width: 40%;"></td>
			
			<th width="60%" style="font-size:8pt; text-align: left; width: 60%; border-bottom:0mm; background-color:#BDBDBD;" >
					Adjuntos:			
			</th>
		</tr>
	</table>

	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		
		<tr style="font-size: 9pt;">
			<td style="width:40%; border-top:0mm;"></td>
			<td  style="width:25%; font-size: 8pt; background-color:#BDBDBD;"  align="left">
				<b>Copias :</b>
			</td>
			<td style="width:35%; font-size: 8pt; background-color:#BDBDBD;" align="left">
				<b>Firma de derivaci&oacute;n :</b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>	
	

	<!-- ######################################################################### -->
	
	<div style="page-break-after: always"></div>
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->


	<!-- CUARTA PAGINA -->
	<!-- ######################################################################### -->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr style="border-top:0mm;">
			<th style="width:443px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
				<b>Destinatario: </b>
			</th>
			
			<td style="width: 135px; font-size: 8pt;text-align: left; background-color:#BDBDBD;"  align="left">
				<b>Fecha: </b>
			</td>
			<td align="20"  align="left" style="width: 116px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
					<b>Hora: </b>
			</td>
			
		</tr>
	</table>
	<!--<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			<td style="border-bottom: 0mm; width: 40%; font-size: 8pt;"></td>
			<th style="width: 25%; font-size: 8pt; text-align: left; background-color:#BDBDBD;" ><b>Firma de Recepci&oacute;n: </b></th>
			<th style="width: 15%;  text-align: left; text-align: left; font-size: 8pt;  background-color:#BDBDBD;"><b>Hora: </b></th>
			<th style="width: 20%; text-align: left; font-size: 8pt; background-color:#BDBDBD;"><b>Fecha: </b></th>
		</tr>
	</table>-->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			
			<td align="center"  style="border-bottom: 0mm; border-top: 0mm; width:40%;font-size:8pt;" >
				<br><span style="color:gray;">Sello de Recepci&oacute;n</span><br><br><br><br><br><br><br><br><br><br><br><br>
			</td>
			<td style="border-bottom: 0mm; border-top: 0mm; width:60%;font-size:8pt;" > &nbsp;</td>
			
		</tr>
		<tr style="font-size: 7pt;">
			<td style="border-top: 0mm; border-bottom: 0mm; width: 40%;"></td>
			
			<th width="60%" style="font-size:8pt; text-align: left; width: 60%; border-bottom:0mm; background-color:#BDBDBD;" >
					Adjuntos:			
			</th>
		</tr>
	</table>

	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		
		<tr style="font-size: 9pt;">
			<td style="width:40%; border-top:0mm;"></td>
			<td  style="width:25%; font-size: 8pt; background-color:#BDBDBD;"  align="left">
				<b>Copias :</b>
			</td>
			<td style="width:35%; font-size: 8pt; background-color:#BDBDBD;" align="left">
				<b>Firma de derivaci&oacute;n :</b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>	
	

	<!-- ######################################################################### -->
	<p></p>	
	<!-- ######################################################################### -->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr style="border-top:0mm;">
			<th style="width:443px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
				<b>Destinatario: </b>
			</th>
			
			<td style="width: 135px; font-size: 8pt;text-align: left; background-color:#BDBDBD;"  align="left">
				<b>Fecha: </b>
			</td>
			<td align="20"  align="left" style="width: 116px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
					<b>Hora: </b>
			</td>
			
		</tr>
	</table>
	<!--<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			<td style="border-bottom: 0mm; width: 40%; font-size: 8pt;"></td>
			<th style="width: 25%; font-size: 8pt; text-align: left; background-color:#BDBDBD;" ><b>Firma de Recepci&oacute;n: </b></th>
			<th style="width: 15%;  text-align: left; text-align: left; font-size: 8pt;  background-color:#BDBDBD;"><b>Hora: </b></th>
			<th style="width: 20%; text-align: left; font-size: 8pt; background-color:#BDBDBD;"><b>Fecha: </b></th>
		</tr>
	</table>-->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			
			<td align="center"  style="border-bottom: 0mm; border-top: 0mm; width:40%;font-size:8pt;" >
				<br><span style="color:gray;">Sello de Recepci&oacute;n</span><br><br><br><br><br><br><br><br><br><br><br><br>
			</td>
			<td style="border-bottom: 0mm; border-top: 0mm; width:60%;font-size:8pt;" > &nbsp;</td>
			
		</tr>
		<tr style="font-size: 7pt;">
			<td style="border-top: 0mm; border-bottom: 0mm; width: 40%;"></td>
			
			<th width="60%" style="font-size:8pt; text-align: left; width: 60%; border-bottom:0mm; background-color:#BDBDBD;" >
					Adjuntos:			
			</th>
		</tr>
	</table>

	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		
		<tr style="font-size: 9pt;">
			<td style="width:40%; border-top:0mm;"></td>
			<td  style="width:25%; font-size: 8pt; background-color:#BDBDBD;"  align="left">
				<b>Copias :</b>
			</td>
			<td style="width:35%; font-size: 8pt; background-color:#BDBDBD;" align="left">
				<b>Firma de derivaci&oacute;n :</b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>	
	

	<!-- ######################################################################### -->
	<p></p>
	<!-- ######################################################################### -->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr style="border-top:0mm;">
			<th style="width:443px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
				<b>Destinatario: </b>
			</th>
			
			<td style="width: 135px; font-size: 8pt;text-align: left; background-color:#BDBDBD;"  align="left">
				<b>Fecha: </b>
			</td>
			<td align="20"  align="left" style="width: 116px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
					<b>Hora: </b>
			</td>
			
		</tr>
	</table>
	<!--<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			<td style="border-bottom: 0mm; width: 40%; font-size: 8pt;"></td>
			<th style="width: 25%; font-size: 8pt; text-align: left; background-color:#BDBDBD;" ><b>Firma de Recepci&oacute;n: </b></th>
			<th style="width: 15%;  text-align: left; text-align: left; font-size: 8pt;  background-color:#BDBDBD;"><b>Hora: </b></th>
			<th style="width: 20%; text-align: left; font-size: 8pt; background-color:#BDBDBD;"><b>Fecha: </b></th>
		</tr>
	</table>-->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			
			<td align="center"  style="border-bottom: 0mm; border-top: 0mm; width:40%;font-size:8pt;" >
				<br><span style="color:gray;">Sello de Recepci&oacute;n</span><br><br><br><br><br><br><br><br><br><br><br><br>
			</td>
			<td style="border-bottom: 0mm; border-top: 0mm; width:60%;font-size:8pt;" > &nbsp;</td>
			
		</tr>
		<tr style="font-size: 7pt;">
			<td style="border-top: 0mm; border-bottom: 0mm; width: 40%;"></td>
			
			<th width="60%" style="font-size:8pt; text-align: left; width: 60%; border-bottom:0mm; background-color:#BDBDBD;" >
					Adjuntos:			
			</th>
		</tr>
	</table>

	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		
		<tr style="font-size: 9pt;">
			<td style="width:40%; border-top:0mm;"></td>
			<td  style="width:25%; font-size: 8pt; background-color:#BDBDBD;"  align="left">
				<b>Copias :</b>
			</td>
			<td style="width:35%; font-size: 8pt; background-color:#BDBDBD;" align="left">
				<b>Firma de derivaci&oacute;n :</b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>	
	

	<!-- ######################################################################### -->
	<p></p>
	<!-- ######################################################################### -->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr style="border-top:0mm;">
			<th style="width:443px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
				<b>Destinatario: </b>
			</th>
			
			<td style="width: 135px; font-size: 8pt;text-align: left; background-color:#BDBDBD;"  align="left">
				<b>Fecha: </b>
			</td>
			<td align="20"  align="left" style="width: 116px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
					<b>Hora: </b>
			</td>
			
		</tr>
	</table>
	<!--<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			<td style="border-bottom: 0mm; width: 40%; font-size: 8pt;"></td>
			<th style="width: 25%; font-size: 8pt; text-align: left; background-color:#BDBDBD;" ><b>Firma de Recepci&oacute;n: </b></th>
			<th style="width: 15%;  text-align: left; text-align: left; font-size: 8pt;  background-color:#BDBDBD;"><b>Hora: </b></th>
			<th style="width: 20%; text-align: left; font-size: 8pt; background-color:#BDBDBD;"><b>Fecha: </b></th>
		</tr>
	</table>-->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			
			<td align="center"  style="border-bottom: 0mm; border-top: 0mm; width:40%;font-size:8pt;" >
				<br><span style="color:gray;">Sello de Recepci&oacute;n</span><br><br><br><br><br><br><br><br><br><br><br><br>
			</td>
			<td style="border-bottom: 0mm; border-top: 0mm; width:60%;font-size:8pt;" > &nbsp;</td>
			
		</tr>
		<tr style="font-size: 7pt;">
			<td style="border-top: 0mm; border-bottom: 0mm; width: 40%;"></td>
			
			<th width="60%" style="font-size:8pt; text-align: left; width: 60%; border-bottom:0mm; background-color:#BDBDBD;" >
					Adjuntos:			
			</th>
		</tr>
	</table>

	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		
		<tr style="font-size: 9pt;">
			<td style="width:40%; border-top:0mm;"></td>
			<td  style="width:25%; font-size: 8pt; background-color:#BDBDBD;"  align="left">
				<b>Copias :</b>
			</td>
			<td style="width:35%; font-size: 8pt; background-color:#BDBDBD;" align="left">
				<b>Firma de derivaci&oacute;n :</b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>	
	

	<!-- ######################################################################### -->
	




<!--#####################################################################-->	
</div>
  

