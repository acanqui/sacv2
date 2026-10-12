<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Detallegrupoderivacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detallegrupoderivacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fk_grupo_derivacion')->textInput() ?>

    <?= $form->field($model, 'usuario_origen')->textInput() ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
