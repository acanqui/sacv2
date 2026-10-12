<?php

use yii\helpers\Html;
use app\models\Usuarios;
use app\models\Acciones;
use app\models\Seguimientos;

/* @var $this yii\web\View */
/* @var $model app\models\Seguimientos */

//$this->title = 'Create Seguimientos';
$this->params['breadcrumbs'][] = ['label' => 'Desagrupar NUR/NURI', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Desagrupar';
?>

<style>


table tr td {
    border: solid gray 0.1em;
}


</style>

<br><br>
<div class="row">
    <div class="col-md-12">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="glyphicon glyphicon-transfer" style="font-size:30pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><span style="font-size: 18pt;">Desagrupar Tr&aacute;mites del NUR/NURI principal <?=$model->codigo?></span></b>
          </h5>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php 
            echo Html::a("<i style='font-size:12pt;' class='glyphicon glyphicon-print'></i> <br>Caratula <br>Agrupación", ['imprimicaratulaagrupacion', 'id'=>$model->id_seguimiento], ['class' => 'btn btn-primary', 'target'=>'_blank']);
            //echo " ".Html::a("<i style='font-size:12pt;' class='fa fa-file-pdf-o'></i> <br>Reporte PDF", ['pendientescopiaspdf'], ['class' => 'btn btn-warning', 'target'=>'_blank']);
        ?>
    </div>
</div>
<br>

<div class="seguimientos-create">

    <table class="table table-bordered table-striped table-hover" style="border: solid gray 0.1em;">
        <tr style="background-color: #B8C7CD;">
            <th style="text-align: center;">NUR/NURI<br> PRINCIPAL</th>
            <th style="text-align: center;">DERIVADO POR</th>
            <th style="text-align: center;">PROVE&Iacute;DO/REFERENCIA</th>
            <th style="text-align: center;">NUR/NURI SECUNDARIOS</th>
        </tr>
        <tr>
            <td  style="vertical-align: middle;">
                <?=Seguimientos::getMostrarCodigo($model->oficial, $model->codigo, $model->numero_copia)?>
            </td>
            <td style="vertical-align: middle;">
                <?=Seguimientos::getUsuarioPendientes($model->derivado_por);?>
            </td>
            <td style="vertical-align: middle;">
                <?=Seguimientos::getReferenciaSintesis($model->codigo, $model->proveido)?>
            </td>
            <td style="vertical-align: middle;">
                <table class="table table-bordered table-striped table-hover">
                    <tr style="background-color: #B8C7CD;">
                        <th>NUR/NURI</th>
                        <th>AGRUPADO POR</th>
                        <th>PROVE&Iacute;DO</th>
                        <th>DESAGRUPAR</th>
                    </tr>
                    <?php 
                        $dataReader=Seguimientos::getListAgrupacion($model->codigo);
                        
                        foreach ($dataReader as $row)
                        {   
                          $seguimientos= Seguimientos::findOne($row['fk_seguimiento_hijo']);  
                    ?>
                    <tr>
                        <td style="vertical-align: middle;"><?=Seguimientos::getMostrarCodigo($seguimientos->oficial, $seguimientos->codigo, $seguimientos->numero_copia)?></td>
                        <td style="vertical-align: middle;"><?=Seguimientos::getUsuarioPendientes($seguimientos->derivado_a);?></td>
                        <td style="vertical-align: middle;"><?=$seguimientos->proveido?></td>
                        <td style="vertical-align: middle;">
                            <?php 
                                    echo Html::a("<i style='font-size:12pt;' class='fa fa-exchange'></i> Desagrupar", ['eliminaragrupacion', 'id_agrupacion'=>$row['id_agrupacion'] ], ['class' => 'btn btn-danger']);
                            ?>
                        </td>
                    </tr>
                     <?php } ?>
                    
                </table>
                
            </td>
        </tr>
            
    </table>
   

</div>
