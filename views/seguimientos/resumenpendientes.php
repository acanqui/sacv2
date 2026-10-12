<?php
namespace app\models;

use Yii;
use app\models\Seguimientos;
use yii\helpers\Html;

/*use app\models\Agrupaciones;
use app\models\Usuarios;
use app\models\Hojasruta;*/
?>


<style>
 
    table tr td{
        font-size: 9pt;
        /*border: solid 0.01mm black;*/
        padding: 5px;
    }
    table tr th{
        font-size: 9pt;
        text-align: center;
        background: #B8C7CC;
        color: #222D32;
        border-bottom: solid 0.01mm grey;
        padding: 5px;
    }
    
    
    
    

    
    
</style>


<center>
    <h3>
    	<b>Resumen de Pendientes <br> Sistema de Administraci&oacute;n de Correspondencia "S.A.C."</b><br><br>

    	&Aacute;reas dependientes de <u><?=Yii::$app->user->identity->fkArea->area?></u>

    </h3>
</center>
<br>
<div class="site-index">
 <div class="body-content">  
  <div class="row">
    <div class="col-md-12">
        <center>
            <table class="table-striped table-hover" style="width:80%" >
            <tr>
                <th>N.</th>
                <th>Area/Unidad</th>
                <th>Sigla</th>
                <th>Pendientes<br> Oficiales</th>
                <th>Copias<br> Pendientes</th>
                <th>Total<br> Pendientes</th>
                <th>No <br>Recibidos</th>
                <th colspan="2">Acciones</th>
            </tr>
            <?php 
                $i=0;
                $total=0;
                $totalmorecibidos=0;
                $dataReader=Seguimientos::getPendientesAreaSAC();
                foreach ($dataReader as $row){ 
                $i++;
                $total=$total+$row['total_pendientes'];
                $totalmorecibidos=$totalmorecibidos+$row['no_recibidos'];
            ?>
            <tr>
                <th style="text-align: center;"><?=$i?></th>
                <th style="text-align: left;"><?=$row['area']?></th>
                <td><?=$row['sigla']?></td>
                <td style="text-align:right;"><?=$row['pendientes_oficiales']?></td>
                <td style="text-align:right;"><?=$row['pendientes_digitales']?></td>
                <td style="text-align:right;"><?=$row['total_pendientes']?></td>
                <td style="text-align:right;"><?=$row['no_recibidos']?></td>
                <td style="text-align: center;">
                	<?=Html::a("<i class='glyphicon glyphicon-user'></i> <span style='font-size:9pt;'> Personal </span>", ['seguimientos/resumenpendientespersonal', 'id_area'=>$row['id_area']], ['class' => 'btn btn-primary active']); ?>
                </td>
                <td style="text-align: center;">
                	<?=Html::a("<i class='fa fa-file-excel-o'></i> <span style='font-size:9pt;'> Detalle </span>", ['seguimientos/pendientesareaexcel', 'id'=>$row['id_area']], ['class' => 'btn btn-success active']); ?>
                </td>

            </tr>  
            
            <?php } ?>
            <tr>
                <th  style="text-align:right;" colspan="5">Total</th>
                
                <th style="text-align:right;"><?=$total?></th>
                <th style="text-align:right;"><?=$totalmorecibidos?></th>
                <th></th>
                <th></th>
            </tr>
            
        </table>
        </center>
        
    </div>
  </div>
 </div>
</div>    

