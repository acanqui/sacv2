<?php

namespace app\models;
use app\models\Seguimientos;
use app\models\Estados;
use Yii;

/**
 * This is the model class for table "agrupaciones".
 *
 * @property int $id_agrupacion
 * @property string $nur_padre
 * @property string $nur_hijo
 * @property int $oficial
 * @property int $fk_seguimiento_padre
 * @property int $fk_seguimiento_hijo
 * @property int $fk_usuario
 * @property string $fecha_registro
 * @property string $hora_registro
 * @property int $activo
 *
 * @property Seguimientos $fkSeguimientoPadre
 */
class Agrupaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'agrupaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nur_padre', 'nur_hijo', 'oficial', 'fk_seguimiento_padre', 'fk_seguimiento_hijo', 'fk_usuario', 'fecha_registro', 'hora_registro'], 'required'],
            [['oficial', 'fk_seguimiento_padre', 'fk_seguimiento_hijo', 'fk_usuario', 'activo'], 'default', 'value' => null],
            [['oficial', 'fk_seguimiento_padre', 'fk_seguimiento_hijo', 'fk_usuario', 'activo'], 'integer'],
            [['fecha_registro', 'hora_registro'], 'safe'],
            [['nur_padre', 'nur_hijo'], 'string', 'max' => 45],
            [['fk_seguimiento_padre'], 'exist', 'skipOnError' => true, 'targetClass' => Seguimientos::className(), 'targetAttribute' => ['fk_seguimiento_padre' => 'id_seguimiento']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_agrupacion' => 'Id Agrupacion',
            'nur_padre' => 'Nur Padre',
            'nur_hijo' => 'Nur Hijo',
            'oficial' => 'Oficial',
            'fk_seguimiento_padre' => 'Fk Seguimiento Padre',
            'fk_seguimiento_hijo' => 'Fk Seguimiento Hijo',
            'fk_usuario' => 'Fk Usuario',
            'fecha_registro' => 'Fecha Registro',
            'hora_registro' => 'Hora Registro',
            'activo' => 'Activo',
        ];
    }

    /**
     * Gets query for [[FkSeguimientoPadre]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkSeguimientoPadre()
    {
        return $this->hasOne(Seguimientos::className(), ['id_seguimiento' => 'fk_seguimiento_padre']);
    }
    
    public function getEstadoSeguimiento($nuri){

	$row=Yii::$app->db->createCommand("SELECT *
                                           FROM seguimientos 
                                           WHERE codigo='$nuri' ORDER BY id_seguimiento DESC LIMIT 1")->query()->read();

        $model = Estados::findOne($row['fk_estado']);
	return $model->estado;
    }
    
    public function getIdEstadoSeguimiento($nuri){

	$row=Yii::$app->db->createCommand("SELECT *
                                           FROM seguimientos 
                                           WHERE codigo='$nuri' ORDER BY id_seguimiento DESC LIMIT 1")->query()->read();

	return $row['fk_estado'];
    }
}
