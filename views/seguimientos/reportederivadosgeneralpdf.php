<?php
ini_set("pcre.backtrack_limit", "5000000");
use yii\helpers\Html;
use app\models\Seguimientos;
/* @var $this yii\web\View */
/* @var $model app\models\Seguimientos */

$this->title = 'Create Seguimientos';
$this->params['breadcrumbs'][] = ['label' => 'Seguimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<table align="center" class="tabla_agrupacion" width="100%" cellspacing="0" cellpadding="6" >
    <thead>
	<tr style="font-size: 10px; background-color: #E1E1E1; padding:6px;">
            <th align="center" style="font-size: 10px;">N.</th>
            <th align="center" style="font-size: 10px;">NUR/NURI</th>
            <th align="center" style="font-size: 10px;">REFERENCIA | PROVE&Iacute;DO</th>
            <th align="center" style="font-size: 10px;">PROCEDENCIA | REMITENTE</th>
            <th align="center" style="font-size: 10px;">DERIVADO A</th>
            <th align="center" style="font-size: 10px;">FECHA/HORA DERIVACI&Oacute;N</th>
            <th align="center" style="font-size: 10px;">SELLO RECEPCI&Oacute;N UNIDAD/&Aacute;REA</th>  
            <th align="center" style="font-size: 10px;">V°B° RESPONSABLE RECEPCI&Oacute;N</th>      	
	</tr>
    </thead>
 <tbody>
 <?php 
 $j=0;
 //$dataReader=Seguimientos::getDerivadosNoRecibidos(Yii::$app->user->identity->id_usuario); ?>

 <?php 

  foreach($seguimientos['id_seguimiento'] as $key => $val) {

   if($val!=0){

    $row=Seguimientos::getDerivadosNoRecibidosgeneral(Yii::$app->user->identity->id_usuario, $val);

  //foreach ($dataReader as $row) { 
  $fila=Seguimientos::getObtenerReferenciaRemitente($row['nuri']);
  $j++;    
 ?>
                <tr style="font-size: 9px; ">
                    <td style="font-size: 10px; border-right: solid 1px lightgrey; border-bottom: 0.05em solid #1C1C1C;"><?=$j?></td>
                        <td align="center" style="font-size: 10px; border-bottom: 0.05em solid #1C1C1C;">
                            <?php if ($row['tipo_documento']=="ORIGINAL") { ?>
                            <img src="./images/manito.jpg" width="20px" height="20px" ><br>
                            <?php } ?>
                                    <i style="font-size: 7px; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i><br>
                                    <?=$row['nuri']?>
                        </td>
                        <td style="font-size: 9px; border-bottom: 0.05em solid #1C1C1C;">
                          <?=htmlentities($fila['referencia'])?><br>		
                          <b>PROVE&Iacute;DO: </b><?=$row['proveido']?>
                        </td>

                        <td style="font-size: 9px; border-bottom: 0.05em solid #1C1C1C;">
                          <?=$fila['remitente_nombres']?><br>		
                          <b><i><?=$fila['remitente_cargo']?></i></b>
                        </td>
                        <td style="font-size: 9px; border-bottom: 0.05em solid #1C1C1C;" align="left"><?=$row['usuario_destino']?></td>
                        <td style="font-size: 9px; border-bottom: 0.05em solid #1C1C1C;" align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))."<br> ".$row['h_derivacion']?></td>
                        <td style="width:20%; border-bottom: 0.05em solid #1C1C1C;">
                            <br><br><br><br><br><br>
                        </td>
                        <td style="width:10%; border-bottom: 0.05em solid #1C1C1C;"><br><br><br><br><br><br><br></td>
                </tr>
            <?php

    }// end if
} // end for
?>
    </tbody>
</table>