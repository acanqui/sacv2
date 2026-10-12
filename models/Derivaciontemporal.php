<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "derivaciontemporal".
 *
 * @property int $id_derivacion_temporal
 * @property int $fk_seguimiento
 * @property string $nuri
 * @property int $fk_usuario
 */
class Derivaciontemporal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'derivaciontemporal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_seguimiento', 'nuri', 'fk_usuario'], 'required'],
            [['fk_seguimiento', 'fk_usuario'], 'default', 'value' => null],
            [['fk_seguimiento', 'fk_usuario'], 'integer'],
            [['nuri'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_derivacion_temporal' => 'Id Derivacion Temporal',
            'fk_seguimiento' => 'Fk Seguimiento',
            'nuri' => 'Nuri',
            'fk_usuario' => 'Fk Usuario',
        ];
    }
}
