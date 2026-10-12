<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_documento".
 *
 * @property int $id_tipo_documento
 * @property string $tipo_documento
 * @property string $sigla
 * @property string|null $descripcion
 * @property int $activo
 *
 * @property Documentos[] $documentos
 */
class Tipodocumento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_documento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_documento', 'sigla'], 'required'],
            [['activo'], 'default', 'value' => null],
            [['activo'], 'integer'],
            [['tipo_documento'], 'string', 'max' => 100],
            [['sigla'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_documento' => 'Id Tipo Documento',
            'tipo_documento' => 'Tipo Documento',
            'sigla' => 'SIGLA',
            'descripcion' => 'Descripcion',
            'activo' => 'Activo',
        ];
    }

    /**
     * Gets query for [[Documentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentos()
    {
        return $this->hasMany(Documentos::className(), ['fk_tipo_documento' => 'id_tipo_documento']);
    }
}
