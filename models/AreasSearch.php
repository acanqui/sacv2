<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Areas;

/**
 * AreasSearch represents the model behind the search form of `app\models\Areas`.
 */
class AreasSearch extends Areas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_area', 'dependencia', 'fk_regional', 'activo', 'carta', 'circular', 'informe', 'instructivo', 'memorandum', 'nota'], 'integer'],
            [['area', 'sigla', 'cite', 'descripcion'], 'safe'],
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
        $query = Areas::find();

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
            'id_area' => $this->id_area,
            'dependencia' => $this->dependencia,
            'fk_regional' => $this->fk_regional,
            'activo' => $this->activo,
            'carta' => $this->carta,
            'circular' => $this->circular,
            'informe' => $this->informe,
            'instructivo' => $this->instructivo,
            'memorandum' => $this->memorandum,
            'nota' => $this->nota,
        ]);

        $query->andFilterWhere(['ilike', 'area', $this->area])
            ->andFilterWhere(['ilike', 'sigla', $this->sigla])
            ->andFilterWhere(['ilike', 'cite', $this->cite])
            ->andFilterWhere(['ilike', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
    
    
    public function archivosearch($params)
    {
        $query = Areas::find();

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
            'id_area' => $this->id_area,
            'dependencia' => $this->dependencia,
            'fk_regional' => $this->fk_regional,
            //'activo' => $this->activo,
            'activo' => 1,
            'carta' => $this->carta,
            'circular' => $this->circular,
            'informe' => $this->informe,
            'instructivo' => $this->instructivo,
            'memorandum' => $this->memorandum,
            'nota' => $this->nota,
        ]);

        $query->andFilterWhere(['ilike', 'area', $this->area])
            ->andFilterWhere(['ilike', 'sigla', $this->sigla])
            ->andFilterWhere(['ilike', 'cite', $this->cite])
            ->andFilterWhere(['ilike', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
