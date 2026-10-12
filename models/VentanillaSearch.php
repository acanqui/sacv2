<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ventanilla;

/**
 * VentanillaSearch represents the model behind the search form of `app\models\Ventanilla`.
 */
class VentanillaSearch extends Ventanilla
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ventanilla', 'correlativo', 'gestion', 'fk_usuario', 'activo', 'fk_regional'], 'integer'],
            [['sigla'], 'safe'],
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
        $query = Ventanilla::find();

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
            'id_ventanilla' => $this->id_ventanilla,
            'correlativo' => $this->correlativo,
            'gestion' => $this->gestion,
            'fk_usuario' => $this->fk_usuario,
            'activo' => $this->activo,
            'fk_regional' => $this->fk_regional,
        ]);

        $query->andFilterWhere(['ilike', 'sigla', $this->sigla]);

        return $dataProvider;
    }
}
