<?php

namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuarios;

/**
 * UsuariosSearch represents the model behind the search form of `app\models\Usuarios`.
 */
class UsuariosSearch extends Usuarios
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario', 'fk_perfil', 'fk_regional', 'fk_area', 'fk_nivel', 'activo', 'area_sad', 'usuario_archivo'], 'integer'],
            [['nombre', 'cargo', 'usuario', 'password', 'correo', 'mosca', 'fecha_registro', 'hora_registro', 'update_password'], 'safe'],
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
        $query = Usuarios::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id_usuario' => SORT_ASC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_usuario' => $this->id_usuario,
            'fk_perfil' => $this->fk_perfil,
            'fk_regional' => $this->fk_regional,
            'fk_area' => $this->fk_area,
            'fk_nivel' => $this->fk_nivel,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'update_password' => $this->update_password,
            //'activo' => 1,
            'activo' => $this->activo,
            'area_sad' => $this->area_sad,
            'usuario_archivo' => $this->usuario_archivo,
        ]);

        $query->andFilterWhere(['ilike', 'nombre', $this->nombre])
            ->andFilterWhere(['ilike', 'cargo', $this->cargo])
            ->andFilterWhere(['ilike', 'usuario', $this->usuario])
            ->andFilterWhere(['ilike', 'password', $this->password])
            ->andFilterWhere(['ilike', 'correo', $this->correo])
            ->andFilterWhere(['ilike', 'mosca', $this->mosca]);

        return $dataProvider;
    }

    public function searcharea($params, $id_area)
    {
        $query = Usuarios::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id_usuario' => SORT_ASC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_usuario' => $this->id_usuario,
            'fk_perfil' => $this->fk_perfil,
            'fk_regional' => $this->fk_regional,
            //'fk_area' => $this->fk_area,
            'fk_area' => $id_area,
            'fk_nivel' => $this->fk_nivel,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'update_password' => $this->update_password,
            'activo' => 1,
            //'activo' => $this->activo,
            'area_sad' => $this->area_sad,
            'usuario_archivo' => $this->usuario_archivo,
        ]);

        $query->andFilterWhere(['ilike', 'nombre', $this->nombre])
            ->andFilterWhere(['ilike', 'cargo', $this->cargo])
            ->andFilterWhere(['ilike', 'usuario', $this->usuario])
            ->andFilterWhere(['ilike', 'password', $this->password])
            ->andFilterWhere(['ilike', 'correo', $this->correo])
            ->andFilterWhere(['ilike', 'mosca', $this->mosca]);

        return $dataProvider;
    }


    public function searchPendientesnacional($params)
    {
        $query = Usuarios::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id_usuario' => SORT_ASC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_usuario' => $this->id_usuario,
            'fk_perfil' => $this->fk_perfil,
            'fk_regional' => $this->fk_regional,
            'fk_area' => $this->fk_area,
            'fk_nivel' => $this->fk_nivel,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'update_password' => $this->update_password,
            //'activo' => 1,
            'activo' => $this->activo,
            'area_sad' => $this->area_sad,
            'usuario_archivo' => $this->usuario_archivo,
        ]);

        $query->andFilterWhere(['ilike', 'nombre', $this->nombre])
            ->andFilterWhere(['ilike', 'cargo', $this->cargo])
            ->andFilterWhere(['ilike', 'usuario', $this->usuario])
            ->andFilterWhere(['ilike', 'password', $this->password])
            ->andFilterWhere(['ilike', 'correo', $this->correo])
            ->andFilterWhere(['ilike', 'mosca', $this->mosca]);

        return $dataProvider;
    }
    
    public function searchPendientesArea($params)
    {
        $query = Usuarios::find();

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
            'id_usuario' => $this->id_usuario,
            'fk_perfil' => $this->fk_perfil,
            'fk_regional' => $this->fk_regional,
            'fk_area' => Yii::$app->user->identity->fk_area,
            'fk_nivel' => $this->fk_nivel,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'update_password' => $this->update_password,
            'activo' => 1,
            //'activo' => $this->activo,
            'area_sad' => $this->area_sad,
            'usuario_archivo' => $this->usuario_archivo,
        ]);

        $query->andFilterWhere(['ilike', 'nombre', $this->nombre])
            ->andFilterWhere(['ilike', 'cargo', $this->cargo])
            ->andFilterWhere(['ilike', 'usuario', $this->usuario])
            ->andFilterWhere(['ilike', 'password', $this->password])
            ->andFilterWhere(['ilike', 'correo', $this->correo])
            ->andFilterWhere(['ilike', 'mosca', $this->mosca]);

        return $dataProvider;
    }
    
    
    public function searchListaDerivacion($params)
    {
        
         
        $query = Usuarios::find();

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
            'id_usuario' => $this->id_usuario,
            'fk_perfil' => $this->fk_perfil,
            'fk_regional' => $this->fk_regional,
            'fk_area' => $this->fk_area,
            'fk_nivel' => $this->fk_nivel,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'update_password' => $this->update_password,
            'activo' => 1,
            //'activo' => $this->activo,
            'area_sad' => $this->area_sad,
            'usuario_archivo' => $this->usuario_archivo,
        ]);

        $query->andFilterWhere(['ilike', 'nombre', $this->nombre])
            ->andFilterWhere(['ilike', 'cargo', $this->cargo])
            ->andFilterWhere(['ilike', 'usuario', $this->usuario])
            ->andFilterWhere(['ilike', 'password', $this->password])
            ->andFilterWhere(['ilike', 'correo', $this->correo])
            ->andFilterWhere(['ilike', 'mosca', $this->mosca]);

        return $dataProvider;
        
        
    } // end function
    
    
    
} //fin class
