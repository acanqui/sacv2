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
        <span style="font-size: 16pt;"><b>MENU DE OPCIONES</b></span><br>
    </center><br>    
 
    <div class="body-content">
<!--

<figure class="snip1578"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/profile-sample4.jpg" alt="profile-sample4" />
  <figcaption>
    <h3>Hans Down</h3>
    <div class="icons"><a href="#"><i class="ion-social-twitter"></i></a>
      <a href="#"> <i class="ion-social-instagram-outline"></i></a>
      <a href="#"> <i class="ion-social-github"></i></a>
    </div>
  </figcaption>
</figure>


   
        
        
    </div>
</div>


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
<a href="#" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Link</a>
-->

<hr style="width: 80%; opacity: 0.5;">
<center>
<table style='border: solid 0px red;'>
    <tr>
        <td style="text-align: center; font-size: 14pt;"><b>PAR&Aacute;METROS</b><br></td>
    </tr>
    
    <tr>
        <td>
            <?=Html::a("<i style='font-size:17pt;' class='fa fa-map-marker'></i> <br>Oficina<br>&nbsp;Regional&nbsp;", ['regionales/index'], ['class' => 'btn btn-danger', ]);?>
        
            <?="&nbsp;".Html::a("<i style='font-size:17pt;' class='fa fa-sitemap'></i> <br>Área<br>&nbsp;&nbsp;Unidad&nbsp;&nbsp;", ['areas/index'], ['class' => 'btn btn-info active', ]);?>
        
            <?="&nbsp;".Html::a("<i style='font-size:17pt;' class='fa fa-copy'></i> <br>Estado<br>Documento", ['estadodocumento/index'], ['class' => 'btn btn-primary', ]);?>
        
            <?="&nbsp;".Html::a("<i style='font-size:17pt;' class='fa fa-file-text'></i> <br>Tipo<br>Documento", ['tipodocumento/index'], ['class' => 'btn btn-success active', ]);?>
        
            <?="&nbsp;".Html::a("<i style='font-size:17pt;' class='fa fa-group'></i> <br>Niveles de<br>Usuario", ['niveles/index'], ['class' => 'btn btn-warning', ]);?>
            
            <?="&nbsp;".Html::a("<i style='font-size:17pt;' class='glyphicon glyphicon-sort-by-alphabet'></i> <br>Estado <br>Seguimiento", ['estados/index'], ['class' => 'btn btn-danger active', ]);?>
        
            <?="&nbsp;".Html::a("<i style='font-size:17pt;' class='glyphicon glyphicon-indent-left'></i> <br>Acción<br>Seguimiento", ['acciones/index'], ['class' => 'btn btn-warning active', ]);?>
        
            <?="&nbsp;".Html::a("<i style='font-size:17pt;' class='glyphicon glyphicon-user'></i> <br>&nbsp;Perfil de&nbsp;<br> Usuario", ['perfiles/index'], ['class' => 'btn btn-primary active', ]);?>
        
        </td>
    </tr>
    <tr>
        <td></td>
    </tr>
</table>
</center>    