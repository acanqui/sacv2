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

    	   Personal dependiente de <u><?=Seguimientos::getnamearea($id_area)?></u>

    </h3>
</center>
<br>
<center>
<?=Html::a("<i class='glyphicon glyphicon-arrow-left'></i> <span style='font-size:9pt;'> Retornar</span>", ['seguimientos/resumenpendientes'], ['class' => 'btn btn-danger' ]); ?>
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
                <th>Nombre</th>
                <th>Cargo</th>
                <th>Pendientes<br> Oficiales</th>
                <th>Copias<br> Pendientes</th>
                <th>No <br>Recibidos</th>
                <th>Sin<br>Confirmar</th>
                <th>Pendiente mas <br>antiguo</th>
                <th>Acciones</th>
            </tr>
            <?php 
                $i=0;
                $dataReader=Seguimientos::getpendientespersonal($id_area);
                foreach ($dataReader as $row){ 
                $i++;


                if($row['pendiente_antiguo']=="1000-01-01"){

                    $fecha="";
                }
                else{
                    $fecha=date_format(date_create($row['pendiente_antiguo']),"d/m/Y");
                }
            ?>
            <tr>
                <th style="text-align: center;"><?=$i?></th>
                <th style="text-align: left;"><?=strtoupper($row['nombre'])?></th>
                <td style="text-align:left;"><?=strtoupper($row['cargo'])?></td>
                <td style="text-align:right;"><?=$row['pendientes_oficiales']?></td>
                <td style="text-align:right;"><?=$row['copias_pendientes']?></td>
                <td style="text-align:right;"><?=$row['no_recibidos']?></td>
                <td style="text-align:right;"><?=$row['sin_confirmar']?></td>
                <td style="text-align:right;"><?=$fecha?></td>
                <td style="text-align: center;">
                	<?=Html::a("<i class='fa fa-file-excel-o'></i> <span style='font-size:9pt;'> Detalle </span>", ['seguimientos/pendientesusuarioexcel', 'id'=>$row['id_usuario']], ['class' => 'btn btn-primary active']); ?>
                </td>

            </tr>  
            
            <?php } ?>
            
            
        </table>
        </center>
        
    </div>
  </div>
 </div>
</div>    

