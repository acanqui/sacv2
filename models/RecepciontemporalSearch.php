<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Recepciontemporal;

/**
 * RecepciontemporalSearch represents the model behind the search form of `app\models\Recepciontemporal`.
 */
class RecepciontemporalSearch extends Recepciontemporal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_recepcion_temporal', 'fk_seguimiento', 'fk_usuario'], 'integer'],
            [['nuri'], 'safe'],
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
        $query = Recepciontemporal::find();

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
            'id_recepcion_temporal' => $this->id_recepcion_temporal,
            'fk_seguimiento' => $this->fk_seguimiento,
            'fk_usuario' => $this->fk_usuario,
        ]);

        $query->andFilterWhere(['ilike', 'nuri', $this->nuri]);

        return $dataProvider;
    }
}
