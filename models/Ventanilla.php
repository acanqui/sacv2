<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ventanilla".
 *
 * @property int $id_ventanilla
 * @property int $correlativo
 * @property int $gestion
 * @property int $fk_usuario
 * @property int $activo
 * @property int $fk_regional
 * @property string|null $sigla
 *
 * @property Usuarios $fkUsuario
 */
class Ventanilla extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ventanilla';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['correlativo', 'gestion', 'fk_usuario', 'fk_regional'], 'required'],
            [['correlativo', 'gestion', 'fk_usuario', 'activo', 'fk_regional'], 'default', 'value' => null],
            [['correlativo', 'gestion', 'fk_usuario', 'activo', 'fk_regional'], 'integer'],
            [['sigla'], 'string', 'max' => 50],
            [['fk_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['fk_usuario' => 'id_usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ventanilla' => 'Id Ventanilla',
            'correlativo' => 'Correlativo',
            'gestion' => 'Gestion',
            'fk_usuario' => 'Fk Usuario',
            'activo' => 'Activo',
            'fk_regional' => 'Fk Regional',
            'sigla' => 'Sigla',
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
