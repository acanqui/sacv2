<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\Documentos;
use app\models\Usuarios;


header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.Documentos::getNameTipoDocumento($tipo).'-'.$gestion.'.xls"');
header('Cache-Control: max-age=0');
?>

<table>
    <tr>
        <td colspan="7" style="text-align: center; font-size: 17pt; font-weight: bold;">
            REPORTE DE CITES GENERADOS <br><?=Documentos::getNameTipoDocumento($tipo)?> - <?=$gestion?><br>
            SISTEMA DE ADMINISTRACI&Oacute;N DE CORRESPONDENCIA -SAC
        </td>
    </tr>
</table>

<table align="center" class="tabla_agrupacion" width="95%" cellspacing="0" cellpadding="6">
    <tr style="background-color: #BDBDBD; color:black; font-weight: bold; ">
        <th>N.</th>
        <th>NUR/NURI</th>
        <th>CITE</th>
        
        <th>REFERENCIA</th>
        <th>NOMBRE DESTINO</th>
        <th>CARGO DESTINO</th>

        <th>FECHA GENERACI&Oacute;N</th>
    </tr>
<?php 

$i=0;
$dataReader=Documentos::reporteCites($id_area, $gestion, $tipo);

foreach($dataReader as $row){
    $i++;
    
    if($i%2==0){
          $color=" background:#EAECEE;";
        }
     else{
         $color="";
    }
?>
    <tr valign='middle' style="font-size: 16px; border-bottom: 0px solid #1C1C1C; <?=$color?> ">
        <td align="center"><?=$i?></td>

        <td><?=$row['nuri']?></td>
        <td><?=htmlentities($row['cite'])?></td>
        <td><?=htmlentities($row['referencia'])?></td>
        
        <td><?=htmlentities($row['destinatario_nombres'])?></td>
        <td><?=htmlentities($row['destinatario_cargo'])?></td>
        
        <td align="center"><?=$row['fecha']?></td>
        
    </tr>
    
    
<?php } ?>    
</table>
