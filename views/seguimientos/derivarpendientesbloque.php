<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Usuarios;
use app\models\Acciones;
use app\models\Seguimientos;
use app\models\SeguimientosSearch;
use kartik\date\DatePicker;

use yii\bootstrap\Modal;
use yii\helpers\Url;

use yii\data\SqlDataProvider;

use kartik\dialog\Dialog;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SeguimientosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use kartik\widgets\Growl;
if (Yii::$app->session->getFlash('success')){
    echo Growl::widget([
        'type' => Growl::TYPE_SUCCESS,
        'title' => '<b>OPERACIÓN EXITOSA</b>',
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
    'title' => '<b>ERROR EN LA OPERACIÓN</b>',
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

//$this->title = 'Seguimientos';
$this->params['breadcrumbs'][] = 'Derivar/Confirmar pendientes bloque';

echo Dialog::widget();
?>
<br><br>
<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="glyphicon glyphicon-log-out" style="font-size:20pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 16pt;">Derivar Tr&aacute;mites Pendientes (Bloque)</u></b>
          </h5>
        </div>
    </div>
    <div class="col-md-6" style="text-align: right;">
       
    </div>
</div>

<style>
.grid-view table thead {
    background-color: #B8C7CD;
}

.grid-view table thead a {
    color: #222D32;
}


</style>

<div class="row">
 <div class="col-md-9">
  <div class="seguimientos-index">
    <br>
    <?=Html::beginForm(['seguimientos/derivarpendientebloque'], 'GET', ['class' => 'sidebar2-form2']); ?>
        <?php //= Html::beginForm('seguimientos/seguimientonuri') ?>
        
        <br>    
        <label class="control-label">Destinatario</label>    
            <?php 
                echo Select2::widget([
                    'name' => 'destino',
                    'data'=> Seguimientos::getListDestino(),
                    'language' => 'es',
                    
                    'options' => [
                        'placeholder' => 'Seleccione destinatario',
                        'required'=>true,
                        'multiple' => false,
                        'class'=>'form-control',
                    ],
                    'pluginOptions' => [
                                        'allowClear' => true,
                                        
                                    ],
                ]);
            ?>
        <br>
        <label class="control-label">Prove&iacute;do</label> 
        <?=Html::input('text', 'proveido', Yii::$app->request->post('proveido'), ['required'=>true, 'class'=>'form-control', 'placeholder'=>'Ingrese proveido...']); ?>
        <br>
        
        <?=Html::submitButton('<i class="glyphicon glyphicon-floppy-disk"></i> Derivar Trámites', ['class' => 'btn btn-success']); ?>
        <?php 
            
            if(Seguimientos::countderivarbloque()>0){
                echo " ".Html::a("<i style='font-size:12pt;' class='glyphicon glyphicon-ok-sign'></i> Confirmar y Finalizar", ['confirmarpendientebloque'], ['class' => 'btn btn-danger']); 
            }    
        ?>
            
    <?=Html::endForm(); ?>
    <hr style="opacity: 0.3;">    
        <?php
            /*$searchModel = new SeguimientosSearch();
            $dataProvider = $searchModel->searchderivadosdestinobloque(Yii::$app->request->queryParams);
            $dataProvider->pagination->pageSize=15;*/
            
            $dataProvider = Seguimientos::dataproviderdestinobloque();
                
                echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'pager' =>false,
                       // 'filterModel' => $searchModel,
                    
                        'columns' => [
                            
                            [
                                'class' => 'yii\grid\SerialColumn',
                                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt;'],
                            ],
                            /*[
                                'label'=>'Copia',
                                'attribute'=>'numero_copia',
                                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt;'],
                                'headerOptions'=>['style'=>'color:black;'],
                                'filter'=>false
                            ],*/

                            [
                                'label'=>'NUR/NURI',
                                'attribute'=>'codigo',
                                //'value'=>'codigo',
                                'value'=> function ($data){
                                        if($data["oficial"] == 1){
                                            $info = '';
                                        }
                                        if($data["oficial"] == 0){
                                            $info = $data["numero_copia"];
                                        }
                                        return $data["codigo"]."<br> <center><b>".$info."</b></center>";
                                        
                                        //return $."<br> <center>".$data["oficial"]==0 ?$data["numero_copia"]:''."</center>";
                                    },
                                'format'=>'html',
                                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt;'],
                                'headerOptions'=>['style'=>'color:black;'],
                                'filter'=>false
                            ],
                            
                            [
                                'label'=>'Derivado a',
                                'attribute'=>'derivado_a',
                                //'value'=>'derivado_a',
                                'value'=> function ($data){
                                        return Seguimientos::getUsuarioPendientes($data["derivado_a"]);
                                  },
                                'format'=>'html',
                                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt;'],
                                'headerOptions'=>['style'=>'color:black;'],
                                'filter'=>false
                            ],
                            
                            [
                                'label'=>'Área destino',
                                'attribute'=>'derivado_a',
                                //'value'=>'derivado_a',
                                'value'=> function ($data){
                                        //return $model->derivadoPor->nombre;
                                        return Seguimientos::getUsuarioArea($data["derivado_a"]);
                                    },
                                'format'=>'html',
                                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt;'],
                                'headerOptions'=>['style'=>'color:black;'],
                                'filter'=>false
                            ],                
                                            
                            [
                                'label'=>'Proveído',
                                'attribute'=>'proveido',
                                'value'=>'proveido',
                                'format'=>'html',
                                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt;'],
                                'headerOptions'=>['style'=>'color:black;'],
                                'filter'=>false
                            ],
                            [
                                'label'=>'Fecha',
                                'attribute'=>'fecha_derivacion',
                                'value'=>'fecha_derivacion',
                                'format'=>'date',
                                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt; width:90px;'],
                                'headerOptions'=>['style'=>'color:black;'],
                                'filter'=>false
                            ],
                            
                            [
                                'label'=>'Tipo',
                                'attribute'=>'oficial',
                                //'value'=>'oficial',
                                'value'=> function($data){
                                        
                                        if($data["oficial"] == 1){
                                            $info = 'ORIGINAL';
                                        }
                                        if($data["oficial"] == 0){
                                            $info = 'COPIA';
                                        }
                                        return $info;
                                    },
                                'format'=>'html',
                                'contentOptions' => ['style' => 'border: 1px solid #BEBFC1; font-size: 8pt;'],
                                'headerOptions'=>['style'=>'color:black;'],
                                'filter'=>false
                            ],
                            
                          /*                  
                            [
                                'class' => 'yii\grid\ActionColumn',
                                    'header' => 'Opciones',
                                    'headerOptions' => ['style' => 'border: 1px solid #BEBFC1; width: 110px;'],
                                    'contentOptions'=>['style'=>'border: 1px solid #BEBFC1;'],
                                    'template' => '{update} {eliminarderivacion} ',
                                    'buttons'=>[
                                        
                                        'update'=>function($data, $model, $key) {
                                            return Html :: a ('
                                                                <span class="btn btn-primary">
                                                                 <span class="fa fa-paint-brush" style="font-size: 11pt;">'
                                                                        , '#', [
                                                                   'data-toggle' => 'modal',
                                                                   'data-target' => '#update-modal',
                                                                   'class' => 'data-update',
                                                                   'data-id' => $key,
                                                               ]);
                                        }, 

                                        'eliminarderivacion'=>function($url, $model){

                                          return Html::a(
                                                        '<span class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span><span>',
                                                        $url, ['title'=>'Eliminar derivación', 
                                                                'data' => [
                                                                        'confirm' => 'Esta seguro que desea eliminar esta derivacion?',
                                                                        'method' => 'post',
                                                                    ],
                                                            ]
                                                    );
                                        },

                                    ],
                                    'urlCreator'=>function($action, $data){
                                            
                                            if($action=='eliminarderivacion'){
                                               return yii\helpers\Url::to(['eliminarderivacionbloque', 'id_seguimiento'=>$data["id_seguimiento"]]); 
                                            }
                                            
                                    }         
                            ], // fin buttons   
                           
                            */        
                                            
                        ],
                    ]); ?>
    
    
    
       

  </div>
</div>
<div class="col-md-3">
       
   <br><br>
    <table class="table table-hover table-bordered" style="width: 100%;">
      <thead>
        <tr style="background: #337AB7; color: white;" >
           <th>N.</th>
           <th>NUR/NURI</th>
           <th>TIPO</th>
        </tr>
      </thead>
      <tbody>
              <?php 
              $dataReader=Seguimientos::getderivacionbloque();
              $i=0;
               foreach ($dataReader as $row) { 
                        $id_seguimiento=$row['id_derivacion_temporal']  ;
               $i++;  
               if (($i % 2)==0) {
                    $color="style='background: #D5E3F0; opacity:1;'";
                  }
                else{
                  $color="";
                }    

              ?>
                <tr <?=$color?>>
                  <td style="font-size: 9pt; text-align:center;"><?=$i?></td>
                  <td style="font-size: 9pt; text-align:center;"><b><?=$row['nuri']?></b></td>
                  <td style="font-size: 9pt; text-align:center;"><?=$row['tipo']?></td>
                </tr>
              <?php
              } 
              ?>  
      </tbody>
    </table>
       
</div>   
</div>   




<?php 


//##############################################################################################
//CODIGO PARA MOSTRAR LA VISTA DE LOS DOCUMENTOS
//use yii\bootstrap\Modal;
//Update operation
Modal::begin([
    'id' => 'update-modal',
    'header' => '<h4 class="modal-title">Modificar derivacion</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Cerrar</a>',
    'size' => 'modal-lg',
]); 

//$requestUpdateUrl=Url::toRoute('actualizar');
$requestUpdateUrl=Url::toRoute('formcorregirderivacion');
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

