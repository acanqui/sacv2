<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Listaderivacion */

$this->title = 'Update Listaderivacion: ' . $model->id_lista_derivacion;
$this->params['breadcrumbs'][] = ['label' => 'Listaderivacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_lista_derivacion, 'url' => ['view', 'id' => $model->id_lista_derivacion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="listaderivacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
