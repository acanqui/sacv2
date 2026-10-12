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

?>
<?php //echo "--------> ".Yii::$app->request->baseUrl ?>

<link href="<?= Yii::$app->request->baseUrl ?>/css/estilos.css" rel="stylesheet" type="text/css">
<div class="site-index">

    <center>
        <span style="font-size: 22pt;"><b>Documentos S.A.C.</b></span><br>
    </center><br>    
    
    <center>
        <span style="font-size:15pt;">
            <span class="fa fa-file-pdf-o" style="font-size: 26pt;"></span>
            Documentos generados por <b style="color:#A72F3B;"><?=$model->area?></b>.
        </span><br>
        <?= Html::a('<i class="glyphicon glyphicon-hand-left" style="font-size:16pt;" ></i> Atras', ['areas/areasarchivo'], ['class' => 'btn btn-danger active']) ?>
    </center><br>    
 
<div class="body-content">

<?php 

$items = [
    
        [
        'label'=>'<i class="fa fa-file-pdf-o"></i> Doc. '.date('Y'),
        //'content'=>$content1,
        'content'=>$this->render('documentosarchivo', ['gestion'=>date('Y'), 'id_area'=>$model->id_area]),
        'active'=>true,
        //'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/site/documentosdata'])]
        ],
    
        [
        'label'=>'<i class="fa fa-file-word-o"></i> Doc. '.(date('Y')-1),
        //'content'=>$content1,
        'content'=>$this->render('documentosarchivo', ['gestion'=>(date('Y')-1), 'id_area'=>$model->id_area]),
        //'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/site/documentosdata'])]
        ],
    
        [
        'label'=>'<i class="fa fa-file-excel-o"></i> Doc. '.(date('Y')-2),
        //'content'=>$content1,
        'content'=>$this->render('documentosarchivo', ['gestion'=>(date('Y')-2), 'id_area'=>$model->id_area]),
        //'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/site/documentosdata'])]
        ],
        
        [
        'label'=>'<i class="fa fa-file-excel-o"></i> Doc. '.(date('Y')-3),
        //'content'=>$content1,
        'content'=>$this->render('documentosarchivo', ['gestion'=>(date('Y')-3), 'id_area'=>$model->id_area]),
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
    # Acceder a la colección contactos
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