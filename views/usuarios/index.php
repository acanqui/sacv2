<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Perfiles;
use app\models\Niveles;
use app\models\Areas;
use app\models\Regionales;
use app\models\Usuarios;
use kartik\date\DatePicker;


use yii\bootstrap\Modal;
use yii\helpers\Url;

use kartik\dialog\Dialog;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = 'Administracion de usuarios';

echo Dialog::widget([
   'options' => [
                'type' => Dialog::TYPE_WARNING,
                'btnOKClass' => 'btn-warning',
                'size' => Dialog::SIZE_MEDIUM, // large dialog text
       ], // default options
]);

?>
<style>
.grid-view table thead {
    background-color: #B8C7CD;
}

.grid-view table thead a {
    color: #222D32;
}
</style>

<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="fa fa-users" style="font-size:30pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 18pt;">Administraci&oacute;n de Usuarios</u></b>
          </h5>
        </div>
    </div>
    <div class="col-md-6">
        <!--<div class="card-body" >
          <p style="color:#0B2F3A">
          Opcionalmente, puede ingresar un operador de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> o <b>=</b>) al comienzo de cada uno de sus valores de búsqueda para especificar cómo se debe hacer la comparación.
          </p>
        </div>-->
    </div>
</div>
<br>

<div class="usuarios-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fa fa-user-plus" style="font-size:14pt;" ></i> Crear nuevo Usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
             'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],   
            ],

            //'id_usuario',
            //'nombre',
            [
                'label'=>'Nombres y Apellidos',
                'attribute'=>'nombre',
                //'value'=>'nombre',
                'value' => function($model) { 
                        
                        if($model->fk_nivel==1 || $model->fk_nivel==3){
                            return "<b style='color:#222D32;'>".Usuarios::getNameUsuario ($model->id_usuario)."</b>" ;
                        }
                        else{
                            return $model->nombre ;
                        }
        
                                
                        
                },
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            
            [
                'label'=>'Cargo',
                'attribute'=>'cargo',
                'value'=>'cargo',
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            
            [
                'label'=>'Usuario',
                'attribute'=>'usuario',
                'value'=>'usuario',
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            
            [
                'label'=>'Perfil',
                'attribute'=>'fk_perfil',
                'value' => function ($model) {
                        return $model->fkPerfil->perfil;
                   },
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'fk_perfil',
                    'data' => ArrayHelper::map(Perfiles::find()->all(), 'id_perfil', 'perfil'),
                    'options' => [
                               'placeholder' => 'Seleccione'
                           ],
                       'pluginOptions' => [
                              'allowClear' => true
                          ],        
                ]),              
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            [
                'label'=>'Regional',
                'attribute'=>'fk_regional',
                'value' => function ($model) {
                        return $model->fkRegional->regional;
                   },
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'fk_regional',
                    'data' => ArrayHelper::map(Regionales::find()->all(), 'id_regional', 'regional'),
                    'options' => [
                               'placeholder' => 'Seleccione'
                           ],
                       'pluginOptions' => [
                              'allowClear' => true
                          ],        
                ]),            
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            [
                'label'=>'Area/Unidad',
                'attribute'=>'fk_area',
                'value' => function ($model) {
                        return $model->fkArea->area;
                   },
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'fk_area',
                    'data' => ArrayHelper::map(Areas::find()->all(), 'id_area', 'area'),
                    'options' => [
                               'placeholder' => 'Seleccione'
                           ],
                       'pluginOptions' => [
                              'allowClear' => true
                          ],        
                ]),           
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            [
                'label'=>'Nivel',
                'attribute'=>'fk_nivel',
                'value' => function ($model) {
                        return $model->fkNivel->nivel;
                   },
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'fk_nivel',
                    'data' => ArrayHelper::map(Niveles::find()->all(), 'id_nivel', 'nivel'),
                    'options' => [
                               'placeholder' => 'Seleccione'
                           ],
                       'pluginOptions' => [
                              'allowClear' => true
                          ],        
                ]),           
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            [
                'label'=>'Estado',
                'attribute'=>'activo',
                'value' => function ($model) {
                        return $model->activo==1?'Habilitado':'Deshabilitado';
                   },
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'activo',
                    'data' => [1=>'Habilitado', 0=>'Deshabilitado'],
                    'options' => [
                               'placeholder' => 'Seleccione'
                           ],
                       'pluginOptions' => [
                              'allowClear' => true
                          ],        
                ]),           
                'format'=>'html',
                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 9pt;'],
                'headerOptions'=>['style'=>'color:black;'],
            ],
            
            [ // begin buttons
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Opciones',
                'headerOptions' => ['style' => 'width: 180px;'],
                'contentOptions'=>['style'=>'border: 1px solid #BEBFC1; text-align: right'],
                'template' => '{addresponsable} {editar} {baja} {resetear}',
                'buttons'=>[

                    'addresponsable'=>function($url, $model, $key) {
                        
                       if($model->fk_nivel==1 || $model->fk_nivel==3){
                            return Html :: a ('<span class="btn btn-sm btn-success active">
                                               <span class="fa fa-user-plus"></span><span>'
                                                        , '#', [
                                                   'data-toggle' => 'modal',
                                                   'data-target' => '#update-modal',
                                                   'class' => 'data-update',
                                                   'data-id' => $key,
                                               ]);
                       }    
                    },     
                    
                    'editar'=>function($url, $model){
                        return Html::a(
                            '<span class="btn btn-sm btn-primary active">
                             <span class="fa fa-paint-brush"></span><span>',
                             $url, ['title' => Yii::t('app', 'Modificar datos de usuario: '.$model->usuario),] 
                        );
                    },        
                            
                    'baja'=>function($url, $model){
                        
                        if($model->activo==1){
                            return Html::a(
                                '<span class="btn btn-sm btn-danger active">
                                 <span class="glyphicon glyphicon-trash"></span><span>',
                                 $url, ['title' => Yii::t('app', 'Baja de usuario: '.$model->usuario),
                                        'data' => [
                                                     'confirm' => 'Esta seguro que desea eliminar este usuario?',
                                                     'method' => 'post',
                                                  ],
                                      ] 
                            );
                        }
                        else{
                            return Html::a(
                                '<span class="btn btn-sm btn-info active">
                                 <span class="glyphicon glyphicon-ok" style="font-size:12pt;"></span><span>',
                                 $url, ['title' => Yii::t('app', 'Habilitar usuario: '.$model->usuario),
                                        'data' => [
                                                     'confirm' => 'Esta seguro que desea habilitar este usuario?',
                                                     'method' => 'post',
                                                  ],
                                      ] 
                            );
                        }
                    },
                    'resetear'=>function($url, $model){
                        return Html::a(
                            '<span class="btn btn-sm btn-warning active">
                             <span class="glyphicon glyphicon-refresh"></span><span>',
                             $url, ['title' => Yii::t('app', 'Resetear contraseña de: '.$model->usuario),
                                    'data' => [
                                                 'confirm' => 'Esta seguro que desea reestablecer la contraseña de este usuario? <br> La contraseña será cambiada a <b>qwerty</b>',
                                                 'method' => 'post',
                                              ],
                                   ] 
                        );
                    },        

                ],
                    'urlCreator'=>function($action, $model, $key, $index){

                        if($action=='editar'){
                            return yii\helpers\Url::to(['update', 'id'=>$key]); 
                        }
                        if($action=='baja'){
                            return yii\helpers\Url::to(['bajausuario', 'id'=>$key]); 
                        }
                        if($action=='resetear'){
                            return yii\helpers\Url::to(['resetearpassword', 'id'=>$key]); 
                        }
                        

                    }         
            ], // fin buttons                
                           
                           
            //'cargo',
            //'usuario',
            //'correo',
            //'fk_perfil',
            //'fk_regional',
            //'fk_area',
            //'fk_nivel',
            //'activo',
            //'mosca',
            //'password',
            //'fecha_registro',
            //'hora_registro',
            //'update_password',
            //'area_sad',
            //'usuario_archivo',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
<?php 

//##############################################################################################
//CODIGO PARA MOSTRAR LA VISTA DE LOS DOCUMENTOS
//use yii\bootstrap\Modal;
//Update operation
Modal::begin([
    'id' => 'update-modal',
    'header' => '<h4 class="modal-title">Usuarios</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Cerrar</a>',
    'size' => 'modal-lg',
]); 

//$requestUpdateUrl=Url::toRoute('actualizar');
$requestUpdateUrl=Url::toRoute('alias/formaddresponsable');
$updateJs=<<<JS
    $('.data-update').on('click', function () {
        $.get ('{$requestUpdateUrl}', {id:$(this).closest('tr').data('key')},
            function (data) {
                $('.modal-body').html (data);
            }  
        );
    });
JS;
$this->registerJs($updateJs);
Modal::end();

?>

<script src="<?=Yii::$app->request->baseUrl; ?>/js/jquery.js"></script>