<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Correlativos */

$this->title = 'Create Correlativos';
$this->params['breadcrumbs'][] = ['label' => 'Correlativos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="correlativos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
