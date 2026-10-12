<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Institucionremitente */

$this->title = 'Update Institucionremitente: ' . $model->id_institucion_remitente;
$this->params['breadcrumbs'][] = ['label' => 'Institucionremitentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_institucion_remitente, 'url' => ['view', 'id' => $model->id_institucion_remitente]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="institucionremitente-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
