<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Informacionsuic */

$this->title = 'Update Informacionsuic: ' . $model->id_informacion_suic;
$this->params['breadcrumbs'][] = ['label' => 'Informacionsuics', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_informacion_suic, 'url' => ['view', 'id' => $model->id_informacion_suic]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="informacionsuic-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
