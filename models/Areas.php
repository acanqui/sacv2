<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "areas".
 *
 * @property int $id_area
 * @property string $area
 * @property string $sigla
 * @property string $cite
 * @property string|null $descripcion
 * @property int|null $dependencia
 * @property int $fk_regional
 * @property int $activo
 * @property int|null $carta
 * @property int|null $circular
 * @property int|null $informe
 * @property int|null $instructivo
 * @property int|null $memorandum
 * @property int|null $nota
 *
 * @property Regionales $fkRegional
 * @property Correlativos[] $correlativos
 * @property Documentos[] $documentos
 * @property Usuarios[] $usuarios
 */
class Areas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'areas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['area', 'sigla', 'cite', 'fk_regional'], 'required'],
            [['dependencia', 'fk_regional', 'activo', 'carta', 'circular', 'informe', 'instructivo', 'memorandum', 'nota'], 'default', 'value' => null],
            [['dependencia', 'fk_regional', 'activo', 'carta', 'circular', 'informe', 'instructivo', 'memorandum', 'nota'], 'integer'],
            [['area'], 'string', 'max' => 200],
            [['sigla'], 'string', 'max' => 45],
            [['cite'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 500],
            [['fk_regional'], 'exist', 'skipOnError' => true, 'targetClass' => Regionales::className(), 'targetAttribute' => ['fk_regional' => 'id_regional']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_area' => 'Id Area',
            'area' => 'Area',
            'sigla' => 'SIGLA',
            'cite' => 'CITE',
            'descripcion' => 'Descripcion',
            'dependencia' => 'Dependencia',
            'fk_regional' => 'Fk Regional',
            'activo' => 'Activo',
            'carta' => 'Carta',
            'circular' => 'Circular',
            'informe' => 'Informe',
            'instructivo' => 'Instructivo',
            'memorandum' => 'Memorandum',
            'nota' => 'Nota',
        ];
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

    /**
     * Gets query for [[Correlativos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCorrelativos()
    {
        return $this->hasMany(Correlativos::className(), ['fk_area' => 'id_area']);
    }

    /**
     * Gets query for [[Documentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentos()
    {
        return $this->hasMany(Documentos::className(), ['fk_area' => 'id_area']);
    }

    /**
     * Gets query for [[Usuarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuarios::className(), ['fk_area' => 'id_area']);
    }
}
