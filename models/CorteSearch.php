<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Corte;

/**
 * CorteSearch represents the model behind the search form of `app\models\Corte`.
 */
class CorteSearch extends Corte
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_corte', 'nro_corte', 'fk_usuario', 'activo'], 'integer'],
            [['fecha_corte', 'descripcion', 'fecha_registro', 'hora_registro'], 'safe'],
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
        $query = Corte::find();

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
            'id_corte' => $this->id_corte,
            'nro_corte' => $this->nro_corte,
            'fecha_corte' => $this->fecha_corte,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'fk_usuario' => $this->fk_usuario,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['ilike', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
