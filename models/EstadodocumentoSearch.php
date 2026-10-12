<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Estadodocumento;

/**
 * EstadodocumentoSearch represents the model behind the search form of `app\models\Estadodocumento`.
 */
class EstadodocumentoSearch extends Estadodocumento
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_estado_documento', 'activo'], 'integer'],
            [['estado_documento', 'descripcion'], 'safe'],
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
        $query = Estadodocumento::find();

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
            'id_estado_documento' => $this->id_estado_documento,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['ilike', 'estado_documento', $this->estado_documento])
            ->andFilterWhere(['ilike', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
