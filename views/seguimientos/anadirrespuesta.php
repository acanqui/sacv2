<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Seguimientos ;
use app\models\Documentos ;
/* @var $this yii\web\View */
/* @var $model app\models\Seguimientos */

use kartik\widgets\Growl;
if (Yii::$app->session->getFlash('success')){
    echo Growl::widget([
        'type' => Growl::TYPE_SUCCESS,
        'title' => '<b>OPERACIÓN EXITOSA</b>',
        'icon' => 'glyphicon glyphicon-ok-circle',
        //'body' => 'You successfully read this important alert message.',
        'body' => Yii::$app->session->getFlash('success'),
        'showSeparator' => true,
        'delay' => 0,
        'pluginOptions' => [
            'showProgressbar' => true,
            'placement' => [
                'from' => 'top',
                'align' => 'right',
            ],
            'timer'=>1700,
        ]
    ]);
}

if (Yii::$app->session->getFlash('error')){
    echo Growl::widget([
    'type' => Growl::TYPE_DANGER,
    'title' => '<b>ERROR EN LA OPERACION</b>',
    'icon' => 'glyphicon glyphicon-remove-circle',
    //'body' => 'Change a few things up and try submitting again.',
    'body' => Yii::$app->session->getFlash('error'),
    'showSeparator' => true,
    'delay' => 4500,
    'pluginOptions' => [
        'showProgressbar' => true,
        'placement' => [
            'from' => 'top',
            'align' => 'right',
        ],
        'timer'=>1700,
    ]
  ]);
}


//$this->title = $model->id_seguimiento;
$this->params['breadcrumbs'][] = ['label' => 'Seguimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Añadir Respuesta';
\yii\web\YiiAsset::register($this);
?>

<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="fa fa-user-plus" style="font-size:25pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 16pt;">Añadir respuesta</u></b>
          </h5>
        </div>
    </div>
    <div class="col-md-6"></div>
</div>


<section class="content">
 <div class="container-fluid">
  <div class="row">
        <div class="col-md-12">

          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-default" style="width:100%; background: #ECF0F5; border: 1px solid rgba(55,72,79, 0.4);">
                    <?=$model->codigo?> 
                    <b style="color: darkred;"><u>
                    	<?php 
                            if ($model->oficial==1) { echo "Original"; }else { echo "Copia Digital"; }
                    	?>
                    </u></b>
                  </span>
            </li>
            <!-- timeline item -->
            <li >

              <i class="fa fa-sort-alpha-asc" style="background-color: #0080FF; color: white;"></i>

              <div class="timeline-item">


              	<div class="card-body pad table-responsive">
                    <table  id="table_seguimiento" border="1" style="font-size:13px;" class="table table-responsive table-bordered table-hover">
                        <tr>
                            <th style="text-align: right; width: 20%; background-color: #B8C7CD; color: #222D32;">DERIVADO POR:&nbsp;&nbsp;&nbsp;&nbsp;</th>
		            <td><?=Seguimientos::getUsuario($model->derivado_por)?></td>
			    <th style="text-align:center; background-color: #B8C7CD; color: #222D32;"><b>OPCIONES DISPONIBLES</b></th>
			    <th style="text-align:center; background-color: #B8C7CD; color: #222D32;"><b>DERIVAR</b></th>
			         	
			</tr>
			<tr>
		            	<th style="text-align: right; background-color: #B8C7CD; color: #222D32;">DERIVADO A:&nbsp;&nbsp;&nbsp;&nbsp;</th>
		            	<td><?=Seguimientos::getUsuario($model->derivado_a)?></td>
                                <td rowspan="6" style="text-align:center;"><br><br>
                                   
                                    <?php 
                                        if(Seguimientos::countExistResponseNURI($model->id_seguimiento, 4)==0){
                                            echo" ".Html::a("<i style='font-size:15pt;' class='fa fa-file-pdf-o'></i> Añadir <b>CARTA</b>", ['anadirdocumentorespuesta', 'tipo_documento'=>4, 'id_seguimiento'=>$model->id_seguimiento, 'nuri'=>$model->codigo, 'oficial'=>$model->oficial], ['class' => 'btn btn-warning', 'style'=>'width:80%;'])."<br><p></p>";
                                        }
                                        else{
                                            echo" ".Html::a("<i style='font-size:15pt;' class='fa fa-file-pdf-o'></i> Añadir <b>CARTA</b>", ['#'], [ 'class' => 'btn btn-warning disabled', 'style'=>'width:80%;', 'disabled'=>true,])."<br><p></p>";
                                        }  
                                    ?>
                                    
                                    
                                    <?php 
                                        if(Seguimientos::countExistResponseNURI($model->id_seguimiento, 2)==0){
                                            echo" ".Html::a("<i style='font-size:15pt;' class='fa fa-file-photo-o'></i> Añadir <b>NOTA INTERNA</b>", ['anadirdocumentorespuesta', 'tipo_documento'=>2, 'id_seguimiento'=>$model->id_seguimiento, 'nuri'=>$model->codigo, 'oficial'=>$model->oficial], ['class' => 'btn btn-success', 'style'=>'width:80%;'])."<br><p></p>";
                                        }
                                        else{
                                            echo" ".Html::a("<i style='font-size:15pt;' class='fa fa-file-photo-o'></i> Añadir <b>NOTA INTERNA</b>", ['#'], ['class' => 'btn btn-success disabled', 'style'=>'width:80%;', 'disabled'=>true,])."<br><p></p>";
                                        }  
                                    ?>
                                    
                                    
                                    <?php 
                                        if(Seguimientos::countExistResponseNURI($model->id_seguimiento, 1)==0){
                                            echo" ".Html::a("<i style='font-size:15pt;' class='fa fa-file-word-o'></i> Añadir <b>INFORME</b>", ['anadirdocumentorespuesta', 'tipo_documento'=>1, 'id_seguimiento'=>$model->id_seguimiento, 'nuri'=>$model->codigo, 'oficial'=>$model->oficial ], ['class' => 'btn btn-danger', 'style'=>'width:80%;'])."<br><p></p>";
                                        }
                                        else{
                                            echo" ".Html::a("<i style='font-size:15pt;' class='fa fa-file-word-o'></i> Añadir <b>INFORME</b>", ['#'], ['class' => 'btn btn-danger disabled', 'style'=>'width:80%;', 'disabled'=>true,])."<br><p></p>";
                                        }  
                                    ?>
                                    
                                    
			         		
                                    
			        </td>
                                <td rowspan="6" style="text-align:center;" valign="middle" ><br><br><br>
                                    <?=" ".Html::a("<i style='font-size:15pt;' class='glyphicon glyphicon-log-out'></i> <br>Derivar Pendiente", ['derivarpendiente', 'id' => $model->id_seguimiento], ['class' => 'btn btn-primary']);?>
			       	</td>
			</tr>
			<tr>   	
		            	<th style="text-align: right; background-color: #B8C7CD; color: #222D32;">DESPACHO:&nbsp;&nbsp;&nbsp;&nbsp;</th>
		            	<td><?=Yii::$app->formatter->asDate($model->fecha_derivacion, 'long')." - ".$model->hora_derivacion?></td>
		        </tr>
			<tr>	
		            	<th style="text-align: right; background-color: #B8C7CD; color: #222D32;">RECEPCI&Oacute;N:&nbsp;&nbsp;&nbsp;&nbsp;</th>
		            	<td><?=Yii::$app->formatter->asDate($model->fecha_recepcion, 'long')." - ".$model->hora_recepcion?></td>
		        </tr>
			<tr>	
		            	<th style="text-align: right; background-color: #B8C7CD; color: #222D32;">ACCI&Oacute;N:&nbsp;&nbsp;&nbsp;&nbsp;</th>
		            	<td><?=$model->fkAccion->accion?></td>
		        </tr>
			<tr>	
		            	<th style="text-align: right; background-color: #B8C7CD; color: #222D32;">ESTADO:&nbsp;&nbsp;&nbsp;&nbsp;</th>
		            	<td><?=$model->fkEstado->estado?></td>
		        </tr>
			<tr>	
		            	<th style="text-align: right; background-color: #B8C7CD; color: #222D32;">PROVE&Iacute;DO:&nbsp;&nbsp;&nbsp;&nbsp;</th>
		            	<td><?=$model->proveido?></td>
		            	
                	</tr>
                    </table>
		</div>	

              </div>
            </li>
            <!-- END timeline item -->
           
          </ul>
        </div>
 </div> <!-- END ROW -->
 <div class="row">
    <!-- right column -->
    <div class="col-md-12">
	<div class="card-body pad table-responsive">
          <center><i>Documentos CITEs asociados al NUR/NURI <b><u><?=$model->codigo?></u></b> por el usuario: <b>SISTEMA<?php //=Yii::app()->user->usuario;?></b> </i></center>
            <table class="table table-bordered table-striped">
                <tr style="font-size: 14px; background-color: #B8C7CD; color: #222D32;">
                    <th align="center">CITE</th>
                    <th align="center">Referencia</th>
                    <th align="center">Fecha</th>
                    <th></th>
                    <th></th>
		</tr>
                <?php $dataReader=Seguimientos::getAnadirRespuesta($model->id_seguimiento); ?>	
		<?php foreach ($dataReader as $row) { ?>	
		<tr  style="font-size: 13px;">
                    <td><?=$row['codigo']?></td>
                    <td><?=$row['referencia']?></td>
                    <td><?=Yii::$app->formatter->asDate($row['fecha'], 'long')?></td>
                    <td align="center">
                       	<?php  
			  /*echo CHtml::link('<i class="fa fa-pencil" style="font-size:17px;"></i> Editar',array('seguimientos/editarDocumentoRespuesta',
					                 'id_documento'=>$row['id_documento'], 'tipo_documento'=>$row['fk_tipo_documento'], 'id_seguimiento'=>$seguimientos->id_seguimiento),array('class'=>'btn btn-success btn-sm')); */
                            
                                    switch ($row['fk_tipo_documento']) {
                                            case 1:
                                                $direccion='documentos/updateinforme';
                                                break;
                                            case 2:
                                                $direccion='documentos/updatenotainterna';
                                                break;
                                            case 3:
                                                $direccion='documentos/updatememorandum';
                                                break;
                                            case 4:
                                                $direccion='documentos/updatecarta';
                                                break;
                                            case 5:
                                                $direccion='documentos/updatecircular';
                                                break;
                                            case 8:
                                                $direccion='documentos/updateinstructivo';
                                                break;
                                        }
                                        
                            echo " ".Html::a("<i style='font-size:12pt;' class='fa fa-pencil-square-o'></i> Modificar", [$direccion, 'id' => $row['id_documento']], ['class' => 'btn btn-primary']);
			?>
                    </td>
                    <td align="center">
		    	<?php  
			 /*echo CHtml::link('<i class="fa fa-times-circle" style="font-size:17px;"></i> Desasociar',array('seguimientos/eliminarDocumentoRespuesta',
							  	'id_hoja_ruta'=>$row['id_hoja_ruta']),array('class'=>'btn btn-danger btn-sm')); */
                         echo " ".Html::a("<i style='font-size:12pt;' class='glyphicon glyphicon-remove-circle'></i> Desasociar", ['eliminardocumentorespuesta', 'id_hoja_ruta' => $row['id_hoja_ruta']], ['class' => 'btn btn-danger']);
			?>
                    </td>
		</tr>
		<?php } ?>
            </table>
	</div><!-- /.card-body -->
    <div> <!-- / fin col-md-6 -->
          			
</div>	
 
</section>




