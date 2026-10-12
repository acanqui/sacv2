<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Estadodocumento */

//$this->title = 'Create Estadodocumento';
$this->params['breadcrumbs'][] = ['label' => 'Estado Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Crear nuevo';
?>
<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="glyphicon glyphicon-file" style="font-size:25pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 18pt;">Crear nuevo Estado Documento</u></b>
          </h5>
        </div>
    </div>
    <div class="col-md-6">
    </div>
</div>
<br>
<div class="estadodocumento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
