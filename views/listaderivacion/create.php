<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Listaderivacion */

$this->title = 'Create Listaderivacion';
$this->params['breadcrumbs'][] = ['label' => 'Listaderivacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="listaderivacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
