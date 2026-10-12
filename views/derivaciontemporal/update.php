<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Derivaciontemporal */

$this->title = 'Update Derivaciontemporal: ' . $model->id_derivacion_temporal;
$this->params['breadcrumbs'][] = ['label' => 'Derivaciontemporals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_derivacion_temporal, 'url' => ['view', 'id' => $model->id_derivacion_temporal]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="derivaciontemporal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
