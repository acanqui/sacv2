<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Regionales;

/**
 * RegionalesSearch represents the model behind the search form of `app\models\Regionales`.
 */
class RegionalesSearch extends Regionales
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_regional', 'activo', 'id_regional_suic'], 'integer'],
            [['regional', 'sigla', 'descripcion'], 'safe'],
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
        $query = Regionales::find();

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
            'id_regional' => $this->id_regional,
            'activo' => $this->activo,
            'id_regional_suic' => $this->id_regional_suic,
        ]);

        $query->andFilterWhere(['ilike', 'regional', $this->regional])
            ->andFilterWhere(['ilike', 'sigla', $this->sigla])
            ->andFilterWhere(['ilike', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
