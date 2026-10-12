<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Areas;
use app\models\Usuarios;
use app\models\Listaderivacion;

use yii\data\SqlDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


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
            'showProgressbar' => false,
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
    'title' => '<b>ERROR EN LA OPERACIÓN</b>',
    'icon' => 'glyphicon glyphicon-remove-circle',
    //'body' => 'Change a few things up and try submitting again.',
    'body' => Yii::$app->session->getFlash('error'),
    'showSeparator' => true,
    'delay' => 4500,
    'pluginOptions' => [
        'showProgressbar' => false,
        'placement' => [
            'from' => 'top',
            'align' => 'right',
        ],
        'timer'=>1700,
    ]
  ]);
}

if (Yii::$app->session->getFlash('warning')){
    echo Growl::widget([
    'type' => Growl::TYPE_WARNING,
    'title' => '<b>ADVERTENCIA</b>',
    'icon' => 'glyphicon glyphicon-remove-circle',
    //'body' => 'Change a few things up and try submitting again.',
    'body' => Yii::$app->session->getFlash('warning'),
    'showSeparator' => true,
    'delay' => 500,
    'pluginOptions' => [
        'showProgressbar' => false,
        'placement' => [
            'from' => 'top',
            'align' => 'right',
        ],
        'timer'=>1700,
    ]
  ]);
}


//$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = 'Lista de derivacion (Destino)';
?>

<!-- CODIGO PARA MOSTRAR LISTA DE DERIVACION A USUARIOS ESPECIFICOS Y UNIDAD OPERATIVA -->        
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
<div class="usuarios-index">

<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="fa fa-user-plus" style="font-size:30pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 16pt;">Lista de derivaci&oacute;n</u></b>
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


<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="row">
    <div class="col-md-6">
        <br>
        <center>
        <span style="color:#0B4C5F; font-size: 14pt;" ><b>Usuarios habilitados en el sistema</b></span>
        </center>
        

        <div class="container-fluid" style="width: 100%;">
              <table class="datatable table table-hover table-bordered table-striped" style="width:100%;" >
              <thead>
                  <tr style="background-color: #B8C7CD;">
                  <th>ID</th>
                  <th>NOMBRE</th>
                  <!--<th>CARGO</th>-->
                  <th>&Aacute;REA/UNIDAD</th>
                  <th></th>
                </tr>
              </thead>
              
              <tfoot>
                <tr>
                  <th></th>
                  <th>
                    <input type="text" class="form-control input-sm filter-column">
                  </th>
                  <!--<th>
                    <input type="text" class="form-control input-sm filter-column" />
                  </th>-->
                  
                  <th>
                    <select class="form-control input-sm filter-column">
                        <option value="" selected>SELECCIONE</option>  
                      <?php 
                            foreach(Usuarios::getLisderivacionAreas() as $row){ 
                      ?>  
                      <option value="<?=$row['area']?>"><?=$row['area']?></option>
                            <?php } ?>
                    </select>
                  </th>
                  <th></th>

                </tr>
              </tfoot>
              
              <tbody>
                <?php 

                    $dataReader=Usuarios::getLisderivacion();
                    $i=0;
                    foreach($dataReader as $row){
                    $i++;    
                ?>
                  <tr style="font-size: 9pt;  ">
                        <td><?=$i?></td>
                        <td><?= Listaderivacion::getNameDestino($row['id_usuario'])?></td>
                        <!--<td><?=$row['cargo']?></td>-->
                        <td style="vertical-align: middle;"><?=Usuarios::getUsuarioArea($row['id_usuario'])?></td>
                        <td style="vertical-align: middle;">
                            <?php 
                                    echo Html :: a ('
                                                <span class="btn btn-primary" style="font-size:10pt;">
                                                <span class="glyphicon glyphicon-log-out"></span> Añadir</span>'
                                                , ['usuarios/addlistderivar', 'id_usuario_destino'=>$row['id_usuario']], [
                                                        'class' => 'data-update',
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
    
    
    
    <div class="col-md-6">
        <br>
        <center>
        <span style="color:#0B4C5F; font-size: 14pt;" ><b>Usuarios asignados para derivar tr&aacute;mites</b></span>
        </center>
        
        <div class="container-fluid" style="width: 100%; position: relative;">
              <table class="datatable_destino table table-hover table-bordered table-striped" style="width:100%;" >
              <thead>
                  <tr style="background-color: #B8C7CD;">
                  <th>ID</th>
                  <th>NOMBRE</th>
                  <!--<th>CARGO</th>-->
                  <th>&Aacute;REA/UNIDAD</th>
                  <th></th>
                </tr>
              </thead>
              
              <tfoot>
                <tr>
                  <th></th>
                  <th>
                    <input type="text" class="form-control input-sm filter-column-destino">
                  </th>
                  <th>
                    <input type="text" class="form-control input-sm filter-column-destino" />
                  </th>
                  <th></th>

                </tr>
              </tfoot>
              
              <tbody>
                <?php 

                    $dataReader=Usuarios::getListaderivacionDestino();
                    $i=0;
                    foreach($dataReader as $row){
                    $i++;    
                ?>
                  <tr style="font-size: 9pt;">
                      <td><?=$i?></td>
                      <td><?= Listaderivacion::getNameDestino($row['usuario_destino'])?></td>
                        <td style="vertical-align: middle;"><?=Usuarios::getUsuarioArea($row['usuario_destino'])?></td>
                        <td style="vertical-align: middle;">
                            <?php 
                                    echo Html :: a ('
                                                <span class="btn btn-danger" style="font-size:10pt;">
                                                <span class="glyphicon glyphicon-trash"></span> Eliminar</span>'
                                                , ['usuarios/deletelistderivar', 'id_lista_derivacion'=>$row['id_lista_derivacion']], [
                                                        'class' => 'data-update',
                            ]); ?>
                        </td>
                    </tr>
                <?php } ?>    
              </tbody>
            </table>
          </div>
        
        <?php 
                    
            /*    $searchModel = new app\models\ListaderivacionSearch();
                $dataProvider = $searchModel->searchListaDerivacion(Yii::$app->request->queryParams, ['pagination' => [ 'pageSize' => 10 ]]);
                //$dataProvider2->pagination->pageSize=7;
                
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'tableOptions'=> ['class'=>'table table-striped table-bordered table-hover'],
                        'emptyText'=>'No existen registros',
                        'filterErrorOptions'=>['class'=>'alert alert-danger'],
                        
                        'showFooter'=>true,
                        'showHeader' => true,
                        //'showFooter' => true,
                        'pager' => [
                            'nextPageLabel' => '»',
                            'prevPageLabel' => '«',
                            'firstPageLabel' => 'Primero',
                            'maxButtonCount' => 5,
                            'lastPageLabel'  => 'Último'
                        ],
                        
                        //'options' => ['style' => 'font-size:10px;'],
                        'columns' => [
                            [
                                'class' => 'yii\grid\SerialColumn',
                                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],
                            ],
                            
                            [
                                'attribute'=>'Nombres',
                                'value' => function ($model) {
                                        return $model->getNameDestino($model->usuario_destino);
                                   },
                                'format'=>'html',
                                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size:9pt;'],
                                'headerOptions'=>['style'=>'color:black;'],
                                'filter'=>false,
                            ],
                            [
                                //'label'=>'Referencia',
                                'attribute'=>'Area/Unidad',
                                'value' => function ($model) {
                                        return $model->usuarioDestino->fkArea->area;
                                   },
                                'format'=>'html',
                                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size:9pt;'],
                                'headerOptions'=>['style'=>'color:black;'],
                                'filter'=>false,
                            ],
                            [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => 'Opciones',
                                    'headerOptions' => ['style' => 'width: 50px;'],
                                    'contentOptions'=>['style'=>'border: 1px solid #BEBFC1;'],

                                     'template' => '{eliminar}',
                                     'buttons'=>[

                                     'eliminar'=>function($url, $model){

                                       return Html::a(
                                                     '<span class="btn btn-sm btn-block btn-danger">
                                                         <span class="glyphicon glyphicon-trash" style="font-size: 11pt;"></span> Eliminar<span>',
                                                     $url, ['title'=>'Añadir a lista de derivacion',]
                                                 );
                                     },

                                 ],
                                 'urlCreator'=>function($action, $model, $key, $index){

                                         if($action=='eliminar'){
                                            return yii\helpers\Url::to(['usuarios/deletelistderivar', 'id_lista_derivacion'=>$model->id_lista_derivacion]); 
                                         }
                                 }

                            ], // fin buttons               
                                           
                                           
                                            
                                            
                        ], // FIN COLUMNS
                    ]); // fin gridview
              
             */
                ?>
        
        
    </div>
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