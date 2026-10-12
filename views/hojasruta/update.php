<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Hojasruta */

$this->title = 'Update Hojasruta: ' . $model->id_hoja_ruta;
$this->params['breadcrumbs'][] = ['label' => 'Hojasrutas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_hoja_ruta, 'url' => ['view', 'id' => $model->id_hoja_ruta]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hojasruta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
