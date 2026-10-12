<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "acciones".
 *
 * @property int $id_accion
 * @property string $accion
 * @property string|null $observacion
 * @property int $activo
 *
 * @property DetalleCorte[] $detalleCortes
 * @property Seguimientos[] $seguimientos
 */
class Acciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'acciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['accion'], 'required'],
            [['activo'], 'default', 'value' => null],
            [['activo'], 'integer'],
            [['accion'], 'string', 'max' => 45],
            [['observacion'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_accion' => 'Id Accion',
            'accion' => 'Accion',
            'observacion' => 'Observacion',
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
        return $this->hasMany(DetalleCorte::className(), ['fk_accion' => 'id_accion']);
    }

    /**
     * Gets query for [[Seguimientos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeguimientos()
    {
        return $this->hasMany(Seguimientos::className(), ['fk_accion' => 'id_accion']);
    }
}
