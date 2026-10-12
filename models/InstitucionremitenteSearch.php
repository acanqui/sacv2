<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Institucionremitente;

/**
 * InstitucionremitenteSearch represents the model behind the search form of `app\models\Institucionremitente`.
 */
class InstitucionremitenteSearch extends Institucionremitente
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_institucion_remitente', 'activo'], 'integer'],
            [['institucion_remitente', 'descripcion', 'nombre_remitente', 'cargo_remitente'], 'safe'],
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
        $query = Institucionremitente::find();

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
            'id_institucion_remitente' => $this->id_institucion_remitente,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['ilike', 'institucion_remitente', $this->institucion_remitente])
            ->andFilterWhere(['ilike', 'descripcion', $this->descripcion])
            ->andFilterWhere(['ilike', 'nombre_remitente', $this->nombre_remitente])
            ->andFilterWhere(['ilike', 'cargo_remitente', $this->cargo_remitente]);

        return $dataProvider;
    }
}
