<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detalle_grupo_derivacion".
 *
 * @property int $id_detalle_grupo_derivacion
 * @property int $fk_grupo_derivacion
 * @property int $usuario_origen
 * @property int $activo
 */
class Detallegrupoderivacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detalle_grupo_derivacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_grupo_derivacion', 'usuario_origen'], 'required'],
            [['fk_grupo_derivacion', 'usuario_origen', 'activo'], 'default', 'value' => null],
            [['fk_grupo_derivacion', 'usuario_origen', 'activo'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_detalle_grupo_derivacion' => 'Id Detalle Grupo Derivacion',
            'fk_grupo_derivacion' => 'Fk Grupo Derivacion',
            'usuario_origen' => 'Usuario Origen',
            'activo' => 'Activo',
        ];
    }
}
