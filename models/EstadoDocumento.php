<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado_documento".
 *
 * @property int $id_estado_documento
 * @property string $estado_documento
 * @property string|null $descripcion
 * @property int $activo
 *
 * @property Documentos[] $documentos
 */
class Estadodocumento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estado_documento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado_documento'], 'required'],
            [['activo'], 'default', 'value' => null],
            [['activo'], 'integer'],
            [['estado_documento'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_estado_documento' => 'Id Estado Documento',
            'estado_documento' => 'Estado Documento',
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
        return $this->hasMany(Documentos::className(), ['fk_estado_documento' => 'id_estado_documento']);
    }
}
