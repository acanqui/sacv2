<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grupo_derivacion".
 *
 * @property int $id_grupo_derivacion
 * @property string $nombre_grupo
 * @property int $fk_area
 * @property int $fk_usuario
 * @property int $fk_regional
 * @property string $fecha_registro
 * @property string $hora_registro
 * @property int $activo
 */
class Grupoderivacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grupo_derivacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre_grupo', 'fk_area', 'fk_usuario', 'fk_regional', 'fecha_registro', 'hora_registro'], 'required'],
            [['fk_area', 'fk_usuario', 'fk_regional', 'activo'], 'default', 'value' => null],
            [['fk_area', 'fk_usuario', 'fk_regional', 'activo'], 'integer'],
            [['fecha_registro', 'hora_registro'], 'safe'],
            [['nombre_grupo'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_grupo_derivacion' => 'Id Grupo Derivacion',
            'nombre_grupo' => 'Nombre Grupo',
            'fk_area' => 'Fk Area',
            'fk_usuario' => 'Fk Usuario',
            'fk_regional' => 'Fk Regional',
            'fecha_registro' => 'Fecha Registro',
            'hora_registro' => 'Hora Registro',
            'activo' => 'Activo',
        ];
    }
}
