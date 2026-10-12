<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Derivaciontemporal */

$this->title = 'Create Derivaciontemporal';
$this->params['breadcrumbs'][] = ['label' => 'Derivaciontemporals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="derivaciontemporal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
