<?php
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use miloschuman\highcharts\Highcharts;
/* @var $this yii\web\View */

use app\models\Seguimientos;

use kartik\tabs\TabsX;
use yii\helpers\Url;

$this->title = '';
?>
<?php //echo "--------> ".Yii::$app->request->baseUrl ?>

<link href="<?= Yii::$app->request->baseUrl ?>/css/estilos.css" rel="stylesheet" type="text/css">
<div class="site-index">

    
 
<div class="body-content">
<center>  
<?php 
echo Html :: a ('
            <span class="btn btn-sm btn-primary" style="font-size:13pt;">
            <span class="fa fa-file-pdf-o"></span> Cartas</span>'
            , ['documentos/reportecitearchivo', 'id_area'=>$id_area, 'tipo'=>4, 'gestion'=>$gestion,], [    
                    'class' => 'data-update',
          ]);

echo Html :: a ('
            <span class="btn btn-sm btn-primary" style="font-size:13pt;">
            <span class="fa fa-file-powerpoint-o"></span> Notas Internas</span>'
            , ['documentos/reportecitearchivo', 'id_area'=>$id_area, 'tipo'=>2, 'gestion'=>$gestion,], [    
                    'class' => 'data-update',
          ]);

echo Html :: a ('
            <span class="btn btn-sm btn-primary" style="font-size:13pt;">
            <span class="fa fa-file-word-o"></span> Informes</span>'
            , ['documentos/reportecitearchivo', 'id_area'=>$id_area, 'tipo'=>1, 'gestion'=>$gestion,], [    
                    'class' => 'data-update',
          ]);

echo Html :: a ('
            <span class="btn btn-sm btn-primary" style="font-size:13pt;">
            <span class="fa fa-file-image-o"></span> Circulares</span>'
            , ['documentos/reportecitearchivo', 'id_area'=>$id_area, 'tipo'=>5, 'gestion'=>$gestion,], [    
                    'class' => 'data-update',
          ]);

echo Html :: a ('
            <span class="btn btn-sm btn-primary" style="font-size:13pt;">
            <span class="fa fa-file-excel-o"></span> Memorandos</span>'
            , ['documentos/reportecitearchivo', 'id_area'=>$id_area, 'tipo'=>3, 'gestion'=>$gestion,], [    
                    'class' => 'data-update',
          ]);

echo Html :: a ('
            <span class="btn btn-sm btn-primary" style="font-size:13pt;">
            <span class="fa fa-file-movie-o"></span> Instructivos</span>'
            , ['documentos/reportecitearchivo', 'id_area'=>$id_area, 'tipo'=>8, 'gestion'=>$gestion,], [
                    'class' => 'data-update',
          ]);

?>

</center>      
    
         
</div>
</div>
