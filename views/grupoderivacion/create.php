<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Grupoderivacion */

$this->title = 'Create Grupoderivacion';
$this->params['breadcrumbs'][] = ['label' => 'Grupoderivacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupoderivacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
