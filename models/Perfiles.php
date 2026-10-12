<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "perfiles".
 *
 * @property int $id_perfil
 * @property string $perfil
 * @property string|null $descripcion
 * @property int $activo
 *
 * @property Usuarios[] $usuarios
 */
class Perfiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perfiles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['perfil'], 'required'],
            [['activo'], 'default', 'value' => null],
            [['activo'], 'integer'],
            [['perfil'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_perfil' => 'Id Perfil',
            'perfil' => 'Perfil',
            'descripcion' => 'Descripcion',
            'activo' => 'Activo',
        ];
    }

    /**
     * Gets query for [[Usuarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuarios::className(), ['fk_perfil' => 'id_perfil']);
    }
}
