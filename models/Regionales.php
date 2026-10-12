<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "regionales".
 *
 * @property int $id_regional
 * @property string $regional
 * @property string $sigla
 * @property string|null $descripcion
 * @property int $activo
 * @property int|null $id_regional_suic
 *
 * @property Areas[] $areas
 * @property Correlativos[] $correlativos
 * @property Usuarios[] $usuarios
 */
class Regionales extends \yii\db\ActiveRecord 
{
     //use kartik\tree\models\TreeTrait;
    /*use \kartik\tree\models\TreeTrait {
        isDisabled as parentIsDisabled; // note the alias
    }*/
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'regionales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['regional', 'sigla'], 'required'],
            [['activo', 'id_regional_suic'], 'default', 'value' => null],
            [['activo', 'id_regional_suic'], 'integer'],
            [['regional'], 'string', 'max' => 200],
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
            'id_regional' => 'Id Regional',
            'regional' => 'Regional',
            'sigla' => 'SIGLA',
            'descripcion' => 'Descripcion',
            'activo' => 'Activo',
            'id_regional_suic' => 'Id Regional Suic',
        ];
    }

    /**
     * Gets query for [[Areas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAreas()
    {
        return $this->hasMany(Areas::className(), ['fk_regional' => 'id_regional']);
    }

    /**
     * Gets query for [[Correlativos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCorrelativos()
    {
        return $this->hasMany(Correlativos::className(), ['fk_regional' => 'id_regional']);
    }

    /**
     * Gets query for [[Usuarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuarios::className(), ['fk_regional' => 'id_regional']);
    }
}
