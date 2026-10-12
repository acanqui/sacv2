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
        <span style="font-size: 19pt;"><b>CITES asignados por el &Aacute;rea/Unidad "<?=Yii::$app->user->identity->fkArea->area?>" </b></span><br>
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
-->        

<?php 
/*$content1="Raw denim you probably haven't heard of them jean shorts Austin. .";
$content2="Nesciunt tofu stumptown aliqua, retro synth master cleanse. ";
$content3="Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth.";
$content4="Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui";
*/

$items = [
    
        [
        'label'=>'<i class="fa fa-file-pdf-o"></i> Doc. '.date('Y'),
        //'content'=>$content1,
        'content'=>$this->render('documentoscites', ['gestion'=>date('Y')]),
        'active'=>true,
        //'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/site/documentosdata'])]
        ],
    
        [
        'label'=>'<i class="fa fa-file-word-o"></i> Doc. '.(date('Y')-1),
        //'content'=>$content1,
        'content'=>$this->render('documentoscites', ['gestion'=>date('Y')-1]),
        //'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/site/documentosdata'])]
        ],
    
        [
        'label'=>'<i class="fa fa-file-excel-o"></i> Doc. '.(date('Y')-2),
        //'content'=>$content1,
        'content'=>$this->render('documentoscites', ['gestion'=>date('Y')-2]),
        //'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/site/documentosdata'])]
        ],

        [
        'label'=>'<i class="fa fa-file-excel-o"></i> Doc. '.(date('Y')-3),
        //'content'=>$content1,
        'content'=>$this->render('documentoscites', ['gestion'=>date('Y')-3]),
        //'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/site/documentosdata'])]
        ],
    
/*    [
        'label'=>'<i class="fa fa-user"></i> Profile',
        'content'=>$this->render('documentos', ['gestion'=>2021]),
        //'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/site/tabs-data'])]
        //'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=2'])]
    ],
   [
        'label'=>'<i class="fa fa-list-alt"></i> Menu',
        'items'=>[
             [
                 'label'=>'<i class="fa fa-chevron-right"></i> Option 1',
                 'encode'=>false,
                 'content'=>$content3,
                 'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=3'])]
             ],
             [
                 'label'=>'<i class="fa fa-chevron-right"></i> Option 2',
                 'encode'=>false,
                 'content'=>$content4,
                 'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=4'])]
             ],
        ],
    ], */
];


// Left
echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_LEFT,
    'bordered'=>true,
    'encodeLabels'=>false
]);


?>

        
        
        
        
        
        
        
        
        
        
        
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