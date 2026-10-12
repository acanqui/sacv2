<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "correlativos".
 *
 * @property int $id_correlativo
 * @property int $correlativo
 * @property int $gestion
 * @property int|null $fk_correlativo
 * @property int $fk_area
 * @property int $fk_regional
 * @property int $activo
 * @property int $fk_tipo_documento
 *
 * @property Areas $fkArea
 * @property Regionales $fkRegional
 */
class Correlativos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'correlativos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['correlativo', 'gestion', 'fk_correlativo', 'fk_area', 'fk_regional', 'activo', 'fk_tipo_documento'], 'default', 'value' => null],
            [['correlativo', 'gestion', 'fk_correlativo', 'fk_area', 'fk_regional', 'activo', 'fk_tipo_documento'], 'integer'],
            [['gestion', 'fk_area', 'fk_regional', 'fk_tipo_documento'], 'required'],
            [['fk_area'], 'exist', 'skipOnError' => true, 'targetClass' => Areas::className(), 'targetAttribute' => ['fk_area' => 'id_area']],
            [['fk_regional'], 'exist', 'skipOnError' => true, 'targetClass' => Regionales::className(), 'targetAttribute' => ['fk_regional' => 'id_regional']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_correlativo' => 'Id Correlativo',
            'correlativo' => 'Correlativo',
            'gestion' => 'Gestion',
            'fk_correlativo' => 'Fk Correlativo',
            'fk_area' => 'Fk Area',
            'fk_regional' => 'Fk Regional',
            'activo' => 'Activo',
            'fk_tipo_documento' => 'Fk Tipo Documento',
        ];
    }

    /**
     * Gets query for [[FkArea]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkArea()
    {
        return $this->hasOne(Areas::className(), ['id_area' => 'fk_area']);
    }

    /**
     * Gets query for [[FkRegional]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkRegional()
    {
        return $this->hasOne(Regionales::className(), ['id_regional' => 'fk_regional']);
    }
}
