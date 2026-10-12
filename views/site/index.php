<?php
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use miloschuman\highcharts\Highcharts;
/* @var $this yii\web\View */

use app\models\Seguimientos;


use edwinhaq\simpleloading\SimpleLoading;
SimpleLoading::widget();

/*echo date('d-m-Y H:i:s')."<br><br>";

$mifecha = new DateTime(); 
$mifecha->modify('+48 hours'); 
echo $mifecha->format('d-m-Y H:i:s');*/

//echo "---------------> ".Seguimientos::getFechaBloqueo();

/*if(Seguimientos::getFechaBloqueo()<date('Y-m-d')){
    
    //echo "<br><b>Usuario Bloqueado</b>";
}*/


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

?>


<?php //echo "--------> ".Yii::$app->request->baseUrl ?>

<?php
// CODIGO PARA EJECUTAR UNA LLAMADA AJAX CADA 30 MIN -->
$script=<<< JS
        
    $(document).ready(function(){
        setInterval(function(){
            $("#ajax").load("index.php?r=site/indexajax");
        }, 900000);
        
        //alert("prueba de informacion");
    });   
JS;
$this->registerJs($script);

?>

<link href="<?= Yii::$app->request->baseUrl ?>/css/estilos.css" rel="stylesheet" type="text/css">
<div class="site-index">

    <center>
        <b style="font-size:22pt;">Sistema de Administraci&oacute;n de Correspondencia S.A.C.</b>
    </center><br>    
 
    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                
                <a href="index.php?r=seguimientos/quedebenllegar" style="text-decoration: none;">
                <div class="card">
                        <div class="thumbnail" style="background-color: #391144;" >
                          <i style="top:10px; position:relative;" class="glyphicon glyphicon-cloud-download fa-2x"></i>
                        </div>
                      <h5 class="numero">
                          
                          
                          <div id="ajax">
                              <?php /* Seguimientos::countQueDebenLlegar(1,Yii::$app->user->identity->id_usuario)+Seguimientos::countQueDebenLlegar(0,Yii::$app->user->identity->id_usuario)*/ ?>

                              <?= Seguimientos::totalquedebenllegar(Yii::$app->user->identity->id_usuario) ?>
                          </div>
                           
                           <?php // Seguimientos::countQueDebenLlegar(1,Yii::app()->user->id_usuario)+Seguimientos::countQueDebenLlegar(0,Yii::app()->user->id_usuario)?>
                      </h5>
                      <h6 class="mes"><i class="glyphicon glyphicon-cloud-download fa-1x"></i> Que deben llegar</h6>
                      <!--<ul class="lista">
                        <li class="sublista"><i class="fa fa-eye fa-2x"></i></li>
                        <li class="sublista"><i class="fa fa-heart-o fa-2x"></i></li>
                        <li class="sublista"><i class="fa fa-envelope-o fa-2x"></i></li>
                        <li class="sublista"><i class="fa fa-share-alt fa-2x"></i></li>
                      </ul>-->
                      <hr class="linea">
                      <div class="fab"><i style="top:-6px; position: relative;" class="fa fa-arrow-right fa-3x"></i></div>
                </div>
                </a>    
            </div>
            <div class="col-lg-4">
                <a href="index.php?r=seguimientos/pendientesoficiales" style="text-decoration: none;">
                    <div class="card">
                        <div class="thumbnail" style="background-color: #2F3B6A;">
                          <i style="top:10px; position:relative;" class="glyphicon glyphicon-inbox fa-2x"></i>
                        </div>
                          <h5 class="numero">
                              <?=Seguimientos::countPendientes(1,1,Yii::$app->user->identity->id_usuario)?> 
                              <?php //=Seguimientos::countPendientes(1,1,Yii::app()->user->id_usuario)?> 
                          </h5>
                          <h6 class="mes">
                                <i class="glyphicon glyphicon-inbox fa-1x"></i> Pendientes Oficiales</h6>
                          <!--<ul class="lista">
                            <li class="sublista"><i class="fa fa-eye fa-2x"></i></li>
                            <li class="sublista"><i class="fa fa-heart-o fa-2x"></i></li>
                            <li class="sublista"><i class="fa fa-envelope-o fa-2x"></i></li>
                            <li class="sublista"><i class="fa fa-share-alt fa-2x"></i></li>
                          </ul>-->
                          <hr class="linea">
                          <div class="fab"><i style="top:-6px; position: relative;" class="fa fa-arrow-right fa-3x"></i></div>
                    </div>
                </a>     
            </div>
            <div class="col-lg-4">
                <a href="index.php?r=seguimientos/pendientescopias" style="text-decoration: none;">
                <div class="card">
                        <div class="thumbnail" style="background-color: #E73E3A;">
                          <i style="top:10px; position:relative;" class="fa fa-copy fa-2x"></i>
                        </div>
                          <h5 class="numero">
                             <?=Seguimientos::countPendientes(0,2,Yii::$app->user->identity->id_usuario)?>  
                          </h5>
                          <h6 class="mes"><i class="fa fa-copy fa-1x"></i> Copias Pendientes</h6>
                          <!--<ul class="lista">
                            <li class="sublista"><i class="fa fa-eye fa-2x"></i></li>
                            <li class="sublista"><i class="fa fa-heart-o fa-2x"></i></li>
                            <li class="sublista"><i class="fa fa-envelope-o fa-2x"></i></li>
                            <li class="sublista"><i class="fa fa-share-alt fa-2x"></i></li>
                          </ul>-->
                          <hr class="linea">
                          <div class="fab"><i style="top:-6px; position: relative;" class="fa fa-arrow-right fa-3x"></i></div>
                    </div>
                </a>      
            </div>
        </div>
        <hr style="width: 80%; opacity: 0.3;">
        
        
        <div class="row">
            <div class="col-lg-6">
                
                <div class="row">
                    <div class="col-lg-6">
                        
                        <!-- Home tab content -->
                            <div class="tab-pane" id="control-sidebar-home-tab">
                                <ul class='control-sidebar-menu'>
                                    <li class="btn btn-secondary btn-sm active" style="width:95%; text-align: left;" >
                                        <a href="index.php?r=site/menudocumentos" style="text-decoration: none;">
                                            
                                            <i class="menu-icon fa fa-file-text-o fa-1x bg-red"></i>

                                            <div class="menu-info">                                                
                                                    <h4 class="control-sidebar-subheading"><b>Generar Documentos</b></h4>
                                                <p>Crear nuevas Notas, Cartas, etc.</p>
                                            </div>
                                        </a>
                                    </li> 
                                    <li class="btn btn-secondary btn-sm active" style="width:95%; text-align: left;">
                                        <a href="index.php?r=hojasruta/reimprimirhojaruta" style="text-decoration: none;">
                                            <i class="menu-icon fa fa-newspaper-o bg-yellow"></i>

                                            <div class="menu-info">
                                                <h4 class="control-sidebar-subheading"><b>Reimprimir H.S.</b></h4>

                                                <p>Opci&oacute;n para reimprimir Hojas de Ruta</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="btn btn-secondary btn-sm active" style="width:95%; text-align: left;">
                                        <a href="index.php?r=seguimientos/corregirderivacion" style="text-decoration: none;">
                                            <i class="menu-icon fa fa-external-link bg-light-blue"></i>

                                            <div class="menu-info">
                                                <h4 class="control-sidebar-subheading"><b>Corregir Derivaci&oacute;n</b></h4>

                                                <p>Cambiar y restaurar derivaci&oacute;n</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="btn btn-secondary btn-sm active" style="width:95%; text-align: left;">
                                        <a href="index.php?r=usuarios/listaderivacion" style="text-decoration: none;">
                                            <i class="menu-icon fa fa-list bg-green"></i>

                                            <div class="menu-info">
                                                <h4 class="control-sidebar-subheading"><b>Lista Derivaci&oacute;n</b></h4>

                                                <p>Añadir destinatarios para derivar</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="btn btn-secondary btn-sm active" style="width:95%; text-align: left;">
                                        <a href="index.php?r=seguimientos/pendientesusuarioexcel&id=<?=Yii::$app->user->identity->id_usuario?>" style="text-decoration: none;">
                                            
                                            <i class="menu-icon fa fa-file-excel-o bg-red"></i>

                                            <div class="menu-info">
                                                <h4 class="control-sidebar-subheading"><b>Pendientes en EXCEL</b></h4>

                                                <p>Generar pendientes en EXCEL</p>
                                            </div>
                                        </a>
                                    </li>
                                    
                                    <?php if( (Yii::$app->user->identity->fk_nivel==1) || (Yii::$app->user->identity->fk_nivel==3)) { ?>
                                    <li class="btn btn-secondary btn-sm active" style="width:95%; text-align: left;">
                                        <a  href="index.php?r=usuarios/pendientesusuario" style="text-decoration: none;">
                                            <i class="menu-icon fa fa-file-code-o bg-yellow"></i>

                                            <div class="menu-info">
                                                <h4 class="control-sidebar-subheading"><b>Pendientes por &Aacute;rea/Unidad</b></h4>

                                                <p>Reporte de pendientes por &Aacute;rea</p>  
                                            </div>
                                        </a>
                                    </li>
                                    <?php } ?>
                                    
                                    <li class="btn btn-secondary btn-sm active" style="width:95%; text-align: left;">
                                        <a  href="index.php?r=seguimientos/actasrecepcion" style="text-decoration: none;">
                                            <i class="menu-icon fa fa-file-code-o bg-light-blue"></i>

                                            <div class="menu-info">
                                                <h4 class="control-sidebar-subheading"><b>Actas de Recepci&oacute;n</b></h4>

                                                <p>Reporte de NUR/NURIs derivados</p>  
                                            </div>
                                        </a>
                                    </li>


                                    <?php if( (Yii::$app->user->identity->fk_nivel==1) || (Yii::$app->user->identity->fk_nivel==3)) { ?>
                                    <li class="btn btn-secondary btn-sm active" style="width:95%; text-align: left;">
                                        <a  href="index.php?r=seguimientos/actasrecepciongeneral" style="text-decoration: none;">
                                            <i class="menu-icon fa fa-file-o bg-green"></i>

                                            <div class="menu-info">
                                                <h4 class="control-sidebar-subheading"><b>Actas de Recepci&oacute;n general</b></h4>

                                                <p>Reporte de NUR/NURIs derivados</p>  
                                            </div>
                                        </a>
                                    </li>
                                    <?php } ?>


                                </ul>


                            </div>
                            <!-- /.tab-pane -->
                    </div>
                    <div class="col-lg-6">
                        <!-- Home tab content -->
                            <div class="tab-pane" id="control-sidebar-home-tab">
                                <ul class='control-sidebar-menu'>
                                    <li class="btn btn-secondary btn-sm active" style="width:95%; text-align: left;" >
                                        <a  href="index.php?r=documentos/documentossinnuri" style="text-decoration: none;">
                                            <i class="menu-icon fa fa-edit bg-red"></i>

                                            <div class="menu-info">
                                                <h4 class="control-sidebar-subheading"><b>Documentos sin NURI</b></h4>

                                                <p>Lista de documentos sin NURI</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="btn btn-secondary btn-sm active" style="width:95%; text-align: left;">
                                        <a  href="index.php?r=seguimientos/admindesagrupar" style="text-decoration: none;">
                                            
                                            <i class="menu-icon fa fa-exchange bg-yellow"></i>

                                            <div class="menu-info">
                                                <h4 class="control-sidebar-subheading"><b>Desagrupar NURI(s)</b></h4>

                                                <p>Desagrupar NURIs agrupados</p>
                                            </div>
                                        </a>
                                    </li>
                                    <?php if( (Yii::$app->user->identity->fk_nivel==1) || (Yii::$app->user->identity->fk_nivel==3)) { ?>
                                    <li class="btn btn-secondary btn-sm active" style="width:95%; text-align: left;">
                                        <a href='index.php?r=archivo/index'>
                                            <i class="menu-icon fa fa-folder-open-o bg-light-blue"></i>

                                            <div class="menu-info">
                                                <h4 class="control-sidebar-subheading"><b>Archivo - SAC</b></h4>

                                                <p>Modulo para archivo de tr&aacute;mites</p>
                                            </div>
                                        </a>
                                    </li>
                                    
                                    <li class="btn btn-secondary btn-sm active" style="width:95%; text-align: left;">
                                        <a  href="index.php?r=site/menucites" style="text-decoration: none;">
                                            <i class="menu-icon fa fa-newspaper-o bg-green"></i>

                                            <div class="menu-info">
                                                <h4 class="control-sidebar-subheading"><b>CITEs Generados</b></h4>

                                                <p>Documentos generados en total</p>
                                            </div>
                                        </a>
                                    </li>


                                    <li class="btn btn-secondary btn-sm active" style="width:95%; text-align: left;">
                                        <a  href="index.php?r=seguimientos/resumenpendientes" style="text-decoration: none;">
                                            <i class="menu-icon fa fa-newspaper-o bg-yellow"></i>

                                            <div class="menu-info">
                                                <h4 class="control-sidebar-subheading"><b>Resumen de Pendientes</b></h4>
                                                <p>Documentos generados en total</p>
                                            </div>
                                        </a>
                                    </li>

                                    <?php } ?>
                                    <li class="btn btn-secondary btn-sm active" style="width:95%; text-align: left;">
                                        <a href="index.php?r=site/menubusqueda" style="text-decoration: none;">
                                            <i class="menu-icon fa fa-search-plus bg-red"></i>

                                            <div class="menu-info">
                                                <h4 class="control-sidebar-subheading"><b>B&uacute;squeda</b></h4>

                                                <p>B&uacute;squeda de tr&aacute;mites y documentos</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="btn btn-secondary btn-sm active" style="width:95%; text-align: left;">
                                        <a  href="index.php?r=hojasruta/tramitessinderivar" style="text-decoration: none;">
                                            <i class="menu-icon fa fa-file-code-o bg-yellow"></i>

                                            <div class="menu-info">
                                                <h4 class="control-sidebar-subheading"><b>Tr&aacute;mites sin Derivar</b></h4>

                                                <p>NUR/NURI sin derivar o confirmar por sistema</p>  
                                            </div>
                                        </a>
                                    </li>
                                </ul>


                            </div>
                            <!-- /.tab-pane -->
                    </div>
                </div>    


            <?php
                $array= \app\models\Documentos::getDocumentosporTipo();
                //print_r($array);
            ?>    
                
            </div>
            <div class="col-lg-6" >
                <?=Highcharts::widget([
                        'options'=>'{
                            "chart": {
                                "backgroundColor": "rgba(236, 240, 245, 0)",
                                "plotBackgroundColor": null,
                                "plotBorderWidth": null,
                                "plotShadow": false,
                                "width": "500",
                                
                                "options3d":{"enabled":true,
                                                "alpha":45,
                                                "beta":20
                                             }  
                            },
                            "colors": ["#DDDF00", "#50B432", "#24CBE5", "#64E572", "#FF9655", "#FFF263", "#6AF9C4","#058DC7","#ED561B"],
                            "title": {
                                "text": "<b>POR TIPO DE DOCUMENTO GESTIÓN '.date('Y').'</b>"
                            },
                            "tooltip": {
                                "pointFormat": "{series.name}: <b>{point.percentage:.1f}%</b>"
                            },
                            "plotOptions": {
                                "pie": {
                                    "allowPointSelect": true,
                                    "cursor": "pointer",
                                    "dataLabels": {
                                        "enabled": true,
                                        "color": "#000000",
                                        "connectorColor": "#000000",
                                        "format": "<b>{point.name}</b>: {point.percentage:.1f} %"
                                    }
                                }
                            },
                            "series": [{
                        "type": "pie",
                               "name": "Registro:",
                                "data":  
                                        '.json_encode($array).'
                                                
                                }]
                        }'
                    ]);
                    
               // print_r($array);
               // echo "<br>";
               // print_r(json_encode($array));
                ?>
                
                <br><br>
                
               
               
            </div>
           
        </div>

    </div>
</div>
<!--
<button type="button" class="btn btn-primary">Primary</button>
<button type="button" class="btn btn-secondary">Secondary</button>
<button type="button" class="btn btn-success">Success</button>
<button type="button" class="btn btn-danger">Danger</button>
<button type="button" class="btn btn-warning">Warning</button>
<button type="button" class="btn btn-info">Info</button>



<button type="button" class="btn btn-light">Light</button>
<button type="button" class="btn btn-dark">Dark</button>
<button type="button" class="btn btn-link">Link</button>

<a href="#" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Primary link</a>
<a href="#" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Link</a> -->


<?php 

/*
use kartik\alert\Alert;

echo Alert::widget([
	'type' => Alert::TYPE_INFO,
	'title' => 'Note',
	'titleOptions' => ['icon' => 'info-sign'],
	'body' => 'This is an informative alert'
]); */


if((Seguimientos::getcountnorecibidos(Yii::$app->user->identity->id_usuario)>0 )|| (Seguimientos::getcountpendientes(Yii::$app->user->identity->id_usuario)>0) )

echo Growl::widget([
        'type' => Growl::TYPE_GROWL,
        'title' => '<b>PENDIENTES Y NO RECIBIDOS</b>',
        'icon' => 'glyphicon glyphicon-ok-circle',
        //'body' => 'You successfully read this important alert message.',
        'body' => $this->render('pendientesusuario'),
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
