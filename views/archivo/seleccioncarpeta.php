<?php

use yii\helpers\Html;

use kartik\tabs\TabsX;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Archivo */

//$this->title = 'Create Archivo';
$this->params['breadcrumbs'][] = ['label' => 'Archivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Carpeta ';




use kartik\widgets\Growl;
if (Yii::$app->session->getFlash('success')){
    echo Growl::widget([
        'type' => Growl::TYPE_SUCCESS,
        'title' => '<b>REGISTRO CORRECTO</b>',
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
    'title' => '<b>ERROR DE REGISTRO</b>',
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



<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="fa fa-archive" style="font-size:25pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 18pt;">Archivar tr&aacute;mite <?=$seguimientos->codigo?></u></b>
          </h5>
        </div>
    </div>
    <div class="col-md-6">
    </div>
</div>
<br>


<link href="<?= Yii::$app->request->baseUrl ?>/css/estilos.css" rel="stylesheet" type="text/css">
<div class="site-index">

    <center>
        <span style="font-size: 16pt;">Seleccione <b style="color:#A72F3B;">Carpeta</b> para archivo.</span>
    </center><br>    
 
<div class="body-content">
<center>        
<?php 

$dataReader= app\models\Archivo::getListcarpetas();
$i=0;

foreach ($dataReader as $row){
$i++;    

/*    if($i>5){
        echo "<br>";
        $i=1;
    }   */ 
    
?>

<!-- CODIGO PARA COLORES RANDOM-->
<?php //printf("#%06X\n", mt_rand( 0, 0xFFFFFF ))?>
<?php //echo $i;?>



        <a href="index.php?r=archivo/createarchivo&id_seguimiento=<?=$seguimientos->id_seguimiento?>&id_carpeta=<?=$row['id_carpeta_archivo']?>" style="text-decoration: none;">        
            <figure class="snip1578" style="background:#D0DBE6; color:white;  max-width: 270px;">
                <!--<span class="fa fa-folder-open-o" alt="profile-sample4" style="font-size:30pt; text-align: right;"></span>-->
                      <figcaption style="width: 290px;">
                          
                        <center>
                          <h3 style="font-size: 14.5pt; color:black;"><li class="fa fa-folder-open-o" style="font-size:15pt;"></li> <?=$row['nombre_carpeta']?></h3>
                        </center>    
                      </figcaption>
            </figure>
        </a>
    
<?php 
    
    //echo "<br> ==> ".$row['nombre_carpeta'];
    
} // end foreach


?>    
    
    <?php //printf( "#%06X\n", mt_rand( 0, 0xFFFFFF )); ?>

    
 <hr style="width: 80%; opacity: 0.3;">       
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
-->        

       
        
        
        
        
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

