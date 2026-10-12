<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detalle_corte".
 *
 * @property int $id_corte
 * @property string $codigo
 * @property int $derivado_por
 * @property int $derivado_a
 * @property string $proveido
 * @property string $fecha_derivacion
 * @property string $hora_derivacion
 * @property string $fecha_recepcion
 * @property string $hora_recepcion
 * @property int $fk_accion
 * @property int $fk_estado
 * @property int $padre
 * @property int $oficial
 * @property string|null $hijo
 * @property string $fecha_registro
 * @property string $hora_registro
 * @property int $gestion
 * @property int $confirmado
 * @property int $fk_corte
 * @property int $activo
 *
 * @property Acciones $fkAccion
 * @property Corte $fkCorte
 * @property Estados $fkEstado
 * @property Usuarios $derivadoPor
 * @property Usuarios $derivadoA
 */
class Detallecorte extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detalle_corte';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo', 'derivado_por', 'derivado_a', 'proveido', 'fecha_derivacion', 'hora_derivacion', 'fecha_recepcion', 'hora_recepcion', 'fk_accion', 'fk_estado', 'padre', 'oficial', 'fecha_registro', 'hora_registro', 'gestion', 'fk_corte'], 'required'],
            [['derivado_por', 'derivado_a', 'fk_accion', 'fk_estado', 'padre', 'oficial', 'gestion', 'confirmado', 'fk_corte', 'activo'], 'default', 'value' => null],
            [['derivado_por', 'derivado_a', 'fk_accion', 'fk_estado', 'padre', 'oficial', 'gestion', 'confirmado', 'fk_corte', 'activo'], 'integer'],
            [['proveido'], 'string'],
            [['fecha_derivacion', 'hora_derivacion', 'fecha_recepcion', 'hora_recepcion', 'fecha_registro', 'hora_registro'], 'safe'],
            [['codigo', 'hijo'], 'string', 'max' => 45],
            [['fk_accion'], 'exist', 'skipOnError' => true, 'targetClass' => Acciones::className(), 'targetAttribute' => ['fk_accion' => 'id_accion']],
            [['fk_corte'], 'exist', 'skipOnError' => true, 'targetClass' => Corte::className(), 'targetAttribute' => ['fk_corte' => 'id_corte']],
            [['fk_estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['fk_estado' => 'id_estado']],
            [['derivado_por'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['derivado_por' => 'id_usuario']],
            [['derivado_a'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['derivado_a' => 'id_usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_corte' => 'Id Corte',
            'codigo' => 'Codigo',
            'derivado_por' => 'Derivado Por',
            'derivado_a' => 'Derivado A',
            'proveido' => 'Proveido',
            'fecha_derivacion' => 'Fecha Derivacion',
            'hora_derivacion' => 'Hora Derivacion',
            'fecha_recepcion' => 'Fecha Recepcion',
            'hora_recepcion' => 'Hora Recepcion',
            'fk_accion' => 'Fk Accion',
            'fk_estado' => 'Fk Estado',
            'padre' => 'Padre',
            'oficial' => 'Oficial',
            'hijo' => 'Hijo',
            'fecha_registro' => 'Fecha Registro',
            'hora_registro' => 'Hora Registro',
            'gestion' => 'Gestion',
            'confirmado' => 'Confirmado',
            'fk_corte' => 'Fk Corte',
            'activo' => 'Activo',
        ];
    }

    /**
     * Gets query for [[FkAccion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkAccion()
    {
        return $this->hasOne(Acciones::className(), ['id_accion' => 'fk_accion']);
    }

    /**
     * Gets query for [[FkCorte]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkCorte()
    {
        return $this->hasOne(Corte::className(), ['id_corte' => 'fk_corte']);
    }

    /**
     * Gets query for [[FkEstado]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkEstado()
    {
        return $this->hasOne(Estados::className(), ['id_estado' => 'fk_estado']);
    }

    /**
     * Gets query for [[DerivadoPor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDerivadoPor()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'derivado_por']);
    }

    /**
     * Gets query for [[DerivadoA]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDerivadoA()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'derivado_a']);
    }
}
