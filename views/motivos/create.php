<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Motivos */

$this->title = 'Create Motivos';
$this->params['breadcrumbs'][] = ['label' => 'Motivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="motivos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
