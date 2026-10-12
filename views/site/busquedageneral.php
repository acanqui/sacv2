<?php

use yii\helpers\Html;
use yii\grid\GridView;

use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContratosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Reporte Contratos';
$this->params['breadcrumbs'][] = 'Búsqueda General';

//echo "====> ".$palabra;
?>


<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="glyphicon glyphicon-zoom-in" style="font-size:25pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><span style="font-size: 18pt;">B&uacute;squeda General</span></b>
          </h5>
        </div>
    </div>
    <div class="col-md-6">
        <!--<div class="card-body" >
          <p style="color:#0B2F3A">
          Opcionalmente, puede ingresar un operador de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> o <b>=</b>) al comienzo de cada uno de sus valores de búsqueda para especificar cómo se debe hacer la comparación.
          </p>
        </div>-->
    </div>
</div>



<div class="row">
    <div class="col-md-6">
          <br>
          <?=Html::beginForm(['site/busquedageneral'], 'GET', ['class' => 'sidebar-form1']); ?>
            <br>
            <?=Html::input('text', 'palabra', Yii::$app->request->post('palabra'), ['required'=>true, 'class'=>'form-control', 'placeholder'=>'Ingrese texto de referencia...']); ?>
            <br>
            <?=Html::submitButton('<i class="fa fa-search"></i> BUSCAR', ['class' => 'btn btn-primary']); ?>
            <?=Html::a("<i class='glyphicon glyphicon-ban-circle'></i> <span style='font-size:9pt;'> Cancelar</span>", ['site/menubusqueda'], ['class' => 'btn btn-danger' ]); ?>

        <?=Html::endForm(); ?>
        
    </div>
    <div class="col-md-4" style="font-size:10pt;">
        <b>La b&uacute;squeda se realizar&aacute; en los siguientes campos:</b>
        <br>
        <lu>
            <li>NURI </li>
            <li>CITE </li>
            <li>Nombre destino </li>
            <li>Cargo destino</li>
            <li>Nombre v&iacute;a</li>
            <li>Cargo v&iacute;a</li>
            <li>Referencia</li>
        </lu>
    </div>
    <div class="col-md-2" style="font-size:10pt;">
        <br>
        <lu>
            <li>Contenido</li>
            <li>Nombre remitente</li>
            <li>Cargo remitente</li>
            <li>Adjuntos</li>
            <li>Copias</li>
        </lu>
    </div>
</div>

<br>



<?php

if($palabra!="NULL"){
    
    
 function obtenerBaseDeDatos()
{
    $host = "127.0.0.1";
    $puerto = "27017";
    $usuario = rawurlencode("sistemas");
    $pass = rawurlencode("s1st3m4s");
    $nombreBD = "dbsac";
    # Crea algo como mongodb://parzibyte:hunter2@127.0.0.1:27017/agenda
    $cadenaConexion = sprintf("mongodb://%s:%s@%s:%s/%s", $usuario, $pass, $host, $puerto, $nombreBD);
    $cliente = new MongoDB\Client($cadenaConexion);
    return $cliente->selectDatabase($nombreBD);
}

$baseDeDatos = obtenerBaseDeDatos();
# Acceder a la colección contactos
$coleccion = $baseDeDatos->documentos;

// LIKE PARA MONGO DB
$result = $baseDeDatos->documentos->find(array('$or' => array(
            
            array(strtolower('nuri') => new \MongoDB\BSON\Regex("$palabra"),),
            array(strtolower('tipo_tramite') => new \MongoDB\BSON\Regex("$palabra"),),
            array(strtolower('cite') => new \MongoDB\BSON\Regex("$palabra"),),
            array(strtolower('nombre_destino') => new \MongoDB\BSON\Regex("$palabra"),),
            array(strtolower('cargo_destino') => new \MongoDB\BSON\Regex("$palabra"),),
            array(strtolower('nombre_via') => new \MongoDB\BSON\Regex("$palabra"),),
            array(strtolower('cargo_via') => new \MongoDB\BSON\Regex("$palabra"),),
            array(strtolower('fecha') => new \MongoDB\BSON\Regex("$palabra"),),
            array(strtolower('referencia') => new \MongoDB\BSON\Regex("$palabra"),),
            array(strtolower('contenido') => new \MongoDB\BSON\Regex("$palabra"),),
            array(strtolower('nombre_remitente') => new \MongoDB\BSON\Regex("$palabra"),),
            array(strtolower('cargo_remitente') => new \MongoDB\BSON\Regex("$palabra"),),
            array(strtolower('institucion_remitente') => new \MongoDB\BSON\Regex("$palabra"),),
            array(strtolower('adjuntos') => new \MongoDB\BSON\Regex("$palabra"),),
            array(strtolower('copias') => new \MongoDB\BSON\Regex("$palabra"),),
            array(strtolower('nro_hojas') => new \MongoDB\BSON\Regex("$palabra"),),
            array(strtolower('tipo_documento') => new \MongoDB\BSON\Regex("$palabra"),),
            array(strtolower('estado_documento') => new \MongoDB\BSON\Regex("$palabra"),),
            array(strtolower('area') => new \MongoDB\BSON\Regex("$palabra"),),
     
)));


/*foreach ($result as $row) {
    echo $row['id_documento']." ===>";
    echo $row['nuri'], ': ', $row['cite'];
    echo $row['_id'], ': ', $row['adjuntos'], "\n<br>";
    
}*/

?>



<head>
          <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" /> -->
          <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" />
          <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css" />
          <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css" type="text/css" />
          <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.bootstrap.min.css" type="text/css" />
          <style>
              .datatable_destino tfoot {
                            display: table-header-group;
                          }

              .datatable_destino tfoot .filter-column {
                            width: 100% !important;
                          }
                          
              
              .datatable tfoot {
                            display: table-header-group;
                          }

              .datatable tfoot .filter-column {
                            width: 100% !important;
                          }
          </style>
</head>


<style>
.grid-view table thead {
    background-color: #B8C7CD;
}

.grid-view table thead a {
    color: #222D32;
}
</style>


<hr style="border-top: solid gray 1pt; width: 90%;">

<div class="row">
    <div class="col-md-12">
        <center>
            <h3><b>RESULTADO</b></h3>
        </center>

        <div class="container-fluid" style="width: 100%;">
              <table class="datatable table table-hover table-bordered table-striped" style="width:100%;" >
                  <caption class="text-center">Resultados encontrados con la referencia: <b><?=$palabra?></b></caption>
              <thead>
                  <tr style="background-color: #B8C7CD;">
                  <th>NUR/NURI</th>
                  <th>CITE</th>
                  <!--<th>CARGO</th>-->
                  <th>REFERENCIA</th>
                  <th>TIPO DOCUMENTO</th>
                  <th>FECHA DOC.</th>
                  <th>REMITENTE</th>
                  <th></th>
                </tr>
              </thead>
              
              <tfoot>
                <tr>
                  <th><input type="text" class="form-control input-sm filter-column"></th>
                  <th><input type="text" class="form-control input-sm filter-column"></th>
                  <th>
                    <input type="text" class="form-control input-sm filter-column">
                  </th>
                  <!--<th>
                    <input type="text" class="form-control input-sm filter-column" />
                  </th>-->
                  
                  <th>
                    <input type="text" class="form-control input-sm filter-column">
                  </th>
                  <th><input type="text" class="form-control input-sm filter-column"></th>
                  <th><input type="text" class="form-control input-sm filter-column"></th>
                  <th></th>

                </tr>
              </tfoot>
              
              <tbody>
                <?php 

                    //$dataReader= app\models\Usuarios::getLisderivacion();
                    //$i=0;
                    
                    //$i++;
                    
                    foreach ($result as $row) {
                ?>
                  <tr style="font-size: 9pt;  ">
                        <td><?=$row['nuri']?></td>
                        <td><?=$row['cite']?></td>
                        <td style="vertical-align: middle;"><?=$row['referencia']?></td>
                        <td style="vertical-align: middle;"><?=$row['tipo_documento']?></td>
                        <td style="vertical-align: middle;"><?=$row['fecha']?></td>
                        <td style="vertical-align: middle;"><?=$row['nombre_remitente']?> <br><b><?=$row['cargo_remitente']?></b></td>
                        <td style="vertical-align: middle;">
                            <?php 
                                    echo Html :: a ('
                                                <span class="btn btn-primary" style="font-size:10pt;">
                                                <span class="fa fa-paw"></span> Seguimiento</span>'
                                                , ['seguimientos/seguimientonuri', 'nuri'=>$row['nuri']], [
                                                        'class' => 'data-update',
                                                        'target'=>'_blank'
                            ]); ?>
                        </td>
                    </tr>
                <?php } ?>    
              </tbody>
            </table>
          </div>

          
  
    <?php 
    
      //  } // end else
    ?>
  
        
    </div>
</div>    

          <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
          <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
          <script src="//cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
          <!-- Responsive extension -->
          <script src="https://cdn.datatables.net/responsive/2.1.0/js/responsive.bootstrap.min.js"></script>
          <!-- Buttons extension -->
          
          <!--<script src="//cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
          <script src="//cdn.datatables.net/buttons/1.2.1/js/buttons.bootstrap.min.js"></script>
          <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
          <script src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script> -->

          <script>

                var dataTable = $('.datatable').DataTable({
                buttons: [
                  {
                    extend: 'excel',
                    text: 'Export to Excel',
                    className: 'btn-sm btn-flat',
                  },
                ],
                dom: "<'row'<'col-md-3'l><'col-md-6 text-center'B><'col-md-3'f>>" +
                       "<'row'<'col-md-12'tr>>" +
                       "<'row'<'col-md-5'i><'col-md-7'p>>",
                drawCallback: function(settings) {
                  if (!$('.datatable').parent().hasClass('table-responsive')) {
                    $('.datatable').wrap("<div class='table-responsive'></div>");
                  }
                }
              });

              dataTable.columns().every(function() {
                var column = this;

                $('.filter-column', this.footer()).on('keyup change', function() {
                  if (column.search() !== this.value) {
                    column
                      .search(this.value)
                      .draw();
                    this.focus();
                  }
                });
              });
              
              
              
              var datatable_destino = $('.datatable_destino').DataTable({
                buttons: [
                  {
                    extend: 'excel',
                    text: 'Export to Excel',
                    className: 'btn-sm btn-flat',
                  },
                ],
                dom: "<'row'<'col-md-3'l><'col-md-6 text-center'B><'col-md-3'f>>" +
                       "<'row'<'col-md-12'tr>>" +
                       "<'row'<'col-md-5'i><'col-md-7'p>>",
                drawCallback: function(settings) {
                  if (!$('.datatable_destino').parent().hasClass('table-responsive')) {
                    $('.datatable_destino').wrap("<div class='table-responsive'></div>");
                  }
                }
              });

              datatable_destino.columns().every(function() {
                var column = this;

                $('.filter-column-destino', this.footer()).on('keyup change', function() {
                  if (column.search() !== this.value) {
                    column
                      .search(this.value)
                      .draw();
                    this.focus();
                  }
                });
              });
          </script>







<?php } //end if ?>

