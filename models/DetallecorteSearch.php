<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Detallecorte;

/**
 * DetallecorteSearch represents the model behind the search form of `app\models\Detallecorte`.
 */
class DetallecorteSearch extends Detallecorte
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_corte', 'derivado_por', 'derivado_a', 'fk_accion', 'fk_estado', 'padre', 'oficial', 'gestion', 'confirmado', 'fk_corte', 'activo'], 'integer'],
            [['codigo', 'proveido', 'fecha_derivacion', 'hora_derivacion', 'fecha_recepcion', 'hora_recepcion', 'hijo', 'fecha_registro', 'hora_registro'], 'safe'],
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
        $query = Detallecorte::find();

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
            'derivado_por' => $this->derivado_por,
            'derivado_a' => $this->derivado_a,
            'fecha_derivacion' => $this->fecha_derivacion,
            'hora_derivacion' => $this->hora_derivacion,
            'fecha_recepcion' => $this->fecha_recepcion,
            'hora_recepcion' => $this->hora_recepcion,
            'fk_accion' => $this->fk_accion,
            'fk_estado' => $this->fk_estado,
            'padre' => $this->padre,
            'oficial' => $this->oficial,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'gestion' => $this->gestion,
            'confirmado' => $this->confirmado,
            'fk_corte' => $this->fk_corte,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'proveido', $this->proveido])
            ->andFilterWhere(['ilike', 'hijo', $this->hijo]);

        return $dataProvider;
    }
}
