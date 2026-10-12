<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Recepciontemporal */

$this->title = 'Update Recepciontemporal: ' . $model->id_recepcion_temporal;
$this->params['breadcrumbs'][] = ['label' => 'Recepciontemporals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_recepcion_temporal, 'url' => ['view', 'id' => $model->id_recepcion_temporal]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="recepciontemporal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
