<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Estados */

//$this->title = 'Create Estados';
$this->params['breadcrumbs'][] = ['label' => 'Estados Seguimiento', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Crear nuevo';
?>
<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="glyphicon glyphicon-file" style="font-size:25pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 18pt;">Crear nuevo Estado Seguimiento</u></b>
          </h5>
        </div>
    </div>
    <div class="col-md-6">
    </div>
</div>
<br>
<div class="estados-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
