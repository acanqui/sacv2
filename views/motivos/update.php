<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Motivos */

$this->title = 'Update Motivos: ' . $model->id_motivo;
$this->params['breadcrumbs'][] = ['label' => 'Motivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_motivo, 'url' => ['view', 'id' => $model->id_motivo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="motivos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
