<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Detallegrupoderivacion */

$this->title = 'Update Detallegrupoderivacion: ' . $model->id_detalle_grupo_derivacion;
$this->params['breadcrumbs'][] = ['label' => 'Detallegrupoderivacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_detalle_grupo_derivacion, 'url' => ['view', 'id' => $model->id_detalle_grupo_derivacion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="detallegrupoderivacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
