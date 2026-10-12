<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Agrupaciones;

/**
 * AgrupacionesSearch represents the model behind the search form of `app\models\Agrupaciones`.
 */
class AgrupacionesSearch extends Agrupaciones
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_agrupacion', 'oficial', 'fk_seguimiento_padre', 'fk_seguimiento_hijo', 'fk_usuario', 'activo'], 'integer'],
            [['nur_padre', 'nur_hijo', 'fecha_registro', 'hora_registro'], 'safe'],
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
        $query = Agrupaciones::find();

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
            'id_agrupacion' => $this->id_agrupacion,
            'oficial' => $this->oficial,
            'fk_seguimiento_padre' => $this->fk_seguimiento_padre,
            'fk_seguimiento_hijo' => $this->fk_seguimiento_hijo,
            'fk_usuario' => $this->fk_usuario,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['ilike', 'nur_padre', $this->nur_padre])
            ->andFilterWhere(['ilike', 'nur_hijo', $this->nur_hijo]);

        return $dataProvider;
    }
}
