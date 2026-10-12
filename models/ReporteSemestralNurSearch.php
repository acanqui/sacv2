<?php

namespace app\models;

use yii\base\Model;
use app\models\Hojasruta;
use yii\data\ActiveDataProvider;

class ReporteSemestralNurSearch extends Hojasruta
{
    /**
     * {@inheritdoc}
     */

    public $fecha_inicio;
    public $fecha_fin;
    public $tipo_nur;

    public function rules()
    {
        return [
            [['id_hoja_ruta', 'nro', 'proceso', 'fk_usuario', 'gestion', 'activo', 'fk_documento', 'oficial'], 'integer'],
            [['nur', 'codigo', 'fecha', 'hora', 'fecha_registro', 'hora_registro'], 'safe'],
            [['fecha_inicio', 'fecha_fin'], 'safe'], // Nuevas reglas para rango
            [['tipo_nur'], 'safe'], // Nueva regla para el tipo de nur y nuri en el filtrado
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios(){
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
    public function search($params){
        $query = Hojasruta::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'fecha_registro' => SORT_DESC // 🔹 Orden descendente por defecto
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_hoja_ruta' => $this->id_hoja_ruta,
            'nro' => $this->nro,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
            'proceso' => $this->proceso,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'fk_usuario' => $this->fk_usuario,
            'gestion' => $this->gestion,
            'activo' => $this->activo,
            'fk_documento' => $this->fk_documento,
            'oficial' => $this->oficial,
        ]);

        $query->andWhere(['not like', 'nur', 'I/%', false]); // Filtra los que no empiezan con I/

        $query->andFilterWhere(['ilike', 'nur', $this->nur])
            ->andFilterWhere(['ilike', 'codigo', $this->codigo]);

        if (!empty($this->fecha_inicio) && !empty($this->fecha_fin)) {
            $query->andFilterWhere(['between', 'fecha_registro', $this->fecha_inicio, $this->fecha_fin]);
        }

        /*if ($this->tipo_nur == 'nur') {
            $query->andWhere(['like', 'nur', 'I/%', false]);// Filtra los que empiezan con I/
        } elseif ($this->tipo_nur == 'nuri') {
            $query->andWhere(['not like', 'nur', 'I/%', false]);// Filtra los que no empiezan con I/
        }*/

        return $dataProvider;
    }
}
