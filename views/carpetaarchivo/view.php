<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Carpetaarchivo */
use kartik\dialog\Dialog;

echo Dialog::widget([
   'options' => [
                'type' => Dialog::TYPE_WARNING,
                'btnOKClass' => 'btn-warning',
                'size' => Dialog::SIZE_MEDIUM, // large dialog text
       ], // default options
]);

//$this->title = $model->id_carpeta_archivo;
$this->params['breadcrumbs'][] = ['label' => 'Carpetaarchivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Ver información';
\yii\web\YiiAsset::register($this);
?>

<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="glyphicon glyphicon-eye-open" style="font-size:30pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 18pt;">Ver informaci&oacute;n de registro</u></b>
          </h5>
        </div>
    </div>
    <div class="col-md-6">
       
    </div>
</div>
<br>

<div class="carpetaarchivo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="glyphicon glyphicon-ban-circle"></i> Cancelar', ['index'], ['class' => 'btn btn-warning active']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-file"></i> Nuevo Registro', ['create'], ['class' => 'btn btn-success active']) ?>
        
        <?= Html::a('<span class="fa fa-paint-brush"></span> Modificar', ['update', 'id' => $model->id_carpeta_archivo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->id_carpeta_archivo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro que desea eliminar este registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id_carpeta_archivo',
            'nombre_carpeta',
            //'fk_area',
            //'fk_usuario',
            'fecha_registro',
            'hora_registro',
            //'activo',
        ],
    ]) ?>

</div>
