<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tipodocumento;

/**
 * TipodocumentoSearch represents the model behind the search form of `app\models\Tipodocumento`.
 */
class TipodocumentoSearch extends Tipodocumento
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tipo_documento', 'activo'], 'integer'],
            [['tipo_documento', 'sigla', 'descripcion'], 'safe'],
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
        $query = Tipodocumento::find();

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
            'id_tipo_documento' => $this->id_tipo_documento,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['ilike', 'tipo_documento', $this->tipo_documento])
            ->andFilterWhere(['ilike', 'sigla', $this->sigla])
            ->andFilterWhere(['ilike', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
