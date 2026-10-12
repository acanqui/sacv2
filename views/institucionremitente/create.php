<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Institucionremitente */

$this->title = 'Create Institucionremitente';
$this->params['breadcrumbs'][] = ['label' => 'Institucionremitentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="institucionremitente-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
