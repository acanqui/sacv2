<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Perfiles;

/**
 * PerfilesSearch represents the model behind the search form of `app\models\Perfiles`.
 */
class PerfilesSearch extends Perfiles
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_perfil', 'activo'], 'integer'],
            [['perfil', 'descripcion'], 'safe'],
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
        $query = Perfiles::find();

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
            'id_perfil' => $this->id_perfil,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['ilike', 'perfil', $this->perfil])
            ->andFilterWhere(['ilike', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
