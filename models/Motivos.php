<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "motivos".
 *
 * @property int $id_motivo
 * @property string $motivo
 * @property string|null $descripcion
 * @property int|null $activo
 */
class Motivos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'motivos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['motivo'], 'required'],
            [['descripcion'], 'string'],
            [['activo'], 'default', 'value' => null],
            [['activo'], 'integer'],
            [['motivo'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_motivo' => 'Id Motivo',
            'motivo' => 'Motivo',
            'descripcion' => 'Descripcion',
            'activo' => 'Activo',
        ];
    }
}
