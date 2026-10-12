<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Agrupaciones */

$this->title = 'Create Agrupaciones';
$this->params['breadcrumbs'][] = ['label' => 'Agrupaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agrupaciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
