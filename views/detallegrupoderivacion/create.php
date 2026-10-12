<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Detallegrupoderivacion */

$this->title = 'Create Detallegrupoderivacion';
$this->params['breadcrumbs'][] = ['label' => 'Detallegrupoderivacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detallegrupoderivacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
