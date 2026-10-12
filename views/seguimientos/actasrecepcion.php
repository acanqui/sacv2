<?php

use yii\helpers\Html;
use app\models\Seguimientos;

//use kartik\sortable\Sortable;
use kartik\sortinput\SortableInput;
/* @var $this yii\web\View */
/* @var $model app\models\Seguimientos */

//$this->title = 'Create Seguimientos';
$this->params['breadcrumbs'][] = ['label' => 'Seguimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actas de recepción';
?>
<script src="<?=Yii::$app->request->baseUrl; ?>/js/jquery.js"></script>
<script language="javascript">
  function byebye ()
  {
    // need a confirmation before submiting
    //if (confirm('Esta seguro de recepcionar los NUR/NURI(s) seleccionados ?'))			
      $("#myForm").submit ();
  }

  $(document).ready(function(){
    // powerful jquery ! Clicking on the checkbox 'checkAll' change the state of all checkbox  
    $('.checkAll').click(function () {
      
      $("input[type='checkbox']:not([disabled='disabled'])").attr('checked', this.checked);
      
    });
  });
</script>
 
<span style="font-size: 16pt;">
<i class="glyphicon glyphicon-inbox" style="font-size:30pt; " ></i>&nbsp;
NUR/NURI(s) derivados por el usuario <b>'<?=Yii::$app->user->identity->usuario?>'</b> sin recibir</span><br><br>        


<!--

<?=Html::beginForm("index.php?r=Seguimientos/reporteDocumentosDerivadosPDF", "post", array("id"=>"myForm", "target"=>"_blank")); ?>

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
                    
              </div>
              <div class="card-body">

              	<div class="row">
          			
          			<div class="col-md-12">

          				<div class="table-container">
					    <article id="contenido">
						<div class="table-container">
							<div class="card-body pad table-responsive">

								<center>
								  <i style="color: #0B4C5F;">Usted puede generar el reporte de documentaci&oacute;n despachada seleccionando los NUR/NURI(s) deseados</i>

								 
								  <br>
								   <?php //echo Html::activeCheckBox('seguimiento', "id_seguimiento", array ("class" => "checkAll", 'style'=>'font-size:50px;')); ?>
                                                                   <?= Html::checkbox('agree', false, ["class" => "checkAll", 'style'=>'font-size:50px;']) ?>    
								   Seleccionar todo <br>
								<button
							  	  type="button"				
								  onClick="byebye()" class="btn btn-info" style="color:white;"
								><i class="fa fa-file-text"></i>
								  Generar Reporte Despachados
								  </button>
								<br><br>		  


						<table class="table table-bordered table-striped">
					        <tr style="background-color:#0489B1; color:white;">
					            <th align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					            <th align="center">NUR/NURI</th>
					            <th align="left">Fecha/Hora Derivaci&oacute;n</th>
					            <th align="left">Derivado a</th>
					            <th align="left">Prove&iacute;do</th>
					            <th align="left">Estado</th>
                                                </tr>

								<?php $dataReader=Seguimientos::getDerivadosNoRecibidos(Yii::$app->user->identity->id_usuario); ?>	

								<?php foreach ($dataReader as $row) { 
									$id_seguimiento=$row['id_seguimiento']	;
									?>	
								  <tr  style="font-size:13px; border: .3px solid #1C1C1C;">

								  	<td style="text-align:center; background-color:#0489B1;">
						           		<?php //echo CHtml::activeCheckBox($model, "id_seguimiento[]", array('value'=>$id_seguimiento, 'uncheckValue' => NULL)); ?>
                                                                        <?= Html::checkbox('agree', false, ['label' => '']) ?>    
						           	</td>

								    <td align="center">
												            	
									 	<?php if($row['tipo_documento']=='ORIGINAL'){ ?>
										   	<i  class="fa fa-hand-peace-o" style="font-size: 20px; color: darkblue;"></i><br>
									   	<?php } ?>
										<b><?=$row['tipo_documento']?></b><br>
										<?=$row['nuri']?>
									</td>
								    <td align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>
								    <td align="left"><?=$row['usuario_destino']?></td>
								    <td><?=$row['proveido']?></td>
								    <td align="center"><?=$row['estado']?></td>
								 </tr>
								<?php } ?>         	 
		                </table> 
						</center>		

						    </div>
						</div>
					   </article>
					   
					</div>

          			</div>
          		</div>
              <hr style="background-color:#A4A4A4;">
              </div>
            </div>
          </div>
        </div>
      </div>
	</section>
<?=Html::endForm(); ?>
-->

<?php 
/*
// Two connected Sortable lists with custom styles.
echo Sortable::widget([
    'connected'=>true,
    'items'=>[
        ['content'=>'From Item 1'],
        ['content'=>'From Item 2'],
        ['content'=>'From Item 3'],
        ['content'=>'From Item 4'],
    ]
]);
echo Sortable::widget([
    'connected'=>true,
    'itemOptions'=>['class'=>'alert alert-warning'],
    'items'=>[
        ['content'=>'To Item 1'],
        ['content'=>'To Item 2'],
        ['content'=>'To Item 3'],
        ['content'=>'To Item 4'],
    ]
]);
echo '<div class="clearfix"></div>';
*/
?>





<?php 
    $dataReader=Seguimientos::getDerivadosNoRecibidos(Yii::$app->user->identity->id_usuario); 
    $items=[];
    $i=0;

    foreach ($dataReader as $row) {
        $i++;
       
        $items[$row['id_seguimiento']] = [
                                       'content' => "<table  width='100%' >
                                        <tr>
                                            <td style='text-align:left; border-right:solid 1px white;'> ".$i."&nbsp;</td>
                                            <td width='20%' style='text-align:center; border-right:solid 1px white;'><b>".$row['tipo_documento']."<br>".$row['nuri']."</b></td> 
                                            <td width='40%'style='border-right:solid 1px white;'> &nbsp;".$row['usuario_destino']."</td>
                                            <td width='40%'> &nbsp;".$row['proveido']."</td>
                                        </tr>        
                                        </table>",  
                                        //'options' => ['data' => ['id'=>$lmenu->id]],
                                 ];
    }


//print_r($items);    
    
// Scenario # 5:Connected sortables where one can modify connected sortable inputs.
echo '<div class="row">';
    echo '<div class="col-sm-6">';
    
            echo "<center>".Html::a("<i style='font-size:12pt;' class='fa fa-file-pdf-o'></i> Imprimir Todo PDF", ['reportederivadoscompleto'], ['class' => 'btn btn-primary', 'target'=>'_blank'])."</center><br>";
        
        echo SortableInput::widget([
        'name'=>'kv-conn-1',
        'items' => $items,
        /*'items' => [
                1 => ['content' => 'Item # 1'],
                2 => ['content' => 'Item # 2'],
                3 => ['content' => 'Item # 3'],
                4 => ['content' => 'Item # 4'],
                5 => ['content' => 'Item # 5'],
            
        ],*/
        'hideInput' => false,
        'sortableOptions' => [
            'itemOptions'=>['class'=>'alert alert-dangers', 'style'=>'background:#E1E1E1; color:black; font-size:8.5pt;'],
            'connected'=>true,
        ],
            'options' => ['class'=>'form-control', 'readonly'=>true]
        ]);
    echo '</div>';

    echo '<div class="col-sm-6">';
        //echo "<center><b>Arratrar aqu&iacute; los NUR/NURIs</b></center><br>";
        
        echo '<center><input type="button" name="boton01" id="boton01" value="Imprimir Selección PDF" class="btn btn-danger" target="_blank" ></center>'; 

        echo '<br><center><label><input type="checkbox" id="checkdoc" class="checkdoc"> En caso de imprimir nuevas filas marque esta opci&oacute;n</center></label>';    
        
        echo SortableInput::widget([
        'name'=>'kv-conn-2',
        'items' => [
                1 => ['content' => 'Posición #1'],
                2 => ['content' => 'Posición #2'],
                3 => ['content' => 'Posición #3'],
                4 => ['content' => 'Posición #4'],
                5 => ['content' => 'Posición #5'],
                6 => ['content' => 'Posición #6'],
                7 => ['content' => 'Posición #7'],
                8 => ['content' => 'Posición #8'],
                9 => ['content' => 'Posición #9'],
                /*20 => ['content' => 'Item # 20'],
                30 => ['content' => 'Item # 30'],
                40 => ['content' => 'Item # 40'],
                50 => ['content' => 'Item # 50'],*/
        ],
        'hideInput' => false,
        'sortableOptions' => [
            'itemOptions'=>['class'=>'alert alert-warnings', 'style'=>'background:#566267; color:white;'],
            'connected'=>true,
        ],
        'options' => ['class'=>'form-control', 'readonly'=>true]
        ]);
    
    echo '</div>';
echo '</div>';

?>




<script type="text/javascript">

$(document).ready(function(){

    

	$("#boton01").click(function () {
	
            var valor=$("#w1").val();
            var checkbox;
            
            if($('.checkdoc').is(':checked')){
                checkbox='SI'; 
            }
            else{ 
                checkbox='NO';
            }
            
            
           // alert($("#w1").val());

            //$(location).attr('href',"index.php?r=seguimientos/reportedocumentosderivados&valor="+valor+"&checkbox="+checkbox).addClass('has-target-blank');


            $(location).attr({
                            "href" : "index.php?r=seguimientos/reportedocumentosderivados&valor="+valor+"&checkbox="+checkbox,
                            "target" : "_blank",
                            
                          });

            

	
	});
});

</script>

