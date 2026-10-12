<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Niveles;

/**
 * NivelesSearch represents the model behind the search form of `app\models\Niveles`.
 */
class NivelesSearch extends Niveles
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_nivel', 'activo'], 'integer'],
            [['nivel', 'descripcion'], 'safe'],
        ];
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
        $query = Niveles::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_nivel' => $this->id_nivel,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['ilike', 'nivel', $this->nivel])
            ->andFilterWhere(['ilike', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
