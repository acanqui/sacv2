<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Archivadosdigitales */

$this->title = 'Create Archivadosdigitales';
$this->params['breadcrumbs'][] = ['label' => 'Archivadosdigitales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="archivadosdigitales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
