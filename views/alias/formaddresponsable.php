<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Alias */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="fa fa-folder-open-o" style="font-size:30pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 15pt;">Añadir responsable de &Aacute;rea/Unidad</u></b>
          </h5>
        </div>
    </div>
</div>

<div class="alias-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cargo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textArea(['maxlength' => true, 'cols'=>100, 'rows'=>3]) ?>

    <?php //= $form->field($model, 'fk_usuario')->textInput() ?>

    <?php //= $form->field($model, 'activo')->textInput() ?>

    <?php //= $form->field($model, 'fecha_registro')->textInput() ?>

    <?php //= $form->field($model, 'hora_registro')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span> Guardar nuevo responsable', ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
