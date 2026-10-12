<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Correlativos;

/**
 * CorrelativosSearch represents the model behind the search form of `app\models\Correlativos`.
 */
class CorrelativosSearch extends Correlativos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_correlativo', 'correlativo', 'gestion', 'fk_correlativo', 'fk_area', 'fk_regional', 'activo', 'fk_tipo_documento'], 'integer'],
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
        $query = Correlativos::find();

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
            'id_correlativo' => $this->id_correlativo,
            'correlativo' => $this->correlativo,
            'gestion' => $this->gestion,
            'fk_correlativo' => $this->fk_correlativo,
            'fk_area' => $this->fk_area,
            'fk_regional' => $this->fk_regional,
            'activo' => $this->activo,
            'fk_tipo_documento' => $this->fk_tipo_documento,
        ]);

        return $dataProvider;
    }
}
