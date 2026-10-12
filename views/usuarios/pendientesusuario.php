<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = 'Pendientes por área';
?>

<br>
<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="fa fa-users" style="font-size:30pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 18pt;">Pendientes por &Aacute;rea/Unidad</u></b>
          </h5>
        </div>
    </div>
</div>
<br>
<style>
.grid-view table thead {
    background-color: #B8C7CD;
}

.grid-view table thead a {
    color: #222D32;
}


</style>

<div class="usuarios-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-print"></span> Reporte General PDF', ['seguimientos/pendientesareapdf'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions'=> ['class'=>'table table-striped table-bordered table-hover'],
        
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
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
             'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],   
            ],
            
            
        

            //'id_usuario',
            [
                'label'=>'Nombre completo',
                'attribute'=>'nombre',
                'value'=>'nombre',
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            
            [
                'label'=>'Cargo',
                'attribute'=>'cargo',
                'value'=>'cargo',
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            //'nombre',
            //'cargo',
            //'usuario',
            //'password',
            //'correo',
            //'mosca',
            //'fk_perfil',
            //'fk_regional',
            //'fk_area',
            //'fk_nivel',
            //'fecha_registro',
            //'hora_registro',
            //'update_password',
            //'activo',
            //'area_sad',
            //'usuario_archivo',

            [ // begin buttons
                'class' => 'yii\grid\ActionColumn',
                    'header' => 'Opciones',
                    'headerOptions' => ['style' => 'width: 150px;'],
                    'contentOptions'=>['style'=>'border: 1px solid #BEBFC1;'],
                    'template' => '{derivar}',
                    'buttons'=>[
                                
                        'derivar'=>function($url, $model){
                            
                                return Html::a(
                                        '<span class="btn  btn-primary">
                                            <span class="glyphicon glyphicon-print"></span> Reporte PDF<span>',
                                        $url, ['title'=>'Derivar NUR/NURI']
                                    );            
                                                    
                        },
                                
                    ],
                    'urlCreator'=>function($action, $model, $key, $index){
                        
                            if($action=='derivar'){
                               return yii\helpers\Url::to(['seguimientos/pendientesusuariopdf', 'id'=>$key]); 
                            }
                                
                    }         
            ], // fin buttons 
                    
                    
        ],
    ]); ?>


</div>
