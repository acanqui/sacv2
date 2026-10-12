<?php

/* @var $this yii\web\View */

use yii\helpers\Html;


?>

<style type="text/css">
.fila{
      	border-bottom: .5px solid #1C1C1C;
     }
</style>

<center>
<p align="center" style="font-size: 14px;"><b>NO RECIBIDOS</b></p>
</center>
	<table align="center" class="tabla_agrupacion" width="95%" cellspacing="0" cellpadding="3">
		<tr style="background-color: #FBFBFB; color: #2E2E2F;">
			<th style="font-size:9pt; padding:5px; text-align: center;">NUR/NURI</th>
			<th style="font-size:9pt; padding:5px; text-align: center;">REFERENCIA</th>
			<!--<th style="font-size:12px;"></th>-->
		</tr>
        <?php $dataReader= app\models\Seguimientos::getNorecibidos(Yii::$app->user->identity->id_usuario); ?>	

		<?php foreach ($dataReader as $row) { ?>	
		  <tr  style="font-size: 9px;" class="fila">

		    <td align="center" style="font-size: 8pt; width:75px; border-bottom: solid 0.01em white;">
		    	<i style="font-size: 8pt; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i><br><?=$row['nuri']?>
		    </td>
		    <td style="font-size: 7pt; text-align: left; border-bottom: solid 0.05em white; text-align: justify;" ><?=$row['referencia']?></td>
		    <!--<td style="font-size: 8pt;" align="center">
		    	<a class="btn btn-default btn-sm" href="index.php?r=seguimientos/busquedaIndex&nuri=<?=$row['nuri']?>">
                        <i class="fa fa-paw"></i> Seguimiento</a>
		    </td>-->
		 </tr>
		<?php } ?>
	   
	</table>

<br>

<center>
<p align="center" style="font-size: 14px;"><b>PENDIENTES OFICIALES Y COPIAS</b></p>
</center>
	<table align="center" class="tabla_agrupacion" width="95%" cellspacing="0" cellpadding="3">
		<tr style="background-color: #FBFBFB; color: #2E2E2F;">
			<th style="font-size:9pt; padding:5px; text-align: center;">NUR/NURI</th>
			<th style="font-size:9pt; padding:5px; text-align: center;">REFERENCIA</th>
			<!--<th style="font-size:12px;"></th>-->
		</tr>
        <?php $dataReader= app\models\Seguimientos::getPendientes(Yii::$app->user->identity->id_usuario); ?>	

		<?php foreach ($dataReader as $row) { ?>	
		  <tr  style="font-size: 9px;" class="fila">

		    <td align="center" style="font-size: 8pt; width:75px; border-bottom: solid 0.01em white;">
		    	<i style="font-size: 8pt; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i><br><?=$row['nuri']?>
		    </td>
		    <td style="font-size: 7pt; text-align: left; border-bottom: solid 0.05em white; text-align: justify;" ><?=$row['referencia']?></td>
		    <!--<td style="font-size: 8pt;" align="center">
		    	<a class="btn btn-default btn-sm" href="index.php?r=seguimientos/busquedaIndex&nuri=<?=$row['nuri']?>">
                        <i class="fa fa-paw"></i> Seguimiento</a>
		    </td>-->
		 </tr>
		<?php } ?>
	   
	</table>

<br>

