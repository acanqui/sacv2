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

<?php //echo CHtml::beginForm("index.php?r=Seguimientos/reporteDocumentosDerivadosPDF", "post", array("id"=>"myForm", "target"=>"_blank")); ?>
<?=Html::beginForm(['seguimientos/actarecepciongeneralpdf'], 'POST', ['class' => 'sidebar-forms', "id"=>"myForm"]); ?>
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h4 class="card-title">NUR/NURI(s) derivados por el usuario <b>'<?=Yii::$app->user->identity->nombre?> (<?=Yii::$app->user->identity->usuario?>)'</b> sin recibir</h4>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <div class="row">
                    
                    <div class="col-md-12">

                        <div class="table-container">
                        <article id="contenido">
                        <div class="table-container">
                            <div class="card-body pad table-responsive">

                                <center>
                                  <i style="color: #0B4C5F;">Usted puede generar el reporte de documentaci&oacute;n derivada seleccionando los NUR/NURI(s) deseados</i>

                                  <br>

                                   <?php echo Html::activeCheckbox($model, 'id_seguimiento', ['class' => 'checkAll', 'style'=>'font-size:50px;'])?>

                                   
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

                                <?php 
                                    $i=0;
                                    foreach ($dataReader as $row) { 
                                    $id_seguimiento=$row['id_seguimiento']  ;
                                    $i++;
                                    ?>  
                                  <tr  style="font-size:13px; border: .3px solid #1C1C1C;">

                                    <td style="text-align:center; background-color:#0489B1;">
                                        <?php //echo CHtml::activeCheckBox($model, "id_seguimiento[]", array('value'=>$id_seguimiento, 'uncheckValue' => NULL)); ?>

                                        <?=$i?>

                                        <?php echo Html::activeCheckbox($model, 'id_seguimiento[]', ['value'=>$id_seguimiento, 'uncheckValue' => NULL,'style'=>'font-size:50px; width:25px; height:25px;'])?>

                                        
                                    </td>

                                    <td align="center">
                                                                
                                        <?php if($row['tipo_documento']=='ORIGINAL'){ ?>
                                            <i  class="fa fa-hand-peace-o" style="font-size: 20px; color: darkblue;"></i><br>
                                        <?php } ?>
                                        <b><?=$row['tipo_documento']?></b><br>
                                        <?=$row['nuri']?>
                                    </td>
                                    <td align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>
                                    <td align="center"><?=$row['usuario_destino']?></td>
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

                    </div><!-- FIN col-md-6-->  
                </div>
              <!-- /.row -->
              <hr style="background-color:#A4A4A4;">
              <!-- .row -->
             

                    
                 
              </div>
              <!-- /.card-body -->
             
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

    <?=Html::endForm(); ?>

