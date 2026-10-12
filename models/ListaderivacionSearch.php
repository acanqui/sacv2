<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Listaderivacion;
use Yii;
/**
 * ListaderivacionSearch represents the model behind the search form of `app\models\Listaderivacion`.
 */
class ListaderivacionSearch extends Listaderivacion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_lista_derivacion', 'activo', 'usuario_origen', 'usuario_destino'], 'integer'],
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
        $query = Listaderivacion::find();

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
            'id_lista_derivacion' => $this->id_lista_derivacion,
            'activo' => $this->activo,
            'usuario_origen' => $this->usuario_origen,
            'usuario_destino' => $this->usuario_destino,
        ]);

        return $dataProvider;
    }
    
    public function searchListaDerivacion($params)
    {
        $usuario=Yii::$app->user->identity->id_usuario;
        
        $query = Listaderivacion::find();

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
            'id_lista_derivacion' => $this->id_lista_derivacion,
            'activo' => 1,
            //'activo' => $this->activo,
            'usuario_origen' => $usuario,
            //'usuario_origen' => $this->usuario_origen,
            'usuario_destino' => $this->usuario_destino,
        ]);

        return $dataProvider;
    }
    
    
} // FIN CLASS
