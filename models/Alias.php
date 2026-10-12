<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alias".
 *
 * @property int $id_alias
 * @property string $nombre
 * @property string $cargo
 * @property string|null $descripcion
 * @property int $fk_usuario
 * @property int|null $activo
 * @property string|null $fecha_registro
 * @property string|null $hora_registro
 *
 * @property Usuarios $fkUsuario
 */
class Alias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'cargo', 'fk_usuario'], 'required'],
            [['fk_usuario', 'activo'], 'default', 'value' => null],
            [['fk_usuario', 'activo'], 'integer'],
            [['fecha_registro', 'hora_registro'], 'safe'],
            [['nombre', 'descripcion'], 'string', 'max' => 500],
            [['cargo'], 'string', 'max' => 300],
            [['fk_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['fk_usuario' => 'id_usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_alias' => 'Id Alias',
            'nombre' => 'Nombre',
            'cargo' => 'Cargo',
            'descripcion' => 'Descripcion',
            'fk_usuario' => 'Fk Usuario',
            'activo' => 'Activo',
            'fecha_registro' => 'Fecha Registro',
            'hora_registro' => 'Hora Registro',
        ];
    }

    /**
     * Gets query for [[FkUsuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'fk_usuario']);
    }
}
