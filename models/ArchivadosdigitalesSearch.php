<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Archivadosdigitales;

/**
 * ArchivadosdigitalesSearch represents the model behind the search form of `app\models\Archivadosdigitales`.
 */
class ArchivadosdigitalesSearch extends Archivadosdigitales
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_archivado_digital', 'fk_usuario', 'fk_seguimiento', 'gestion', 'activo', 'fk_regional'], 'integer'],
            [['codigo', 'fecha_archivo', 'hora_archivo', 'lugar', 'observaciones', 'fecha_registro', 'hora_registro'], 'safe'],
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
        $query = Archivadosdigitales::find();

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
            'id_archivado_digital' => $this->id_archivado_digital,
            'fecha_archivo' => $this->fecha_archivo,
            'hora_archivo' => $this->hora_archivo,
            'fk_usuario' => $this->fk_usuario,
            'fk_seguimiento' => $this->fk_seguimiento,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'gestion' => $this->gestion,
            'activo' => $this->activo,
            'fk_regional' => $this->fk_regional,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'lugar', $this->lugar])
            ->andFilterWhere(['ilike', 'observaciones', $this->observaciones]);

        return $dataProvider;
    }
}
