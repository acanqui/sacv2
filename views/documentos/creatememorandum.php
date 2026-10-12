<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Documentos */

//$this->title = 'Create Documentos';
$this->params['breadcrumbs'][] = ['label' => 'Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Crear nueva carta';
?>
<div class="documentos-create">

    <div class="row">
        <div class="col-md-10">
            <div class="card-body">
              <h5 style="color:#0B4C5F;" >
                  <b><span style="font-size: 25pt;"><img src="<?= Yii::$app->request->baseUrl ?>/images/memorando.png" style="width:45px;" /> <b>Memorando</b> </span></b>
                  <hr style="width: 90%; color: #DBDBDD; opacity: 0.4;">
              </h5>
            </div>
        </div>
    </div>
    
    <?= $this->render('_formmemorandum', [
        'model' => $model,
    ]) ?>

</div>
