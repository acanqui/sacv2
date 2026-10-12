<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Hojasruta */

$this->title = 'Create Hojasruta';
$this->params['breadcrumbs'][] = ['label' => 'Hojasrutas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hojasruta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
