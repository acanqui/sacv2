<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Recepciontemporal */

$this->title = 'Create Recepciontemporal';
$this->params['breadcrumbs'][] = ['label' => 'Recepciontemporals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recepciontemporal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
