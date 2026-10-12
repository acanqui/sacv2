<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Grupoderivacion */

$this->title = 'Update Grupoderivacion: ' . $model->id_grupo_derivacion;
$this->params['breadcrumbs'][] = ['label' => 'Grupoderivacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_grupo_derivacion, 'url' => ['view', 'id' => $model->id_grupo_derivacion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="grupoderivacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
