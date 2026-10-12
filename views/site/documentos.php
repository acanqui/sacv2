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

    <center>
        <span style="font-size:15pt;">
            <span class="fa fa-file-pdf-o" style="font-size: 26pt;"></span>
            Documentos generados por <b style="color:#A72F3B;"><?=Yii::$app->user->identity->nombre?></b> gesti&oacute;n <b><?=$gestion?></b>.
        </span>
    </center><br>    
 
<div class="body-content">
<center>  
<?php 
echo Html :: a ('
            <span class="btn btn-sm btn-primary" style="font-size:13pt;">
            <span class="fa fa-file-pdf-o"></span> Cartas</span>'
            , ['documentos/admintipo', 'gestion'=>$gestion, 'tipo'=>4], [
                    'class' => 'data-update',
          ]);

echo Html :: a ('
            <span class="btn btn-sm btn-primary" style="font-size:13pt;">
            <span class="fa fa-file-powerpoint-o"></span> Notas Internas</span>'
            , ['documentos/admintipo', 'gestion'=>$gestion, 'tipo'=>2], [
                    'class' => 'data-update',
          ]);

echo Html :: a ('
            <span class="btn btn-sm btn-primary" style="font-size:13pt;">
            <span class="fa fa-file-word-o"></span> Informes</span>'
            , ['documentos/admintipo', 'gestion'=>$gestion, 'tipo'=>1], [
                    'class' => 'data-update',
          ]);

echo Html :: a ('
            <span class="btn btn-sm btn-primary" style="font-size:13pt;">
            <span class="fa fa-file-image-o"></span> Circulares</span>'
            , ['documentos/admintipo', 'gestion'=>$gestion, 'tipo'=>5], [
                    'class' => 'data-update',
          ]);

echo Html :: a ('
            <span class="btn btn-sm btn-primary" style="font-size:13pt;">
            <span class="fa fa-file-excel-o"></span> Memorandos</span>'
            , ['documentos/admintipo', 'gestion'=>$gestion, 'tipo'=>3], [
                    'class' => 'data-update',
          ]);

echo Html :: a ('
            <span class="btn btn-sm btn-primary" style="font-size:13pt;">
            <span class="fa fa-file-movie-o"></span> Instructivos</span>'
            , ['documentos/admintipo', 'gestion'=>$gestion, 'tipo'=>8], [
                    'class' => 'data-update',
          ]);

?>

</center>      
    
         
</div>
</div>