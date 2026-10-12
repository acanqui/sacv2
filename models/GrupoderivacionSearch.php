<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Grupoderivacion;

/**
 * GrupoderivacionSearch represents the model behind the search form of `app\models\Grupoderivacion`.
 */
class GrupoderivacionSearch extends Grupoderivacion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_grupo_derivacion', 'fk_area', 'fk_usuario', 'fk_regional', 'activo'], 'integer'],
            [['nombre_grupo', 'fecha_registro', 'hora_registro'], 'safe'],
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
        $query = Grupoderivacion::find();

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
            'id_grupo_derivacion' => $this->id_grupo_derivacion,
            'fk_area' => $this->fk_area,
            'fk_usuario' => $this->fk_usuario,
            'fk_regional' => $this->fk_regional,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['ilike', 'nombre_grupo', $this->nombre_grupo]);

        return $dataProvider;
    }
}
