<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "archivados_digitales".
 *
 * @property int $id_archivado_digital
 * @property string $codigo
 * @property string $fecha_archivo
 * @property string $hora_archivo
 * @property string $lugar
 * @property string $observaciones
 * @property int $fk_usuario
 * @property int $fk_seguimiento
 * @property string $fecha_registro
 * @property string $hora_registro
 * @property int $gestion
 * @property int $activo
 * @property int|null $fk_regional
 *
 * @property Seguimientos $fkSeguimiento
 * @property Usuarios $fkUsuario
 */
class Archivadosdigitales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'archivados_digitales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo', 'fecha_archivo', 'hora_archivo', 'lugar', 'observaciones', 'fk_usuario', 'fk_seguimiento', 'fecha_registro', 'hora_registro', 'gestion'], 'required'],
            [['fecha_archivo', 'hora_archivo', 'fecha_registro', 'hora_registro'], 'safe'],
            [['fk_usuario', 'fk_seguimiento', 'gestion', 'activo', 'fk_regional'], 'default', 'value' => null],
            [['fk_usuario', 'fk_seguimiento', 'gestion', 'activo', 'fk_regional'], 'integer'],
            [['codigo'], 'string', 'max' => 45],
            [['lugar'], 'string', 'max' => 100],
            [['observaciones'], 'string', 'max' => 500],
            [['fk_seguimiento'], 'exist', 'skipOnError' => true, 'targetClass' => Seguimientos::className(), 'targetAttribute' => ['fk_seguimiento' => 'id_seguimiento']],
            [['fk_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['fk_usuario' => 'id_usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_archivado_digital' => 'Id Archivado Digital',
            'codigo' => 'Codigo',
            'fecha_archivo' => 'Fecha Archivo',
            'hora_archivo' => 'Hora Archivo',
            'lugar' => 'Lugar',
            'observaciones' => 'Observaciones',
            'fk_usuario' => 'Fk Usuario',
            'fk_seguimiento' => 'Fk Seguimiento',
            'fecha_registro' => 'Fecha Registro',
            'hora_registro' => 'Hora Registro',
            'gestion' => 'Gestion',
            'activo' => 'Activo',
            'fk_regional' => 'Fk Regional',
        ];
    }

    /**
     * Gets query for [[FkSeguimiento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkSeguimiento()
    {
        return $this->hasOne(Seguimientos::className(), ['id_seguimiento' => 'fk_seguimiento']);
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
