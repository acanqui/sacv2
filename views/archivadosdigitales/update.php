<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Archivadosdigitales */

$this->title = 'Update Archivadosdigitales: ' . $model->id_archivado_digital;
$this->params['breadcrumbs'][] = ['label' => 'Archivadosdigitales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_archivado_digital, 'url' => ['view', 'id' => $model->id_archivado_digital]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="archivadosdigitales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
