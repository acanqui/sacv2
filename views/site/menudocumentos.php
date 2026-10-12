<?php
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use miloschuman\highcharts\Highcharts;
/* @var $this yii\web\View */

use app\models\Seguimientos;
use app\models\Documentos;

use kartik\tabs\TabsX;
use yii\helpers\Url;

$this->title = '';


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
<?php //echo "--------> ".Yii::$app->request->baseUrl ?>

<link href="<?= Yii::$app->request->baseUrl ?>/css/estilos.css" rel="stylesheet" type="text/css">
<div class="site-index">

    <center>
        <span style="font-size: 24pt;"><b>Documentos S.A.C.</b></span><br>
        <span style="font-size: 16pt;">Opciones para <b style="color:#A72F3B;">nuevos</b> documentos.</span>
    </center><br>    
 
<div class="body-content">

   
<center>        
<a href="index.php?r=documentos/createcarta" style="text-decoration: none;">        
    <figure class="snip1578" style="background:#A63738; color:white;">
      <img src="<?= Yii::$app->request->baseUrl ?>/images/carta.png" alt="profile-sample4" />  
      <!--<span class="fa fa-file-excel-o" alt="profile-sample6"></span>-->
      <figcaption>
        <br> <br>
        <h3>Carta</h3>
      </figcaption>
    </figure>
</a>
        
<a href="index.php?r=documentos/createnotainterna" style="text-decoration: none;">        
    <figure class="snip1578" style="background:#1F9397; color:white;">
      <img src="<?= Yii::$app->request->baseUrl ?>/images/nota.png" alt="profile-sample4" />  
      <!--<span class="fa fa-file-pdf-o" alt="profile-sample6"></span>-->
      <figcaption>
        <br> 
        <h3>Nota Interna</h3>
      </figcaption>
    </figure>
</a>

<a href="index.php?r=documentos/createinforme" style="text-decoration: none;">        
    <figure class="snip1578" style="background:#CD6E16; color:white;">
      <img src="<?= Yii::$app->request->baseUrl ?>/images/informe.png" alt="profile-sample4" />    
      <!--<span class="fa fa-file-powerpoint-o" alt="profile-sample6"></span>-->
      <figcaption>
        <br><br> 
        <h3>Informe</h3>
      </figcaption>
    </figure>
</a>
        
<a href="index.php?r=documentos/createcircular" style="text-decoration: none;">        
    <figure class="snip1578" style="background:#17195E; color:white;">
      <img src="<?= Yii::$app->request->baseUrl ?>/images/circular.png" alt="profile-sample4" />    
      <!--<span class="fa fa-file-word-o" alt="profile-sample6"></span>-->
      <figcaption>
        <br> <br>
        <h3>Circular</h3>
      </figcaption>
    </figure>
</a>

<a href="index.php?r=documentos/creatememorandum" style="text-decoration: none;">        
    <figure class="snip1578" style="background:#085A32; color:white;">
        <img src="<?= Yii::$app->request->baseUrl ?>/images/memorando.png" alt="profile-sample4" />    
      <!--<span class="fa fa-file-image-o" alt="profile-sample6"></span>-->
      <figcaption>
        <br> <br>
        <h3>Memorando</h3>
      </figcaption>
    </figure>
</a>     
        
<a href="index.php?r=documentos/createinstructivo" style="text-decoration: none;">        
    <figure class="snip1578" style="background:#4C085A; color:white;">
      <img src="<?= Yii::$app->request->baseUrl ?>/images/instructivo.png" alt="profile-sample4" />    
      <!--<span class="fa fa-file-movie-o" alt="profile-sample6"></span>-->
      <figcaption>
        <br> <br>
        <h3>Instructivo</h3>
      </figcaption>
    </figure>
</a>        

</center>    
    
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
        'content'=>$this->render('documentos', ['gestion'=>date('Y')]),
        'active'=>true,
        //'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/site/documentosdata'])]
        ],
    
        [
        'label'=>'<i class="fa fa-file-word-o"></i> Doc. '.(date('Y')-1),
        //'content'=>$content1,
        'content'=>$this->render('documentos', ['gestion'=>date('Y')-1]),
        //'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/site/documentosdata'])]
        ],
    
        [
        'label'=>'<i class="fa fa-file-excel-o"></i> Doc. '.(date('Y')-2),
        //'content'=>$content1,
        'content'=>$this->render('documentos', ['gestion'=>date('Y')-2]),
        //'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/site/documentosdata'])]
        ],
        
        [
        'label'=>'<i class="fa fa-file-excel-o"></i> Doc. '.(date('Y')-3),
        //'content'=>$content1,
        'content'=>$this->render('documentos', ['gestion'=>date('Y')-3]),
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


<?php 


/*
// CODIGO PARA MIGRAR INFORMACION DE POSTGRES A MONGO DB

if(Yii::$app->user->identity->fk_perfil==1){

    echo "administrador";

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


    
    # Acceder a la colección documentos
    $coleccion = $baseDeDatos->documentos;



    $dataReader=Documentos::consulta_documentos();
    foreach($dataReader as $row){
        
        
        //echo "<br> --> ".$row['codigo']." ".$row['contenido'];

        $resultado = $coleccion->insertOne([
            "id_hoja_ruta" => $row['id_hoja_ruta'],
            "id_documento" => $row['id_documento'],
            "nuri" => $row['nuri'],
            "tipo_tramite" => $row['tipo_tramite'],
            "cite" => $row['cite'],
            "nombre_destino" => $row['nombre_destino'],
            "cargo_destino" => $row['cargo_destino'],
            "nombre_via" => $row['nombre_via'],
            "cargo_via" => $row['cargo_via'],
            "fecha" => $row['fecha'],
            "referencia" => $row['referencia'],
            "contenido" => $row['contenido'],
            "nombre_remitente" => $row['nombre_remitente'],
            "cargo_remitente" => $row['cargo_remitente'],
            "institucion_remitente" => $row['institucion_remitente'],
            "adjuntos" => $row['adjuntos'],
            "copias" => $row['copias'],
            "nro_hojas" => $row['nro_hojas'],
            "tipo_documento" => $row['tipo_documento'],
            "estado_documento" => $row['estado_documento'],
            "area" => $row['area'],
            "gestion" => $row['gestion'],
        ]);
    
    } 



}
*/






/*
$result = $baseDeDatos->documentos->find(array(
    'contenido' => new \MongoDB\BSON\Regex("EECGNV"),
)); */
//'contenido' => new \MongoDB\BSON\Regex("/.*AMPLI.*/")



/*
// CODIGO PARA UPDATE EN DOCUMENTO MONGO DB
$updateResult = $baseDeDatos->documentos->updateOne(
   [ 'id_documento' => 28 ],
   [ '$set' => [ 'contenido' => 'Una clase Active Record es asociada con una tabla de base de datos, una instancia Active Record corresponde a una fila de esa tabla, y un atributo de una instancia Active Record representa el valor de una columna particular en esa fila. En vez de escribir declaraciones SQL crudas, podrías acceder atributos Active Record y llamar métodos Active Record para acceder y manipular la información almacenada en tablas de base.' ]]
);
*/

/*
// LIKE PARA MONGO DB
$result = $baseDeDatos->documentos->find(array('$or' => array(
            array('contenido' => new \MongoDB\BSON\Regex("SISTEMA"),),
            array('referencia' => new \MongoDB\BSON\Regex("SISTEMA"),),
            array('cite' => new \MongoDB\BSON\Regex("SISTEMA"),),
            
)));


foreach ($result as $entry) {
    echo $entry['id_documento']." ===>";
    echo $entry['nuri'], ': ', $entry['cite'];
    echo $entry['_id'], ': ', $entry['adjuntos'], "\n<br>";
    
}
*/