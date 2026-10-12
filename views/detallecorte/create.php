<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Detallecorte */

$this->title = 'Create Detallecorte';
$this->params['breadcrumbs'][] = ['label' => 'Detallecortes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detallecorte-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
