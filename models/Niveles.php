<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "niveles".
 *
 * @property int $id_nivel
 * @property string $nivel
 * @property string|null $descripcion
 * @property int $activo
 *
 * @property Usuarios[] $usuarios
 */
class Niveles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'niveles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nivel'], 'required'],
            [['activo'], 'default', 'value' => null],
            [['activo'], 'integer'],
            [['nivel'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_nivel' => 'Id Nivel',
            'nivel' => 'Nivel',
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
        return $this->hasMany(Usuarios::className(), ['fk_nivel' => 'id_nivel']);
    }
}
