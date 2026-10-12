<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "institucion_remitente".
 *
 * @property int $id_institucion_remitente
 * @property string $institucion_remitente
 * @property string|null $descripcion
 * @property int|null $activo
 * @property string|null $nombre_remitente
 * @property string|null $cargo_remitente
 */
class Institucionremitente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'institucion_remitente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['institucion_remitente'], 'required'],
            [['descripcion'], 'string'],
            [['activo'], 'default', 'value' => null],
            [['activo'], 'integer'],
            [['institucion_remitente', 'nombre_remitente', 'cargo_remitente'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_institucion_remitente' => 'Id Institucion Remitente',
            'institucion_remitente' => 'Institucion Remitente',
            'descripcion' => 'Descripcion',
            'activo' => 'Activo',
            'nombre_remitente' => 'Nombre Remitente',
            'cargo_remitente' => 'Cargo Remitente',
        ];
    }
}
