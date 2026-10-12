<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Detallecorte */

$this->title = 'Update Detallecorte: ' . $model->id_corte;
$this->params['breadcrumbs'][] = ['label' => 'Detallecortes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_corte, 'url' => ['view', 'id' => $model->id_corte]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="detallecorte-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
