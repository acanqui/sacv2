<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

//$this->title = $model->id_usuario;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Ver información usuario';
\yii\web\YiiAsset::register($this);
?>

<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="glyphicon glyphicon-eye-open" style="font-size:30pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 18pt;">Ver informaci&oacute;n de usuario</u></b>
          </h5>
        </div>
    </div>
    <div class="col-md-6">
       
    </div>
</div>
<br>

<div class="usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="glyphicon glyphicon-ban-circle"></i> Cancelar', ['index'], ['class' => 'btn btn-warning active']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-file"></i> Nuevo Registro', ['create'], ['class' => 'btn btn-success active']) ?>
        
        <?= Html::a('<span class="fa fa-paint-brush"></span> Modificar', ['update', 'id' => $model->id_usuario], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->id_usuario], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro que desea eliminar este usuario?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id_usuario',
            [                                                  // the owner name of the model
                'label' => 'ID',
                'value' => $model->id_usuario,
                'format'=>'html',
                //'contentOptions' => ['class' => 'bg-red'],     // HTML attributes to customize value tag
                'captionOptions' => ['tooltip' => 'Tooltip'],  // HTML attributes to customize label tag
            ],
            'nombre',
            'cargo',
            'usuario',
            'password',
            'correo',
            'mosca',
            //'fk_perfil',
            /*[
                'attribute'=>'fk_moneda',
                'value'=>function($model){
                            $monedas= Monedas::findOne($model->fk_moneda);
                            return $monedas->moneda;
                    },
                'label'=>'Moneda'
            ], */  
            
            [                                                  // the owner name of the model
                'label' => 'Perfil de Usuario',
                'value' => $model->fkPerfil->perfil,
                'format'=>'html',
                //'contentOptions' => ['class' => 'bg-red'],     // HTML attributes to customize value tag
                'captionOptions' => ['tooltip' => 'Tooltip'],  // HTML attributes to customize label tag
            ],
            //'fk_regional',
            [                                                  // the owner name of the model
                'label' => 'Oficina regional',
                'value' => $model->fkRegional->regional,
                'format'=>'html',
                //'contentOptions' => ['class' => 'bg-red'],     // HTML attributes to customize value tag
                'captionOptions' => ['tooltip' => 'Tooltip'],  // HTML attributes to customize label tag
            ],
            //'fk_area',
            [                                                  // the owner name of the model
                'label' => 'Área/Unidad',
                'value' => $model->fkArea->area,
                'format'=>'html',
                //'contentOptions' => ['class' => 'bg-red'],     // HTML attributes to customize value tag
                'captionOptions' => ['tooltip' => 'Tooltip'],  // HTML attributes to customize label tag
            ],
            //'fk_nivel',
            [                                                  // the owner name of the model
                'label' => 'Nivel de usuario',
                'value' => $model->fkNivel->nivel,
                'format'=>'html',
                //'contentOptions' => ['class' => 'bg-red'],     // HTML attributes to customize value tag
                'captionOptions' => ['tooltip' => 'Tooltip'],  // HTML attributes to customize label tag
            ],
            'fecha_registro:date',
            'hora_registro:time',
            //'update_password',
            //'activo',
            [
                'label'=>'Estado usuario',
                'attribute'=>'activo',
                'value'=>function($model){
                        
                        if($model->activo==1){
                            return 'USUARIO HABILITADO';
                        }
                        else{
                            return 'USUARIO DESHABILITADO';
                        }
                    },
            ],
            [
                'label'=>'Estado archivo',
                'attribute'=>'area_sad',
                'value'=>function($model){
                        
                        if($model->area_sad==1){
                            return 'ARCHIVO HABILITADO';
                        }
                        else{
                            return 'ARCHIVO DESHABILITADO';
                        }
                    },
            ],                
            //'area_sad',
            //'usuario_archivo',
        ],
    ]) ?>

</div>
