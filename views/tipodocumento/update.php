<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tipodocumento */

//$this->title = 'Update Tipodocumento: ' . $model->id_tipo_documento;
$this->params['breadcrumbs'][] = ['label' => 'Tipodocumentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tipo_documento, 'url' => ['view', 'id' => $model->id_tipo_documento]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="fa fa-paint-brush" style="font-size:25pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 18pt;">Modificar Tipo de Documento</u></b>
          </h5>
        </div>
    </div>
    <div class="col-md-6">
    </div>
</div>
<br>
<div class="tipodocumento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
