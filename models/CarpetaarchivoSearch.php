<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Carpetaarchivo;
use Yii;

/**
 * CarpetaarchivoSearch represents the model behind the search form of `app\models\Carpetaarchivo`.
 */
class CarpetaarchivoSearch extends Carpetaarchivo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        /*return [
            [['id_carpeta_archivo', 'nombre_carpeta', 'fk_area', 'fk_usuario', 'activo'], 'integer'],
            [['fecha_registro', 'hora_registro'], 'safe'],
        ];*/

        //modificado
        return [
            [['id_carpeta_archivo', 'fk_area', 'fk_usuario', 'activo'], 'integer'],
            [['nombre_carpeta'], 'string'],
            [['fecha_registro', 'hora_registro'], 'safe'],
        ];
        //fin modificado
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Carpetaarchivo::find();

        // add conditions that should always apply here

        /*$dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);*/

        //modificado
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'fecha_registro' => SORT_DESC,
                ],
            ],
        ]);
        //fin modificado

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_carpeta_archivo' => $this->id_carpeta_archivo,
            //comentado 'nombre_carpeta' => $this->nombre_carpeta,
            'fk_area' => $this->fk_area,
            'fk_usuario' => Yii::$app->user->identity->id_usuario,
            //'fk_usuario' => $this->fk_usuario,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'activo' => $this->activo,
        ]);

        //añadido
        $query->andFilterWhere(['like', 'nombre_carpeta', $this->nombre_carpeta]);


        return $dataProvider;
    }
}
