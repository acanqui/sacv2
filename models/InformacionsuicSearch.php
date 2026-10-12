<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Informacionsuic;

/**
 * InformacionsuicSearch represents the model behind the search form of `app\models\Informacionsuic`.
 */
class InformacionsuicSearch extends Informacionsuic
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_informacion_suic', 'fk_documento_sac', 'fk_regional', 'fk_taller', 'fk_orden_pago', 'fk_usuario', 'activo'], 'integer'],
            [['nuri', 'fecha_registro', 'hora_registro'], 'safe'],
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
        $query = Informacionsuic::find();

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
            'id_informacion_suic' => $this->id_informacion_suic,
            'fk_documento_sac' => $this->fk_documento_sac,
            'fk_regional' => $this->fk_regional,
            'fk_taller' => $this->fk_taller,
            'fk_orden_pago' => $this->fk_orden_pago,
            'fk_usuario' => $this->fk_usuario,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['ilike', 'nuri', $this->nuri]);

        return $dataProvider;
    }
}
