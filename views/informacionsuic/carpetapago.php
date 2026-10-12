<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

use yii\httpclient\Client;
/* @var $this yii\web\View */
/* @var $model app\models\Informacionsuic */
/* @var $form yii\widgets\ActiveForm */

//echo "=======>".$id_documento;

$row= \app\models\Documentos::getHojasRuta($id_informe);
$nuri=$row['nur'];

$regionales= app\models\Informacionsuic::getidregionalsuic();
$informe=app\models\Documentos::getInformecartaexterna($nuri);




$client = new Client();
$response = $client->createRequest()
    ->setMethod('POST')
    ->setFormat(Client::FORMAT_JSON)
    ->setUrl('http://10.0.10.12/WsTallerOrdenPago/controller/SincronizacionDatosControl.php?op=PostTalleres')
    ->setData(['dCredencial' => 'WFOayG7j73BDR3434V45345as147',  'dIdRegional' => ($regionales->id_regional_suic+0)])
    ->send();


//->setUrl('http://repl.eecgnv.gob.bo/WsTallerOrdenPago/controller/

$talleres=array();

if ($response->isOk) {
    // use your data
   
    //print_r($response);
    //var_dump($response->data);
    
    foreach($response->data as $row){
        //echo "<br>".$row['IdTaller']." => ".$row['Taller'];
    
        $talleres[$row['IdTaller']]=$row['Taller'];
    }
    
}
//print_r($talleres);

?>

<div class="row">
    <div class="col-md-6">
        <div class="card-body">
          <h5 style="color:#0B4C5F;" ><i class="fa fa-folder-open" style="font-size:25pt;" ></i>&nbsp;&nbsp;&nbsp;
              <b><u style="font-size: 16pt;">Asignar Orden de Pago </u></b>
          </h5>
        </div>
    </div>
    <div class="col-md-6">
    </div>
</div>


<div class="informacionsuic-form">
    <center>
        <b style="font-size:17pt;"><?=$regionales->regional?></b>
        <br><p></p>
        <b style="font-size:12pt;"><?=$nuri?><br>
        <?=$informe?><br></b>
    </center>
    <hr style="opacity: 0.4;">
    <?php $form = ActiveForm::begin(); ?>
    
    

    <?= $form->field($model, 'fk_documento_sac')->hiddenInput(['value'=>$id_informe])->label(false) ?>

    <?= $form->field($model, 'nuri')->hiddenInput(['value'=>$nuri])->label(false) ?>

    <?= $form->field($model, 'fk_regional')->hiddenInput(['value'=>$regionales->id_regional_suic])->label('Oficina Regional')->label(false) ?>

    <?php //= $form->field($model, 'fk_taller')->textInput()->label('Taller') ?>
    <?= $form->field($model, 'fk_taller')->widget(Select2::classname(), [
                        'data'=> $talleres,
                        'language' => 'es',
                        'options' => [
                                        'placeholder' => 'Seleccione Taller', /*'multiple' => true,*/
                                        'onchange'=>'
                                                     //alert($(this).val());   
                                                    $.post("index.php?r=informacionsuic/get-orden&id='.'"+$(this).val(), function(data){
                                                            $("select#informacionsuic-fk_orden_pago").html(data);
                                                    })',
                                     ],
                        'pluginOptions' => [
                            'allowClear' => true
                             ],
                ])->label('Taller'); ?> 
    
    
    

    <?php //= $form->field($model, 'fk_orden_pago')->textInput()->label('Orden de Pago') ?>
    
    <?= $form->field($model, 'fk_orden_pago')->widget(Select2::classname(), [
    //'data' => ArrayHelper::map(\app\models\Areas::find()->all(), 'id_area', 'area'),
    'data' => '',
    'options' => ['placeholder' => 'Seleccione Orden de Pago ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
        ])->label('Orden de Pago')?>
    
    

    <?php //= $form->field($model, 'fk_usuario')->hiddenInput(['value'=>Yii::$app->user->identity->id_usuario])->label(false) ?>

    <?php //= $form->field($model, 'fecha_registro')->hiddenInput(['value'=>date('Y-m-d')])->label(false) ?>

    <?php //= $form->field($model, 'hora_registro')->hiddenInput(['value'=>date('H:i:s')])->label(false) ?>

    <?= $form->field($model, 'activo')->hiddenInput(['value'=>$id_carta])->label(false) ?>

    <div class="form-group">
        <?php //= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::submitButton($model->isNewRecord ? "<span class='glyphicon glyphicon-floppy-disk'></span> Guardar" : "<span class='glyphicon glyphicon-floppy-disk'></span> Modificar Documento", ['class' => 'btn btn-success', 'id'=>'mybotonsave' ]) ?>
        <?=Html::a("<i class='glyphicon glyphicon-ban-circle'></i> <span style='font-size:9pt;'> Cancelar</span>", ['documentos/updatecartaexterna', 'id' => $id_carta], ['class' => 'btn btn-danger']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script src="<?=Yii::$app->request->baseUrl; ?>/js/jquery.js"></script>