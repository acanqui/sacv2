<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "carpetaarchivo".
 *
 * @property int $id_carpeta_archivo
 * @property int $nombre_carpeta
 * @property int $fk_area
 * @property int $fk_usuario
 * @property string $fecha_registro
 * @property string $hora_registro
 * @property int $activo
 */
class Carpetaarchivo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carpetaarchivo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre_carpeta', 'fk_area', 'fk_usuario'], 'required'],
            [['nombre_carpeta', 'fk_area', 'fk_usuario', 'activo'], 'default', 'value' => null],
            [['nombre_carpeta'], 'string', 'max' => 100],
            [['fk_area', 'fk_usuario', 'activo'], 'integer'],
            [['fecha_registro', 'hora_registro'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_carpeta_archivo' => 'Id Carpeta Archivo',
            'nombre_carpeta' => 'Nombre Carpeta',
            'fk_area' => 'Fk Area',
            'fk_usuario' => 'Fk Usuario',
            'fecha_registro' => 'Fecha Registro',
            'hora_registro' => 'Hora Registro',
            'activo' => 'Activo',
        ];
    }
}
