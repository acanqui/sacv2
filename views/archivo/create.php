<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Archivo */

//$this->title = 'Create Archivo';
$this->params['breadcrumbs'][] = ['label' => 'Archivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Archivar NUR/NURI '. $seguimientos->codigo;
?>

<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="fa fa-archive" style="font-size:25pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 18pt;">Archivar tr&aacute;mite <?=$seguimientos->codigo?></u></b>
          </h5>
        </div>
    </div>
    <div class="col-md-6">
    </div>
</div>
<br>

<div class="archivo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'seguimientos' => $seguimientos,
    ]) ?>

</div>
