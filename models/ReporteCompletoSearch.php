<?php 

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class ReporteCompletoSearch extends Seguimientos // O tu modelo principal
{
    public function rules()
    {
        return [
            [['id', 'usuario_id'], 'integer'],
            [['fecha', 'estado'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Seguimientos::find(); // O tu tabla base

        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'usuario_id' => $this->usuario_id,
            'fecha' => $this->fecha,
        ]);

        $query->andFilterWhere(['ilike', 'estado', $this->estado]);

        return $dataProvider;
    }
}
