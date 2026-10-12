<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "corte".
 *
 * @property int $id_corte
 * @property int $nro_corte
 * @property string $fecha_corte
 * @property string|null $descripcion
 * @property string $fecha_registro
 * @property string $hora_registro
 * @property int $fk_usuario
 * @property int $activo
 *
 * @property Usuarios $fkUsuario
 * @property DetalleCorte[] $detalleCortes
 */
class Corte extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'corte';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nro_corte', 'fecha_corte', 'fecha_registro', 'hora_registro', 'fk_usuario'], 'required'],
            [['nro_corte', 'fk_usuario', 'activo'], 'default', 'value' => null],
            [['nro_corte', 'fk_usuario', 'activo'], 'integer'],
            [['fecha_corte', 'fecha_registro', 'hora_registro'], 'safe'],
            [['descripcion'], 'string', 'max' => 500],
            [['fk_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['fk_usuario' => 'id_usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_corte' => 'Id Corte',
            'nro_corte' => 'Nro Corte',
            'fecha_corte' => 'Fecha Corte',
            'descripcion' => 'Descripcion',
            'fecha_registro' => 'Fecha Registro',
            'hora_registro' => 'Hora Registro',
            'fk_usuario' => 'Fk Usuario',
            'activo' => 'Activo',
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

    /**
     * Gets query for [[DetalleCortes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleCortes()
    {
        return $this->hasMany(DetalleCorte::className(), ['fk_corte' => 'id_corte']);
    }
}
