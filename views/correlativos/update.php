<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Correlativos */

$this->title = 'Update Correlativos: ' . $model->id_correlativo;
$this->params['breadcrumbs'][] = ['label' => 'Correlativos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_correlativo, 'url' => ['view', 'id' => $model->id_correlativo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="correlativos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
