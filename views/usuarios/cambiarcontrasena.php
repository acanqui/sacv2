<script src="<?=Yii::$app->request->baseUrl; ?>/js/jquery.js"></script>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */

use kartik\widgets\Growl;
if (Yii::$app->session->getFlash('success')){
    echo Growl::widget([
        'type' => Growl::TYPE_SUCCESS,
        'title' => '<b>OPERACIÓN CORRECTA</b>',
        'icon' => 'glyphicon glyphicon-ok-circle',
        //'body' => 'You successfully read this important alert message.',
        'body' => Yii::$app->session->getFlash('success'),
        'showSeparator' => true,
        'delay' => 0,
        'pluginOptions' => [
            'showProgressbar' => true,
            'placement' => [
                'from' => 'top',
                'align' => 'right',
            ],
            'timer'=>2000,
        ]
    ]);
}

if (Yii::$app->session->getFlash('error')){
    echo Growl::widget([
    'type' => Growl::TYPE_DANGER,
    'title' => '<b>ERROR EN LA OPERACIÓN</b>',
    'icon' => 'glyphicon glyphicon-remove-circle',
    //'body' => 'Change a few things up and try submitting again.',
    'body' => Yii::$app->session->getFlash('error'),
    'showSeparator' => true,
    'delay' => 4500,
    'pluginOptions' => [
        'showProgressbar' => true,
        'placement' => [
            'from' => 'top',
            'align' => 'right',
        ],
        'timer'=>2000,
    ]
]);
}

?>
<script>
  function mostrarContrasena(){
      var tipo = document.getElementById("usuarios-password");
      if(tipo.type == "password"){
          tipo.type = "text";
      }else{
          tipo.type = "password";
      }
  }
</script>

<br>
<div class="row">
    <div class="col-md-12">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="fa fa-user" style="font-size:30pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><span style="font-size: 18pt;">Actualizar contraseña</span></b>
          </h5>
        </div>
    </div>
</div>
<hr style="opacity: 0.4;">

<div class="row">
    <div class="col-md-10">
        <div class="usuarios-form">

            <?php $form = ActiveForm::begin(); ?>

            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th>Nombre</th>
                    <td><?=$model->nombre?></td>
                </tr>
                <tr>
                    <th>Cargo</th>
                    <td><?=$model->cargo?></td>
                </tr>
                <tr>
                    <th>Usuario</th>
                    <td><?=$model->usuario?></td>
                </tr>
                <tr>
                    <th>Contraseña</th>
                    <td>
                        <?= $form->field($model, 'password')->passwordInput(['value' =>'', 'autofocus' => 'autofocus' ])->label(false) ?>
                        <button class="btn btn-primary" type="button" onclick="mostrarContrasena()">Mostrar Contraseña</button>
                    </td>
                </tr>

                <tr>
                    <th>Mosca</th>
                    <td><?=$model->mosca?></td>
                </tr>
                <tr>
                    <th>Perfil</th>
                    <td><?=$model->fkPerfil->perfil?></td>
                </tr>
                <tr>
                    <th>Regional</th>
                    <td><?=$model->fkRegional->regional?></td>
                </tr>
                <tr>
                    <th>Unidad/Area</th>
                    <td><?=$model->fkArea->area?></td>
                </tr>
                <tr>
                    <th>Nivel</th>
                    <td><?=$model->fkNivel->nivel?></td>
                </tr>




            </table>

            <div class="form-group">
                <?php //= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ['class' => 'btn btn-primary', 'id'=>'mybotonsave2' ]) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    
        
    </div>
</div>

