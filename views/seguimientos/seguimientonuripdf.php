<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Seguimientos;
use app\models\Documentos;
use app\models\Usuarios;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\bootstrap\Modal;

use antoha\tooltip\Tooltip;

use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\GarantiasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>


<head>
<!--
<link rel="stylesheet" href="<?php echo Yii::$app->request->baseUrl; ?>/css/jquery.treeview.css" />
<script src="<?php echo Yii::$app->request->baseUrl; ?>/js/jquery.cookie.js"></script>
<script src="<?php echo Yii::$app->request->baseUrl; ?>/js/jquery.treeview.js"></script>-->
<!--<script type="text/javascript" src="<?php //echo Yii::app()->request->baseUrl; ?>/js/demo.js"></script>-->


</head>


<!--
<a href="javascript:void(0);" onclick="login();return false;">Login</a>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<script>
   function login(){
      $.ajax({
          type:'POST',
          url:'index.php?r=site/login',
          success: function(data)
                   {
                       $('#myModal').html(data);
                       $('#myModal').modal();
                   }
      });
   }
</script>-->
<?php 

/*
        Modal::begin([
        'header' => '<h2>Hello world</h2>',
        'toggleButton' => ['label' => 'click me'],
    ]);

        echo 'Say hello...';

    Modal::end(); */
?>


<?php
/* @var $this SeguimientosController */
/* @var $model Seguimientos */

$array_meses=array('ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');
$nuri=strtoupper($nuri);
?>
             <!-- /.card-body -->
                  <!-- text input -->
                  <!--<i  class="fa fa-paw"></i>
                  <i  class="fa fa-envelope"></i>
                  <i  class="fa fa-user"></i>
                  <i  class="fa fa-comments"></i>
                  <i  class="fa fa-commenting"></i>
                  <i  class="fa fa-pencil"></i>
                  <i  class="fa fa-file-text-o"></i>-->


<?php //echo "-----> ".$nuri ?>

<!--<a class="btn btn-app btn-sm" href="index.php?r=seguimientos/printBusquedaIndex&nuri=<?=$nuri?>" style="color: black;">
    <i class="fa fa-print"></i>Imprimir Seguimiento
</a>-->

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title" style="font-size: 13px;">
                    <!--<i  style="font-size: 20px; color: black;" class="fa fa-search"></i>-->
                    
                  <center>
                    B&uacute;squeda de NURI/NUR: <b><?=$nuri?></b>.
                  </center>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
      <div class="row">
        
       <?php 
       // codigo para verificar si el nuri esta registrado 
       // en la base de datos Postgres nueva
       // en caso de existir nos muestra el valor de la nueva base de datos
       if (Seguimientos::countNuriHojasRuta($nuri)>0) {

          $row=Seguimientos::getCabeceraSeguimiento($nuri);
          $tipo_documento=$row['tipo_doc'];
          $fecha_creacion=$row['fecha_creacion'];
          $hora_creacion=$row['hora_creacion'];
          $cite=$row['cite'];
          $adjunto=$row['adjunto'];
          $referencia=$row['referencia'];
          $destinatario=$row['destinatario'];
          $id_doc=$row['id_doc'];
          $remitente_institucion=$row['rem_institucion'];
          $remitente=$row['remitente'];
          $bandera_remitente=0;

          $carpeta_pago=$row['carpeta_pago'];
          $taller_suic=$row['taller_suic'];
          $orden_pago_suic=$row['orden_pago_suic'];
          

       }
       else{

        /*
          $row=Seguimientos::getCabeceraSeguimientoMYSQL($nuri);
          $tipo_documento=$row['tipo_documento'];
          $fecha_creacion=$row['fecha'];
          $hora_creacion='';
          $cite=$row['cite'];
          $adjunto=$row['adjuntos'];
          $referencia=$row['referencia'];
          $destinatario=$row['destinatario'];
          $remitente_institucion=$row['remitente_institucion'];
          $remitente=$row['remitente'].' - '.$row['remitente_cargo'];
          $id_doc=$cite;
          $bandera_remitente=0;

          if ($tipo_documento=='CARTA EXTERNA') {
            $remitente=1;
          }

          */

          //$row=Seguimientos::getCabeceraSeguimientoMYSQL($nuri);
          $tipo_documento="";
          $fecha_creacion="";
          $hora_creacion='';
          $cite="";
          $adjunto="";
          $referencia="";
          $destinatario="";
          $remitente_institucion="";
          $remitente="";
          $id_doc="";
          $bandera_remitente=0;
          
          $carpeta_pago=100;
          $taller_suic=0;
          $orden_pago_suic=0;

          if ($tipo_documento=='CARTA EXTERNA') {
            $remitente=1;
          } 

       }



       ?> 

        <div class="col-md-9"><!-- inicio -->
         <div class="card-body">       
                  <div class="card-body pad table-responsive">
                    <?php //$row=Seguimientos::getCabeceraSeguimiento($nuri); 
                      //$id_doc=$row['id_doc'];
                    ?>
                   <table border="1px" style="font-size: 10px;" cellpadding="4px" width="100%" >
                  <tr>
                    <td style="background-color:#A4A4A4; color:black;"><i  class="fa fa-files-o"></i> Tipo Documento</td>
                    <td style="background-color:#F2F2F2;"><?=$tipo_documento?></td>
                    <td style="background-color:#A4A4A4; color:black;"><i  class="fa fa-calendar"></i> Fecha/Hora Creaci&oacute;n</td>
                    <td style="background-color:#F2F2F2;" ><?=Yii::$app->formatter->asDate($fecha_creacion, 'medium')." - ".$hora_creacion?></td>  
                    <td rowspan="5" valign="top">
                      
                            <?php if (Seguimientos::countNuriPrincipal($nuri)>0) { 

                               $principal=' PRINCIPAL';
                             } 
                             else{ 

                              /*if (Seguimientos::getListaNurisAgrupadossSIACOCount($nuri)) {
                                $principal=' PRINCIPAL';
                              }
                              else{*/

                              $principal=''; 
                              //}

                            }
                             ?>
             <center>
              <h5 style="color:#0174DF; font-weight: bold;"><b><u>NUR/NURI <?=$principal?></u></b></h5><br>
             </center>
              <b style="font-size:14px; color:#0B3861;"><?=$nuri?></b>
              <div style="width: 100%; text-align: right;">
              <?php 
                  /*   if (Seguimientos::getListaNurisAgrupadossSIACOCount($nuri)) {
                          $dataReader2=Seguimientos::getListaNurisAgrupadossSIACO($nuri); 
                           ?> 
                           <?php foreach ($dataReader2 as $row3) {  
                              echo "<span style='text-align:right'>".$row3['nur_s']."<span><br>";
                              }
                            } */
                           ?>
                    <?php if (Seguimientos::countNuriPrincipal($nuri)>0) { 
                        $dataReader=Seguimientos::listaAgrupacion($nuri); 
                        foreach ($dataReader as $row2) {
                          echo "<span style='text-align:right'>".$row2['nur_hijo']."<span><br>";
                          } // fin foreach
                } ?>
                </div>
                    </td> 
                  </tr>
                  <tr>
                    <td style="background-color:#A4A4A4; color:black;"><i  class="fa fa-pencil"></i> CITE</td>
                    <td style="background-color:#F2F2F2;">
                       <?php 
                       // codigo para mostrar los documentos asociados
                       // en el nuevo sistema
                       if (Seguimientos::countNuriHojasRuta($nuri)>0) {

                        $dataReader=Seguimientos::getNurisAsociados($nuri);
                        $l=0;
                        foreach($dataReader as $row2) {  
                          echo $row2['cite'];                        ?>
                        <br>
                      <?php  } // fin foreach

                       }
                       /*else{
                          //$row=Seguimientos::getCabeceraSeguimientoMYSQL($nuri);
                          $dataReader=Seguimientos::getNurisAsociadosMYSQL($nuri);
                          $i=0;
                          foreach($dataReader as $row2) {  

                            echo $row2['codigo']."<br>";
                            ?>
                        <?php  } // fin foreach
                        } */
                       ?> 
                    </td> 
                    <td style="background-color:#A4A4A4; color:black;"><i  class="fa fa-chain"></i> Adjuntos</td>
                    <td style="background-color:#F2F2F2;"><?=$adjunto?></td>
                  </tr>
                  <tr>
                    <td style="background-color:#A4A4A4; color:black;"><i  class="fa fa-commenting-o"></i> Referencia</td>
                    <td colspan="3" style="background-color:#F2F2F2;"><?=$referencia?></td>  
                  </tr>
                  <tr>
                    <td style="background-color:#A4A4A4; color:black;"><i  class="fa fa-user"></i> Remitente</td>
                    <td colspan="3" style="background-color:#F2F2F2;"><?=$remitente?></td>  
                  </tr>
                  <tr>
                    <td style="background-color:#A4A4A4; color:black;"><i  class="fa fa-user-o"></i> Destinatario</td>
                    <td colspan="3" style="background-color:#F2F2F2;"><?=$destinatario?></td>  
                  </tr>

                  <?php 
                    if ($carpeta_pago==1) {

                      $row_suic=Documentos::listUpdateTalleresSUIC($taller_suic);
                      $row_orden_suic=Documentos::listUpdateOrdenPagoSUIC($orden_pago_suic);    
                  ?>

                  <tr>
                    <td style="background-color:#A4A4A4; color:black;"><i  class="fa fa-industry"></i> Taller</td>
                    <td style="background-color:#F2F2F2;"><?=$row_suic['Taller']?></td>  
                    <td style="background-color:#A4A4A4; color:black;"><i  class="fa fa-folder"></i> N° Carpeta</td>
                    <td style="background-color:#F2F2F2;"><?=$row_orden_suic['CarpetaPago']?></td>  
                  </tr>
                  <tr>
                    <td style="background-color:#A4A4A4; color:black;"><i  class="fa fa-bars"></i> Tipo</td>
                    <td colspan="3" style="background-color:#F2F2F2;"><?=$row_orden_suic['TipoOrden']?></td>  
                  </tr>

                  <?php 
                    }
                  ?>


                  <?php 
                    if ($tipo_documento=='CARTA EXTERNA') {
                  ?>
                  <tr>
                    <td style="background-color:#A4A4A4; color:black;"><i  class="fa fa-user-o"></i> Instituci&oacute;n Remitente</td>
                    <td colspan="3" style="background-color:#F2F2F2;"><?=$remitente_institucion?></td>  
                  </tr>
                  <?php } ?>

                  <?php 

                    //CODIGO PARA VER EL DOCUMENTO ESCANEADO DEL SAC
                    if (count(Seguimientos::listaCartaExterna($nuri))>0){ ?>
                    
                    <tr>
                      <td style="background-color:#A4A4A4; color:black;"><i  class="fa fa-file-text-o "></i> Documento Escaneado</td>
                      <td colspan="3" style="background-color:#F2F2F2;">
                        <?php 
                        $dataReader=Seguimientos::listaCartaExterna($nuri); 
                        foreach ($dataReader as $row2) {
                          echo "<b>".$row2['codigo']."</b>";
                          echo "<br>";
                        }
                        ?>
                      </td>  
                    </tr>
                      
                  <?php  }//if (count(Seguimientos::listaCartaExterna($nuri))>0){ 
                    else{ 

                        //CODIGO PARA VER EL DOCUMENTO ESCANEADO DEL SIACO
                        if($tipo_documento=='CARTA EXTERNA') {
                          // codigo para separar la fecha del cite asociado al nuri y visualizar
                          $fecha_aso=explode(' ', $fecha_creacion);
                          $fecha=explode('-',$fecha_aso[0]);
                          $anio=$fecha[0];
                          $mes=$fecha[1]+0;
                          //$numero=($mes-1);
                          $nombre_mes=$array_meses[$mes-1];
                          $dia=$fecha[2];
                          for ($i=0; $i <count($array_meses) ; $i++) { 
                            //echo "<br>".$array_meses[$i];
                          }

                          $nuevo_cite = str_replace("/", "_", $cite); 
                    ?>
                         <tr>
                            <td style="background-color:#A4A4A4; color:black;"><i  class="fa fa-file-text-o "></i> Documento Escaneado</td>
                            <td colspan="3" style="background-color:#F2F2F2;">
                              <b><?=$cite?></b>
                            </td>  
                          </tr>
                    <?php 
                        }//if($tipo_documento=='CARTA EXTERNA') {
                  } //else{
                  ?>
                  <!--############## CODIGO PARA MSTRAR SI EL NURI PERTENECE A UN AGRUPADO DEL SIACO-->

                  <?php 

                  /*
                  if (Seguimientos::getListaNurisAgrupadosSegundarioSIACOCount($nuri)>0) { 
                        $nuri_principal_mysql=Seguimientos::getNuriPrincipalMysql($nuri); 
                  ?>
                  <tr>
                    <td style="background-color:#0B4C5F; color:white;"><i  class="fa fa-group"></i> Agrupaci&oacute;n</td>
                    <td colspan="3" style="color:darkred;"  style="background-color:#D8D8D8;">Una copia de este documento pertenece al NUR/NURI Principal 
                           <b><?=$nuri_principal_mysql?></b>
                      </td>  
                    </tr>

                    <?php 
                    }

                    */
                  ?>


                  <!--############## CODIGO PARA MSTRAR SI EL NURI PERTENECE A UN AGRUPADO DEL SAC-->
                  <?php if (Seguimientos::countNuriSecundarioAgrupacion($nuri)>0) { 
                        $nuri_principal=Seguimientos::getNuriPrincipal($nuri); 
                  ?>
                  <tr>
                    <td style="background-color:#0B4C5F; color:white;"><i  class="fa fa-group"></i> Agrupaci&oacute;n</td>
                    <td colspan="3" style="color:darkred;"  style="background-color:#D8D8D8;">Una copia de este documento pertenece al NUR/NURI Principal 
                      <?=$nuri_principal?>
                      </td>  
                    </tr>

                    <?php 
                    }
                  ?>
                
               </table>
           </div>
                      
         </div>
           <!-- /.card -->
        </div><!-- fin -->
 <!-- /.col -->
      </div>   

      <!-- row -->
<div class="row">
        <div class="col-md-12">

          
        <br>    
        <span class="bg-red" style="font-size:9pt; ">
          <b style="color:black;"><?=$nuri?> <u>OFICIAL</u></b>
        </span>
              <i class="fa fa-commenting " style="background-color: #0080FF; color: white;"></i>

              <div class="timeline-item">


                <div class="card-body pad table-responsive">
                  <table  id="table_seguimiento" style="font-size:11px; " cellpadding="3" cellspacing="0" width="100%">
                    <tr>
                        <th style="background-color:#A4A4A4; color:black;">DERIVADO POR:</th>
                        <th style="background-color:#A4A4A4; color:black;">DERIVADO A:</th>
                        <th style="background-color:#A4A4A4; color:black;">DESPACHO</th>
                        <th style="background-color:#A4A4A4; color:black;">RECEPCI&Oacute;N</th>
                        <th style="background-color:#A4A4A4; color:black;">ACCI&Oacute;N</th>
                        <th style="background-color:#A4A4A4; color:black;">ESTADO</th>
                        <th style="background-color:#A4A4A4; color:black;">ADJUNTOS</th>
                </tr>
                  <!-- 
                  //#########################################################  
                  //codigo para mostrar el historico del nuri
                  // codigo para mostrar informaicon de la base de datios mysql
                  // siaco -->
                  <?php

                  /*
                  $dataReader=Seguimientos::getSeguimientoMYSQL($nuri,2);
                  $i=0;
                  foreach($dataReader as $row) {
                    $i++;
                ?>
              <tr>
                <td rowspan="2">
                  <i  class="fa fa-paw" style="font-size: 21px;"></i>
                  <?=$row['nombre_origen']?>
                </td> 
                  <td rowspan="2">
                    <i  class="fa fa-paw" style="font-size: 21px;"></i>
                    <?=$row['nombre_destinatario']?>
                  </td>
                  <td><?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($row['fecha_derivacion']))?></td>
                  <td><?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($row['fecha_recepcion']))?></td>
                  <td><?=$row['accion_seguimiento']?></td>
                  <td> 
                    <?php
                      
                      if ($row['estado']==100) {
                        echo $row['estado_seguimiento'];
                        echo "<br>";
                      }
                      else{
                        echo $row['estado_seguimiento'];
                      }

                    ?>
                  </td>



                  <td align="center">
                    <?php
                    
                    $adjuntos=$row['adjuntos'];
                    if ($adjuntos!='') {

                    $row_adjunto=explode(',', $adjuntos);

                    $l=0;

                    for ($l=0; $l <count($row_adjunto) ; $l++) { 
                      echo "<b>".$row_adjunto[$l]."</b><br>"; 
                    }//for ($i=0; $i <count($row_adjunto) ; $i++) { 

                    
                    
                    }//if ($adjuntos!='') {

                    ?>


                  </td>
              </tr>
              <tr>
               <td colspan="5" style="background-color:#E0ECF8; "><b><u>PROVE&Iacute;DO:</u> </b><?=$row['proveido']?></td>
              </tr>
              <!-- -->
              <?php 
          
                  } //foreach($dataReader as $row) {

                    */
                ?>
                <!-- aqui finaliza el codigo extraido de la base MYSQL -->
                <!-- ############################################################### -->
                
                <?php
                        $dataReader=Seguimientos::getSearchNuri($nuri,1);
                  $i=0;
                        foreach($dataReader as $row) {

                        //$total_contrato=$total_contrato+$row['total_contrato'];
                        if (($row['fk_estado']==1) || $row['fk_estado']==3 ) 
                  { $icono='<i class="fa fa-hand-peace-o" style="font-size:24px; color:#610B0B;"></i>'; 
                    $color='font-weight: bold;';
                    if ($row['confirmado']==1) {  $confirmado=' ';  }
                    else{ $confirmado='<i style="color:red; font-size:11px;">Sin confirmar</i>'; } //
                  }
                        else 
                  { 
                    $icono='<i class="fa fa-paw"  style="font-size: 21px;"></i>'; 
                    $color='';
                    $confirmado='';
                  } 
                    ?>
                    <tr>
                        <td rowspan="2">
                            <i  class="fa fa-paw" style="font-size: 21px;"></i>
                            <?=$row['usuario_origen']?>
                        </td>   
                        <td rowspan="2">
                            <?=$icono?><!-- codigo para mostrar el icono  -->
                            <?=$row['usuario_destino']?>
                        </td>
                        <td><?=Yii::$app->formatter->asDate($row['f_derivacion'], 'medium')." - ".$row['h_derivacion']?></td>
                        <td><?=Yii::$app->formatter->asDate($row['f_recepcion'], 'medium')." - ".$row['h_recepcion']?></td>
                        <td><?=$row['accion']?></td>
                        <td style="<?=$color?>">
                            <?php
                              
                              if ($row['fk_estado']==5) {
                                echo $row['estado']."<br>";
                              }
                              else{
                                echo $row['estado']."<br>";
                                echo $confirmado;
                              }

                            ?>
                  </td>
                        <td align="center">
                    <?php 
                    
                    
                    if (Seguimientos::countSeguimientoHojaRuta($row['id_seguimiento'])>0) { 

                        $dataReader=Seguimientos::getCiteHojaRuta($row['id_seguimiento']);
                        foreach($dataReader as $row2) {  

                          echo "<b>".$row2['codigo']."</b><br>";

                        } // fin foreach
                    } // fin if
                    else{
                       echo ""; 
                    }
                    ?>   
                  </td>
                    </tr>
                    <tr>
                     <td colspan="5" style="background-color:#E0ECF8; "><b><u>PROVE&Iacute;DO:</u> </b><?=$row['proveido']?></td>
                    </tr>
                    <!-- <tr>
                        <td colspan="7" bgcolor="#BDBDBD"></td>
                    </tr>-->
                    <?php 
            
                            } //foreach($dataReader as $row) {
                        ?>
                  </table>
                 </div> 

              </div>
            
        </div>
       
        <br>
        <!-- /.col -->
        <div class="col-md-12">
          <!-- The time line -->
                  <span class="bg-red" style="font-size:9pt;">
                    <b style="color:black;"><?=$nuri?> <u>COPIAS DIGITALES</u></b>
                  </span>
            <!-- /.timeline-label -->
           
            <!-- timeline item -->

              <i class="fa fa-commenting " style="background-color: #0080FF; color: white;"></i>

              <div class="timeline-item">
                <div class="card card-default "><!--collapsed-card-->
                      <div class="card-header">
                       </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                               <table  id="table_seguimiento" style="font-size:11px; " cellpadding="3" cellspacing="0" width="100%">
                                  <tr>
              <th style="background-color:#A4A4A4; color:black;">DERIVADO POR:</th>
                          <th style="background-color:#A4A4A4; color:black;">DERIVADO A:</th>
                          <th style="background-color:#A4A4A4; color:black;">DESPACHO</th>
                          <th style="background-color:#A4A4A4; color:black;">RECEPCI&Oacute;N</th>
                          <th style="background-color:#A4A4A4; color:black;">ACCI&Oacute;N</th>
                          <th style="background-color:#A4A4A4; color:black;">ESTADO</th>
                          <th style="background-color:#A4A4A4; color:black;">ADJUNTOS</th>
                                    </tr>

                  <!-- 
                  //#########################################################  
                  //codigo para mostrar el historico del nuri
                  // codigo para mostrar informaicon de la base de datios mysql
                  // siaco -->
                  <?php 
                        /*
                        $dataReader=Seguimientos::getSeguimientoMYSQL($nuri,0);
                        $j=0;
                        foreach($dataReader as $row) {
                          $j++;
                          //$total_contrato=$total_contrato+$row['total_contrato'];
                      ?>  
                         <tr>
                          <td rowspan="2">
                            
                            <?=$row['nombre_origen']?>
                          </td> 
                            <td rowspan="2">
                              
                              <?=$row['nombre_destinatario']?>
                            </td>
                            <td><?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($row['fecha_derivacion']))?></td>
                            <td><?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($row['fecha_recepcion']))?></td>
                            <td><?=$row['accion_seguimiento']?></td>
                            <td> 
                            <?php
                              
                              if ($row['estado']==51) {
                                echo $row['estado_seguimiento']."<br>";
                              }
                              else{
                                echo $row['estado_seguimiento'];
                              }

                            ?>
                          </td>
                            <td align="center">
                              <?php
                              
                              $adjuntos=$row['adjuntos'];

                              echo $row['adjuntos']."<br>";

                              ?>


                            </td>
                        </tr>
                        <tr>
                          <td colspan="5"><b><u>PROVE&Iacute;DO:</u> </b><?=$row['proveido']?></td>

                        </tr>
                      <?php 
                  
                          } //foreach($dataReader as $row) {

                            */
                        ?>

                  <!-- aqui finaliza el codigo extraido de la base MYSQL -->
                  <!-- ###################################################### -->
                                  <?php 
                        $i=0;
                                      $dataReader=Seguimientos::getSearchNuri($nuri,0);
                                      foreach($dataReader as $row) {
                          $i++;
                                        //$total_contrato=$total_contrato+$row['total_contrato'];
                                    ?>  
                                   <tr>
                                    <td rowspan="2">
                           <div class="numero_copia">
                              <?php
                                  if ($row['copia_padre']=='0') { $numero=''; }
                                  else { $numero=$row['copia_padre']; }
                                  echo $numero;
                               ?>
                            </div>
                                        <?=$row['usuario_origen']?>
                                    </td>   
                                    <td rowspan="2">
                            <div class="numero_copia">
                              <?=$row['numero_copia']?>
                            </div>

                                        <?=$row['usuario_destino']?>
                                    </td>
                                    <td><?=Yii::$app->formatter->asDate($row['f_derivacion'], 'medium')." - ".$row['h_derivacion']?></td>
                                                                <td><?=Yii::$app->formatter->asDate($row['f_recepcion'], 'medium')." - ".$row['h_recepcion']?></td>
                                    <td><?=$row['accion']?></td>
                                    <td>
                            <?php
                              
                              if ($row['fk_estado']==6) {
                                echo $row['estado']."<br>";
                                $confirmado=' ';
                              }
                              else{
                                echo $row['estado'];
                                if ($row['confirmado']==1) {  $confirmado=' ';  }
                              else{ $confirmado='<br> <i style="color:red; font-size:11px;">Sin confirmar</i>'; } 

                              }

                              echo $confirmado;

                            ?>
                              
                        </td>
                                    <td>
                            <?php 
                    
                    
                          if (Seguimientos::countSeguimientoHojaRuta($row['id_seguimiento'])>0) { 

                              $dataReader=Seguimientos::getCiteHojaRuta($row['id_seguimiento']);
                              foreach($dataReader as $row2) {
                                echo $row2['codigo']."<br>";
                              } // fin foreach
                          } // fin if
                          else{
                             echo ""; 
                          }
                          ?>        
                        </td>
                                </tr>
                                <tr>
                                    <td colspan="5"><b><u>PROVE&Iacute;DO:</u> </b><?=$row['proveido']?></td>
                                </tr>
                                    <?php 
                            
                                            } //foreach($dataReader as $row) {
                                        ?>
                              </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                </div>
      </div>
    </div>
     <!-- /.col -->
  </div>
      <!-- /.row -->



                  
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
</section>


<script src="<?=Yii::$app->request->baseUrl; ?>/js/jquery.js"></script>

