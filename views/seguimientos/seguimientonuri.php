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


<style>
    /*###########################################################################*/
/*CODIGO PARA ESTILOS DE LA TABLA QUE SE MUESTRA EN EL VIEW SEGUIMIENTOS */

#table_cabecera_seguimiento {
    width: 100%;
}

#table_cabecera_seguimiento tr th {
    background-color: #086A87;
    color: #F2F2F2;
    /*font-size: 39px,*/
    padding: 5px;
    padding-left: 12px;

}

#table_cabecera_seguimiento tr td {
    padding: 5px;
}

/*###########################################################################*/
/* codigo para la tabla seguimiento*/
#table_seguimiento {
    /*background-color: #086A87;
    color: #F2F2F2;*/
    font-size: 14px;
    width: 100%;
}
#table_seguimiento tr th {
    background-color: #086A87;
    color: #F2F2F2;
    padding: 4px;
    padding-left: 12px;
    
}

#table_seguimiento tr td {
    padding: 3px;
    padding-left: 5px;
    border: 1px solid rgba(55,72,79, 0.5);
}

/* codigo para los mensajes personales*/
.div_info{

    border: 0 solid red;
    padding: 17px;
    border-radius: 10px; 
    box-shadow: 2px 2px 2px 2px;
    background-color: #81BEF7;
    /*opacity:0.4;*/
    color: #0B2F3A;

}

/*codigo  para cambiar el color de personal no asignado a grupos*/
.grupoColumn{

    color: red;
    font-weight: bold;
}

/* codigo para cambiar el estilo de las vista de los documentos*/
#viewCabecera{

    font-size: 15px;
}

#viewContenido{
    font-size: 15px;
}

/*####################################################################*/
/*################################################*/
/*estilo para  numero de copia de seguimiento*/
.numero_copiasss{

 text-align:right;  
 position:relative;  
 margin-top: -17px; 
 font-size: 11px; 
 font-weight: bold; 
 border: 0px solid green;

}

.numero_copia{

margin-top:-1px; 
 text-align:right;  
 position:relative;  
  font-size: 9px; 
 font-weight: bold; 
 border: 0px solid green;

}

/*################################################*/
/*estilo para mostrar nuri*/

.nuri{

  background:#E8EAEC; 
  padding:8px; 
  border-radius: 5px;

}
</style>

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

<?php 

/*
$key=2075;
echo Html::a('ACTUALIZAR', $key, [
                'data-toggle' => 'modal',
                'data-target' => '#update-modal',
                'class' => 'data-update',
                'data-id' => $key,
            ]);*/
?>

                  
                  
<?php 
//##############################################################################################
//CODIGO PARA MOSTRAR LA VISTA DE LOS DOCUMENTOS
//use yii\bootstrap\Modal;
//Update operation
Modal::begin([
    'id' => 'update-modal',
    'header' => '<h4 class="modal-title">Documento</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Cerrar</a>',
    'size' => 'modal-lg',
]); 

//$requestUpdateUrl=Url::toRoute('actualizar');
$requestUpdateUrl=Url::toRoute('verdocumentoseguimiento');
$updateJs=<<<JS
    $('.data-update').on('click', function () {
        /*$.get ('{$requestUpdateUrl}', {id:$(this).closest('tr').data('key')},*/
        $.get ('{$requestUpdateUrl}', {id:$(this).attr('href')},
            function(data) {
                $('.modal-body').html (data);
            }  
        );
    });
JS;
$this->registerJs($updateJs);
Modal::end();

//##############################################################################################
//CODIGO PARA MOSTRAR LA VISTA DE LOS TRAMITES ARCHIVADOS
//use yii\bootstrap\Modal;
//Update operation
Modal::begin([
    'id' => 'archivo-modal',
    'header' => '<h4 class="modal-title">Información archivo</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Cerrar</a>',
    'size' => 'modal-lg',
]); 

//$requestUpdateUrl=Url::toRoute('actualizar');
$requestUpdateUrl2=Url::toRoute('viewdetallearchivo');
$updateJs2=<<<JS
    $('.data-archivo').on('click', function () {
        /*$.get ('{$requestUpdateUrl2}', {id:$(this).closest('tr').data('key')},*/
        $.get ('{$requestUpdateUrl2}', {id:$(this).attr('href')},
            function(data) {
                $('.modal-body').html (data);
            }  
        );
    });
JS;
$this->registerJs($updateJs2);
Modal::end();
//##############################################################################################
?>                                    
                  

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                  <h4 class="card-title" style="font-size: 19pt;">
                	<!--<i  style="font-size: 20px; color: black;" class="fa fa-search"></i>-->
                	<i  class="fa fa-search"></i>
                	B&uacute;squeda de NURI/NUR: <b><?=$nuri?></b>.
                        
                        
                            <center>
                                <a class="btn btn-app btn-sm" href="index.php?r=seguimientos/seguimientonuripdf&nuri=<?=$nuri?>" target="_blank" style="color:white; background-color:#086A87; ">
                                    <i class="fa fa-print"></i>Imprimir Seguimiento
                                </a>
                            </center>
                        
                        
                        <?php 
                        
                            // codigo pra tooltip 
                            /*$js = <<<SCRIPT
                                // To initialize BS3 tooltips set this below 
                                $(function () { 
                                    $("[data-toggle='tooltip']").tooltip(); 
                                });;
                                // To initialize BS3 popovers set this below 
                                $(function () { 
                                    $("[data-toggle='popover']").popover(); 
                                });
                                SCRIPT;
                                // Register tooltip/popover initialization javascript
                                $this->registerJs($js);


                                echo 'Testing for ' . Html::tag('span', 'tooltip', [
                                    'title'=>'This is a test tooltip',
                                    'data-toggle'=>'tooltip',
                                    'style'=>'text-decoration: underline; cursor:pointer;'
                                ]);*/



/*
echo Tooltip::widget([
    'content' => "?",
    'title' => "This is an example of how a widget works",
    'size' => Tooltip::SIZE_LARGE
]); */

                        
                        ?>
                        
                        
                </h4>
              </div>
                <hr>
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


          //codigo para obtener los valores de mi documento


       }
       else{

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
                <table class="table table-bordered table-responsive table-striped" id="table_cabecera_seguimiento" style="font-size: 15px;" >
                  <tr>
                    <th><i  class="fa fa-files-o"></i> Tipo Documento</th>
                    <td><?php echo $tipo_documento?></td>
                    <th><i  class="fa fa-calendar"></i> Fecha/Hora Creaci&oacute;n</th>
                    <td><?=Yii::$app->formatter->asDate($fecha_creacion, 'medium')." - ".$hora_creacion?></td>  
                  </tr>
                  <tr>
                    <th><i  class="fa fa-pencil"></i> CITE</th>
                    <td>
                       <?php 
                       // codigo para mostrar los documentos asociados
                       // en el nuevo sistema
                       if (Seguimientos::countNuriHojasRuta($nuri)>0) {

                        $dataReader= Seguimientos::getNurisAsociados($nuri);
                        $l=0;
                        foreach($dataReader as $row2) {  ?>
                        
                        <?php    $l++;
                            //echo $row2['cite'];
                            
                            echo Tooltip::widget([
                                'content' => "?",
                                'title' => "<div>Para ver el contenido del documento, click en el número de <b>CITE</b></div>",
                                'size' => Tooltip::SIZE_LARGE
                            ]);
                            
                            echo Html::a(" <b>".$row2['codigo']."</b>", $row2['id_documento'], [
                                        'data-toggle' => 'modal',
                                        'data-target' => '#update-modal',
                                        'class' => 'data-update',
                                        'data-id' => $row2['id_documento'],
                                    ]);
                             ?>
                        
                        <br>
                      <?php  } // fin foreach

                       }
                       else{ } 
                       ?> 

                    </td> 
                    <th><i  class="fa fa-chain"></i> Adjuntos</th>
                    <td><?=$adjunto?></td>
                  </tr>
                  <tr>
                    <th><i  class="fa fa-commenting-o"></i> Referencia</th>
                    <td colspan="3"><?=$referencia?></td>  
                  </tr>
                  <tr>
                    <th><i  class="fa fa-user"></i> Remitente</th>
                    <td colspan="3"><?=$remitente?></td>  
                  </tr>
                  <tr>
                    <th><i  class="fa fa-user-o"></i> Destinatario</th>
                    <td colspan="3"><?=$destinatario?></td>  
                  </tr>

                  <?php 
                    if ($carpeta_pago==1) {

                      //$row_suic=Documentos::listUpdateTalleresSUIC($taller_suic);
                      //$row_orden_suic=Documentos::listUpdateOrdenPagoSUIC($orden_pago_suic);    
                  ?>

                  <!--<tr>
                    <th><i  class="fa fa-industry"></i> Taller</th>
                    <td><?php //=$row_suic['Taller']?></td>  
                    <th><i  class="fa fa-folder"></i> N° Carpeta</th>
                    <td><?php //=$row_orden_suic['CarpetaPago']?></td>  
                  </tr>
                  <tr>
                    <th><i  class="fa fa-bars"></i> Tipo</th>
                    <td colspan="3"><?php //=$row_orden_suic['TipoOrden']?></td>  
                  </tr>-->

                  <?php 
                    }
                  ?>



                  <?php 
                    if ($tipo_documento=='CARTA EXTERNA') {
                  ?>
                  <tr>
                    <th><i  class="fa fa-user-o"></i> Instituci&oacute;n Remitente</th>
                    <td colspan="3"><?=$remitente_institucion?></td>  
                  </tr>
                  <?php } ?>

                  <?php 

                    //CODIGO PARA VER EL DOCUMENTO ESCANEADO DEL SAC
                    if (count(Seguimientos::listaCartaExterna($nuri))>0){ ?>
                    
                    <tr>
                      <th><i  class="fa fa-file-text-o "></i> Documento Escaneado</th>
                      <td colspan="3">
                        <?php 
                        $dataReader=Seguimientos::listaCartaExterna($nuri); 
                        foreach ($dataReader as $row2) {
                          
                            echo Tooltip::widget([
                                'content' => "?",
                                'title' => "<div>Para ver el archivo escaneado, click en el número de <b>CITE EXTERNO</b></div>",
                                'size' => Tooltip::SIZE_LARGE
                            ])." ";
                            
                            //echo " <b style='color:#0074DE;'>".$row2['codigo']."</b><br>";
                            echo Html::a(" <b style='color:#0074DE;'>".$row2['codigo']."</b><br>", [
                                            'seguimientos/verescaneadopdf',
                                            'id' => $row2['id_documento'],
                                        ], [
                                            'class' => 'btn btn-default',
                                            'target' => '_blank',
                                        ]);
                            
                            
                            
//use yii\bootstrap\Modal;
//use yii\helpers\Url;
/*
Modal::begin([
    'header' => '<h2>Hello world</h2>',
    'toggleButton' => ['label' => 'click me'],
]);

echo \yii2assets\pdfjs\PdfJs::widget([
  'url' => Url::base().'/uploads/'.$row2['gestion']."/".$row2['ruta_documento']
]);

Modal::end();*/

                            
                        }
                        ?>
                      </td>  
                    </tr>
                      
                  <?php  }//if (count(Seguimientos::listaCartaExterna($nuri))>0){ 
                    else{ } //else{
                  ?>

                    
                  <!--############## CODIGO PARA MSTRAR SI EL NURI PERTENECE A UN AGRUPADO DEL SAC-->
                  <?php if (Seguimientos::countNuriSecundarioAgrupacion($nuri)>0) { 
                        $nuri_principal=Seguimientos::getNuriPrincipal($nuri); 
                  ?>
                  <tr>
                    <th><i  class="fa fa-group"></i> Agrupaci&oacute;n</th>
                    <td colspan="3" style="color:darkred;"><span style="font-size: 9pt;">Una copia de este documento pertenece al NUR/NURI Principal</span> 

                      <div class="tooltip3 tooltip-effect-1">
                        <div class="tooltip-item">

                          <a href="index.php?r=seguimientos/seguimientonuri&nuri=<?=$nuri_principal?>"><?=$nuri_principal?></a>
                          
                        </div>
                        
                        </div><!-- tooltip3 tooltip-effect-1-->
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

       
               

        <div class="col-md-3">
           <!-- /.card-header -->
          <div class="card-body">

            <!-- codigo obtenido de la raiz-->
            <!-- http://localhost/jquery-treeview-master/demo/ -->
            <?php if (Seguimientos::countNuriPrincipal($nuri)>0) { 

               $principal=' PRINCIPAL';
             } 
             else{ 
               $principal='';

            }
             ?>
            <h6 style="color:#0174DF; font-weight: bold;"><b><u>NUR/NURI <?=$principal?></u></b></h6>
              <ul id="browser" class="filetree">
                <li><i class="fa fa-folder-open-o" style="font-size: 21px;"></i>&nbsp;&nbsp;<b style="font-size:22px; color:#0B3861;"><?=$nuri?></b>
                  <ul>

                    <?php if (Seguimientos::countNuriPrincipal($nuri)>0) { 
                        $dataReader=Seguimientos::listaAgrupacion($nuri); 
                        foreach ($dataReader as $row2) {
                      ?>
                      <li><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;
                        
                          <a href="index.php?r=seguimientos/seguimientonuri&nuri=<?=$row2['nur_hijo']?>"><?=$row2['nur_hijo']?> <span style="font-size:7.5pt;">(<?=$row2['estado_tramite']?> <?=$row2['copia']?>)<span></a>
                          
                      </li>
                    <?php 
                          } // fin foreach
                        } ?>
                  </ul>
                </li>

              </ul><!-- fin ul-->

                      
          </div>
                  <!-- /.card -->
          </div>
               <!-- /.col -->
      </div>   




   
            
              
            


			     

<?php  /*
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialogClassroom',
    'options'=>array(
        'title'=>'Documento',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'60%',
        'height'=>670,
        'draggable' => false,
        //'position'=>array(600,600), 
        'position'=> array('my'=> "center", 'at'=> "center"),
        //'position'=>array('my'=>'center','at'=>'center', 'of' => ''),
    ),
)); */ ?>
                  
                  
<div class="divForForm"></div>

<?php //$this->endWidget();?>

<script type="text/javascript">
// here is the magic
function addClassroom()
{
  <?php /*echo CHtml::ajax(array(
      'url'=>array('seguimientos/viewDocument', 'id'=>$id_doc),
      'data'=> "js:$(this).serialize()",
      'type'=>'post',
      'dataType'=>'json',
      'success'=>"function(data)
      {
        if (data.status == 'failure')
        {
          $('#dialogClassroom div.divForForm').html(data.div);
                          // Here is the trick: on submit-> once again this function!
          $('#dialogClassroom div.divForForm form').submit(addClassroom);
        }
        else
        {
          $('#dialogClassroom div.divForForm').html(data.div);
          setTimeout(\"$('#dialogClassroom').dialog('close') \",3000);
        }
        
      } ",
      ))*/  ?>;
  return false; 
  
}

</script>



      <!-- row -->
      <div class="row">
        <div class="col-md-12">

          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                <span class="bg-default" style="width:100%; background: #ECF0F5; border: 1px solid rgba(55,72,79, 0.4);">
                    <?=$nuri?> <b><u style="color:#681208">Oficial</u></b>
                </span>
            </li>
            <!-- timeline item -->
            <li >
              <i class="fa fa-sort-alpha-asc" style="background-color: #0080FF; color: white;"></i>

              <div class="timeline-item">


              	<div class="card-body pad table-responsive">
                    <table class="table table-bordered table-responsive table-striped"  id="table_seguimiento" border="1" style="font-size:13px; ">
	              	<tr>
		            	<th>DERIVADO POR:</th>
		            	<th>DERIVADO A:</th>
		            	<th>DESPACHO</th>
		            	<th>RECEPCI&Oacute;N</th>
		            	<th>ACCI&Oacute;N</th>
		            	<th>ESTADO</th>
		            	<th>ADJUNTOS</th>
                </tr>

                
                <?php
			            $dataReader=Seguimientos::getSearchNuri($nuri,1);
                  $i=0;
			            foreach($dataReader as $row) {

			            //$total_contrato=$total_contrato+$row['total_contrato'];
			            if (($row['fk_estado']==1) || $row['fk_estado']==3 ) 
                  { $icono='<i class="fa fa-thumbs-o-up" style="font-size:24px; color:#610B0B;"></i>'; 
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
			           	<!--<td><?php //=Yii::$app->formatter->asDate($row['f_recepcion'], 'medium')." - ".$row['h_recepcion']?></td>-->
			<td>
                            <?php
                                   if($row['f_recepcion']=='1000-01-01'){
                                        echo "";
                                   }
                                   else{
                                       echo Yii::$app->formatter->asDate($row['f_recepcion'], 'medium')." - ".$row['h_recepcion'];
                                   }
                            ?>
                        </td>
			           	<td><?=$row['accion']?></td>
			           	<td style="<?=$color?>">
                            <?php
                              
                              if ($row['fk_estado']==5) {

                                 //echo '<i class='fa fa-archive'></i> '.$row['estado'];
                                  
                                 echo Tooltip::widget([
                                        'content' => "?",
                                        'title' => "<div>Para ver el contenido del <b>ARCHIVO</b>,<br> click en el <b>ENLACE</b></div>",
                                        'size' => Tooltip::SIZE_LARGE
                                    ])." "; 
                                 
                                 echo Html::a("<b><i class='fa fa-archive'></i>".$row['estado']."</b>", $row['id_seguimiento'], [
                                        'data-toggle' => 'modal',
                                        'data-target' => '#archivo-modal',
                                        'class' => 'data-archivo',
                                        'data-id' => $row['id_seguimiento'],
                                    ]);
                                 
                                 
                                 
                                  
                                 /*echo CHtml::ajaxLink('<i class="fa fa-archive"></i> '.$row['estado'],
                                      $this->createUrl('Seguimientos/viewDetalleArchivo', array("id"=>$row['id_seguimiento'])),
                                    array(
                                        'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}'
                                    ),
                                    array('id'=>'showJuiDialog300000'.$i, 'style'=>'color:#0174DF; font-weight: bold;') // not very useful, but hey...
                                    ); echo "<br>";*/
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

                            $num2=rand(11111111111,9999999999);   
                            $i++;
                            //echo $row2['codigo'];
                            echo Tooltip::widget([
                                'content' => "?",
                                'title' => "<div>Para ver el contenido del documento, click en el número de <b>CITE</b></div>",
                                'size' => Tooltip::SIZE_LARGE
                            ]);
                            
                             echo Html::a(" <b>".$row2['codigo']."</b>", $row2['fk_documento'], [
                                        'data-toggle' => 'modal',
                                        'data-target' => '#update-modal',
                                        'class' => 'data-update',
                                        'data-id' => $row2['fk_documento'],
                                    ]);
                                    
                            /*echo CHtml::ajaxLink($row2['codigo'],
                              $this->createUrl('Seguimientos/viewDocumentSeguimiento', array("id"=>$row2['fk_documento'])),
                            array(
                                'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}'
                            ),
                            array('id'=>'showJuiDialog'.$num2, 'style'=>'color:#0174DF; font-weight: bold;') // not very useful, but hey...
                            );*/ echo "<br>";


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
            </li>
            <!-- END timeline item -->
           
          </ul>
        </div>
        <?php 
// codigo para mostrar el popup dinamico mencionado en la tabla de seguimiento
/*
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'juiDialog3',
                'options'=>array(
                    'title'=>'Documento',
                    'autoOpen'=>false,
                    'modal'=>true,
                    'width'=>'60%',
                    'height'=>670,
                ),

                ));

$this->endWidget();     */
//############################################
?>



        <!-- /.col -->
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-default" style="width:100%; background: #ECF0F5; border: 1px solid rgba(55,72,79, 0.4);">
                    <?=$nuri?> <b><u style="color:#681208">Copias</u></b>
                  </span>
            </li>
            <!-- /.timeline-label -->
           
            <!-- timeline item -->

            <li >
              <i class="fa fa-sort-alpha-asc" style="background-color: #0080FF; color: white;"></i>

              <div class="timeline-item">
              	<div class="card card-default "><!--collapsed-card-->
		              <div class="card-header">
		                <!--<h3 class="card-title">Copia Digital</h3>-->
			                <div class="card-tools">
				                  
				            </div>
				            <!-- /.card-tools -->
				       </div>
                    
                    
                    
                   
                    
				        <!-- /.card-header -->
				        <div class="card-body">
				            <div class="card-body pad table-responsive">
                                                <table class="table table-bordered table-responsive table-striped"  id="table_seguimiento" border="1"  style="font-size:13px; ">
					              <tr>
						            	<th>DERIVADO POR:</th>
						            	<th>DERIVADO A:</th>
						            	<th>DESPACHO</th>
						            	<th>RECEPCI&Oacute;N</th>
						            	<th>ACCI&Oacute;N</th>
						            	<th>ESTADO</th>
						            	<th>ADJUNTOS</th>
						            </tr>

                  
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

                                //echo '<i class="fa fa-archive"></i> '.$row['estado'];
                                echo Tooltip::widget([
                                        'content' => "?",
                                        'title' => "<div>Para ver el contenido del <b>ARCHIVO</b>,<br> click en el <b>ENLACE</b></div>",
                                        'size' => Tooltip::SIZE_LARGE
                                    ])." "; 
                                
                                 echo Html::a("<b><i class='fa fa-archive'></i> ".$row['estado']."</b>", $row['id_seguimiento'], [
                                        'data-toggle' => 'modal',
                                        'data-target' => '#archivo-modal',
                                        'class' => 'data-archivo',
                                        'data-id' => $row['id_seguimiento'],
                                    ]);
                                
                                
                                /*echo CHtml::ajaxLink('<i class="fa fa-archive"></i> '.$row['estado'],        
                                      $this->createUrl('Seguimientos/viewDetalleArchivo', array("id"=>$row['id_seguimiento'])),
                                    array(
                                        'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}'
                                    ),
                                    array('id'=>'showJuiDialog3'.$i, 'style'=>'color:#0174DF; font-weight: bold;') // not very useful, but hey...
                                    );*/ echo "<br>";

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
                                $num3=rand(111111,999999);
                                  $i++;
                                  //echo $row2['codigo'];
                                  
                                  echo Tooltip::widget([
                                        'content' => "?",
                                        'title' => "<div>Para ver el contenido del documento, click en el número de <b>CITE</b></div>",
                                        'size' => Tooltip::SIZE_LARGE
                                    ]);
                                  
                                  
                                  echo Html::a(" <b>".$row2['codigo']."</b>", $row2['fk_documento'], [
                                        'data-toggle' => 'modal',
                                        'data-target' => '#update-modal',
                                        'class' => 'data-update',
                                        'data-id' => $row2['fk_documento'],
                                    ]);
                                  
                                  
                                  /*echo CHtml::ajaxLink($row2['codigo'],
                                    $this->createUrl('Seguimientos/viewDocumentSeguimiento', array("id"=>$row2['fk_documento'])),
                                  array(
                                      'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}'
                                  ),
                                  array('id'=>'showJuiDialog'.$num3, 'style'=>'color:#0174DF; font-weight: bold;') // not very useful, but hey...
                                  );*/ echo "<br>";


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
				<!-- /.card -->




              		

              </div>
            </li>
            <!-- END timeline item -->
            
            
            
            <li>
              <i class="fa fa-clock-o " style="background-color: #0080FF; color: white;"></i>
            </li>
          </ul>
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

