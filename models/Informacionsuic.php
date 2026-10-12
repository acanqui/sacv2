<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "informacionsuic".
 *
 * @property int $id_informacion_suic
 * @property int $fk_documento_sac
 * @property string $nuri
 * @property int $fk_regional
 * @property int $fk_taller
 * @property int $fk_orden_pago
 * @property int $fk_usuario
 * @property string $fecha_registro
 * @property string $hora_registro
 * @property int $activo
 */
class Informacionsuic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'informacionsuic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            
            ['fk_orden_pago','required','message'=>'La Orden de Pago no puede quedar vacío '],
            ['fk_taller','required','message'=>'El Taller no puede quedar vacío '],
            
            [['fk_documento_sac', 'nuri', 'fk_regional', 'fk_taller', 'fk_orden_pago', 'fk_usuario'], 'required'],
            [['fk_documento_sac', 'fk_regional', 'fk_taller', 'fk_orden_pago', 'fk_usuario', 'activo'], 'default', 'value' => null],
            [['fk_documento_sac', 'fk_regional', 'fk_taller', 'fk_orden_pago', 'fk_usuario', 'activo'], 'integer'],
            [['nuri'], 'string'],
            [['fecha_registro', 'hora_registro'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_informacion_suic' => 'Id Informacion Suic',
            'fk_documento_sac' => 'Fk Documento Sac',
            'nuri' => 'Nuri',
            'fk_regional' => 'Fk Regional',
            'fk_taller' => 'Fk Taller',
            'fk_orden_pago' => 'Fk Orden Pago',
            'fk_usuario' => 'Fk Usuario',
            'fecha_registro' => 'Fecha Registro',
            'hora_registro' => 'Hora Registro',
            'activo' => 'Activo',
        ];
    }
    
    public function getidregionalsuic(){
        
        return Regionales::findOne(Yii::$app->user->identity->fk_regional);
                 
    }
    
}
