<?php
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use miloschuman\highcharts\Highcharts;
/* @var $this yii\web\View */

use app\models\Seguimientos;
use app\models\Regionales;

use kartik\tabs\TabsX;
use yii\helpers\Url;

$this->title = '';
?>
<?php //echo "--------> ".Yii::$app->request->baseUrl ?>

<link href="<?= Yii::$app->request->baseUrl ?>/css/estilos.css" rel="stylesheet" type="text/css">
<div class="site-index">

    <center>
        <span style="font-size: 16pt;"><b>MENU DE ADMINISTRACI&Oacute;N</b></span><br>
    </center><br>    
 
    <div class="body-content">


<hr style="width: 80%; opacity: 0.5;">
<center>
<table style='border: solid 0px red;'>
    <tr>
        <td>
            <?=Html::a("<i style='font-size:17pt;' class='fa fa-archive'></i> <br>Desarchivar<br>NUR/NURIs", ['archivo/desarchivartramites'], ['class' => 'btn btn-danger', ]);?>
        
            <?="&nbsp;".Html::a("<i style='font-size:17pt;' class='glyphicon glyphicon-transfer'></i> <br>Desagrupar<br>NUR/NURIs", ['agrupaciones/desagrupartramites'], ['class' => 'btn btn-primary', ]);?>
        
            <?="&nbsp;".Html::a("<i style='font-size:17pt;' class='glyphicon glyphicon-saved'></i> <br>Confirmar<br>Derivaci&oacute;n", ['seguimientos/adminconfirmarderivacion'], ['class' => 'btn btn-success active', ]);?>
        
            <?php //="&nbsp;".Html::a("<i style='font-size:17pt;' class='fa fa-undo'></i> <br>Reestablecer<br>Derivaci&oacute;n", ['niveles/index'], ['class' => 'btn btn-warning', ]);?>
            
            <?php //="&nbsp;".Html::a("<i style='font-size:17pt;' class='glyphicon glyphicon-sort-by-alphabet'></i> <br>Estado <br>Seguimiento", ['estados/index'], ['class' => 'btn btn-danger active', ]);?>
        
            <?php //="&nbsp;".Html::a("<i style='font-size:17pt;' class='glyphicon glyphicon-indent-left'></i> <br>Acción<br>Seguimiento", ['acciones/index'], ['class' => 'btn btn-warning active', ]);?>
        
            <?php //="&nbsp;".Html::a("<i style='font-size:17pt;' class='glyphicon glyphicon-user'></i> <br>&nbsp;Perfil de&nbsp;<br> Usuario", ['perfiles/index'], ['class' => 'btn btn-primary active', ]);?>
        
        </td>
    </tr>
    <tr>
        <td></td>
    </tr>
</table>
</center>    
<?php echo yii2mod\tree\Tree::widget([
            'items' => [
                ['title' => 'Category 1'],
                ['title' => 'Category 2'],
                [
                    'title' => 'Category 3',
                    'children' => [
                        [
                            'title' => 'Category 3.1',
                        ],
                        [
                            'title' => 'Category 3.2',
                            'children' => [
                                [
                                    'title' => 'Category 3.2.1',
                                ]
                            ],
                            'folder' => true,
                        ],
                    ],
                    'folder' => true,
                ],

            ],
            'clientOptions' => [
                'autoCollapse' => true,
                'clickFolderMode' => 3,
                'activate' => new \yii\web\JsExpression('
                        function(node, data) {
                              node  = data.node;
                              // Log node title
                              console.log(node.title);
                        }
                '),
            ],
        ]); ?>
<?php
/*

use kartik\tree\TreeView;
echo TreeView::widget([
    // single query fetch to render the tree
    'query'             => Regionales::find()->addOrderBy('id_regional, regional'), 
    'headingOptions'    => ['label' => 'Categories'],
    'isAdmin'           => false,                       // optional (toggle to enable admin mode)
    'displayValue'      => 1,                           // initial display value
    //'softDelete'      => true,                        // normally not needed to change
    //'cacheSettings'   => ['enableCache' => true]      // normally not needed to change
]);



echo \kartik\tree\TreeView::widget([
    'query' => Regionales::find()->addOrderBy('id_regional, regional'),
    'headingOptions' => ['label' => 'Store'],
    'rootOptions' => ['label'=>'<span class="text-primary">Products</span>'],
    'topRootAsHeading' => true, // this will override the headingOptions
    'fontAwesome' => true,
    'isAdmin' => true,
    'iconEditSettings'=> [
        'show' => 'list',
        'listData' => [
            'folder' => 'Folder',
            'file' => 'File',
            'mobile' => 'Phone',
            'bell' => 'Bell',
        ]
    ],
    'softDelete' => true,
    'cacheSettings' => ['enableCache' => true]
]);
*/