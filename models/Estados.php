<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estados".
 *
 * @property int $id_estado
 * @property string $estado
 * @property string|null $descripcion
 * @property int $activo
 *
 * @property DetalleCorte[] $detalleCortes
 * @property Seguimientos[] $seguimientos
 */
class Estados extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estados';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado'], 'required'],
            [['activo'], 'default', 'value' => null],
            [['activo'], 'integer'],
            [['estado'], 'string', 'max' => 200],
            [['descripcion'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_estado' => 'Id Estado',
            'estado' => 'Estado',
            'descripcion' => 'Descripcion',
            'activo' => 'Activo',
        ];
    }

    /**
     * Gets query for [[DetalleCortes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleCortes()
    {
        return $this->hasMany(DetalleCorte::className(), ['fk_estado' => 'id_estado']);
    }

    /**
     * Gets query for [[Seguimientos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeguimientos()
    {
        return $this->hasMany(Seguimientos::className(), ['fk_estado' => 'id_estado']);
    }
}
