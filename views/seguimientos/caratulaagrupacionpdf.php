<?php
use app\models\Seguimientos ;
 use Da\QrCode\QrCode;
//use yii\helpers\Json;
//use yii\helpers\json;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
use diggindata\kjua\QrCodeWidget;
$attributes = [
    'label' => 'My Label',
    'mode' => 'label',
    'fill' => 'navy',
    'text' => 'Good morning',
    'rounded' => 50,
    'ecLevel' => 'M',
    'crisp' => false,
    'mSize' => 20,
    'options'=>['style'=>'display:inline']
];*/

?>
<?php //= QrCodeWidget::widget($attributes); ?>
<link href="<?= Yii::$app->request->baseUrl ?>/css/estilos.css" rel="stylesheet" type="text/css">
<table align="center" align="center" width="100%">
	<tr>
		<!--<td style="text-align: center;">
			<img src="<?=Yii::$app->request->baseUrl; ?>/images/logo_hr.png" style="width:150px; height:100px;" >
		</td>-->
                <td style="text-align: center; background-color: #D8D8D8; padding: 7px;">
			<b><u>NUR/NURI de AGRUPACI&Oacute;N</u></b>
		</td>
	</tr>
	<tr><td></td></tr>
	<tr>
		<td style="text-align: center;">
                    <b style="font-size:20.0pt;" class="numero"><?=$model->codigo?></b><br>
			<!--<img src="<?php //=Yii::$app->request->baseUrl; ?>/images/organizar_carpetas.jpg" style="width:250px; height:200px;" >-->
                    <?php
                        $secundarios=" NURIS SECUNDARIOS";
                        $dataReader=Seguimientos::getListAgrupacion($model->id_seguimiento);
                        foreach ($dataReader as $row)
                        {
                            $secundarios=$secundarios." - ".$row['nur_hijo'];
                        }
                    
                            
                         $texto='NURI PRINCIPAL: '.$model->codigo." ".$secundarios;
                         $qrCode = (new QrCode($texto))
                                    ->setSize(150)
                                    ->setMargin(10)
                                    ->useForegroundColor(51, 153, 255);

                         $qrCode->writeFile(__DIR__ . '/code.png'); // writer defaults to PNG when none is specified

                         // display directly to the browser 
                         header('Content-Type: '.$qrCode->getContentType());
                         //echo $qrCode->writeString();

                         // or even as data:uri url
                         echo '<img src="' . $qrCode->writeDataUri() . '">';
                    ?>
		</td>
	</tr>
	<tr>
		<td style="text-align: center;">
			

			<!--
				Esta extensión genera una matriz de código QR con la API de Google. Genera una imagen de qrcode y también la almacena (en una ruta determinada).

				Puede cambiar todos los parámetros de qrcode como 'contenido', 'altura', 'ancho', 'corrección de errores', 'enconding', etc.

				Para guardar la imagen de qrcode en la carpeta especificada, puede cambiar la ruta cambiando el valor de $ filePath y $ fileUrl en el archivo QRCode.php	
			-->


			<?php 


			// codigo para almacenar todos los nuris en una variable y mostrarlo en el codigo qr
			$nuris='';

			$dataReader3=Seguimientos::getListaNurisAgrupadosCompleto($model->codigo); 
		 	foreach ($dataReader3 as $row2) { 
  	     			if ($nuris=='') {	$nuris=$row2['nuri'];			}
  	     			else{	$nuris=$nuris.'; '.$row2['nuri'];  			}
  	     		}
  	     	?>	


			
		</td>
	</tr>
</table>

<br>
<table  align="center" width="50%"><tr><td align="center"><b>NUR/NURI(s) AGRUPADOS</b></td></tr></table>
<center>
	
</center>	
	<table align="center" class="tabla_agrupacion" width="87%" cellspacing="0" cellpadding="5">
            <tr style="font-size:12px; background-color: #D8D8D8; padding:6px;">
		<td align="center" style=" color:#0D1028; padding:6px; font-size:10pt; "><b>N.</b></td>
		<td align="center" style=" color:#0D1028; padding:6px; font-size:10pt; "><b>NUR/NURI</b></td>
		<td align="center" style="color:#0D1028; font-size:10pt; "><b>Usuario</b></td>
		<td align="center" style="color:#0D1028; font-size:10pt;  width: 150px;  "><b>Tipo<br> Documento</b></td> 
		<td align="center" style="color:#0D1028; font-size:10pt; width: 150px; "><b>Fecha<br> Agrupaci&oacute;n</b></td>
            </tr>
	   		
	<?php $dataReader2=Seguimientos::getListaNurisAgrupadosCompleto($model->codigo); 
            $i=0;
	?>	
  	<?php foreach ($dataReader2 as $row2) { 
  	     		$i++; ?>	
		<tr>
		    <td style="font-size: 9pt; text-align: center;" ><?=$i?></td>
		    <td style="font-size: 9pt; text-align: center;" ><?=$row2['nuri']?></td>
		    <td style="font-size: 9pt; text-align: left;"><?=$row2['usuario_agrupacion']?></td>
		    <td style="font-size: 9pt; text-align: center;"><?=$row2['tipo_documento']?></td>
		    <td style="font-size: 9pt; text-align: center;"><?=Yii::$app->formatter->asDate($row2['fecha_agrupacion'], 'long')?></td>
                </tr>
	   <?php } ?>
	</table>
<br>
<center>
<i style="width:70%; font-size: 9px; text-align: center;"><b>Nota:</b> Señor usuario, verifique al momento de recibir este documento, que todos los NUR/NURI(s) adjuntos se encuentran f&iacute;sicamente, de lo contrario no lo reciba.</i>	
</center>
