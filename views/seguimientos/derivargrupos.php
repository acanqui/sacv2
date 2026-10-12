<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Seguimientos */

$this->title = 'Create Seguimientos';
$this->params['breadcrumbs'][] = ['label' => 'Seguimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//echo "----> ".Yii::$app->user->identity->id_usuario;
?>
<div class="seguimientos-create">
  <div class="row">
    <div class="col-md-10">
        <center>
            <span style="font-size: 17pt;">
                <b><u><?=$hojasruta->nur?></u></b>
            </span>
        </center>    
        
        <?=Html::beginForm(['seguimientos/derivarcopiagrupos'], 'GET', ['class' => 'sidebars-form']); ?>
        <?php //= Html::beginForm('seguimientos/seguimientonuri') ?>
        <div >
            
            <?='<label class="control-label">Grupos de destino</label>';?>
            <?php echo Html::dropDownList(
                'grupo_derivacion', 
                'null',
                \app\models\Seguimientos::getListGrupo(),    
                //ArrayHelper::map(app\models\Grupoderivacion::findAll(['fk_usuario' => 3, activo=>1]), 'id_grupo_derivacion', 'nombre_grupo'),
                ['prompt'=>'Seleccione Grupo','class'=>'form-control'],      
                ); ?>
            
            <br>
            <label class="control-label">Prove&iacute;do</label>
            <?=Html::input('text', 'proveido', Yii::$app->request->post('proveido'), ['class'=>'form-control', 'placeholder'=>'Ingrese proveido...']); ?>
            
            <br>
            <label class="control-label">Acci&oacute;n/Tipo Proceso</label>
            <?php echo Html::dropDownList(
                'accion', 
                'null',
                ArrayHelper::map(app\models\Acciones::find()->all(), 'id_accion', 'accion'),
                //ArrayHelper::map(app\models\Grupoderivacion::findAll(['fk_usuario' => 3, activo=>1]), 'id_grupo_derivacion', 'nombre_grupo'),
                ['prompt'=>'Seleccione Acción/Tipo','class'=>'form-control'],      
                ); ?>
            
            <?=Html::hiddenInput('id_documento', $hojasruta->fk_documento   ); ?>
            <?=Html::hiddenInput('nuri', $hojasruta->nur   ); ?>
            <br><br>
            
            <?=Html::submitButton('<i class="glyphicon glyphicon-floppy-disk"></i> Derivar copias', ['class' => 'btn btn-success']); ?>
        </div>    
        
    <?=Html::endForm(); ?>
    
    
    </div>
  </div>
</div>
