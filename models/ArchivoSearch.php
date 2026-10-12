<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Archivo;
use Yii;

/**
 * ArchivoSearch represents the model behind the search form of `app\models\Archivo`.
 */
class ArchivoSearch extends Archivo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_archivo', 'terminado', 'gestion', 'fk_usuario', 'fk_seguimiento', 'fk_regional', 'activo', 'oficial', 'fk_area'], 'integer'],
            [['nuri', 'acciones', 'nombre_carpeta', 'fecha_archivo', 'tipo_tramite', 'observaciones', 'fecha_registro', 'hora_registro'], 'safe'],
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
        $query = Archivo::find();

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
            'id_archivo' => $this->id_archivo,
            'fecha_archivo' => $this->fecha_archivo,
            'terminado' => $this->terminado,
            'gestion' => $this->gestion,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'fk_usuario' => $this->fk_usuario,
            'fk_seguimiento' => $this->fk_seguimiento,
            'fk_regional' => $this->fk_regional,
            //'activo' => 1,
            'activo' => $this->activo,
            'oficial' => $this->oficial,
            'fk_area' => $this->fk_area,
        ]);

        $query->andFilterWhere(['ilike', 'nuri', $this->nuri])
            ->andFilterWhere(['ilike', 'acciones', $this->acciones])
            ->andFilterWhere(['ilike', 'nombre_carpeta', $this->nombre_carpeta])
            ->andFilterWhere(['ilike', 'tipo_tramite', $this->tipo_tramite])
            ->andFilterWhere(['ilike', 'observaciones', $this->observaciones]);

        return $dataProvider;
    }
    
    
    public function searchArchivo($params)
    {
        $query = Archivo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['gestion' => SORT_DESC, 'fecha_archivo' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_archivo' => $this->id_archivo,
            'fecha_archivo' => $this->fecha_archivo,
            'terminado' => $this->terminado,
            'gestion' => $this->gestion,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'fk_usuario' => $this->fk_usuario,
            'fk_seguimiento' => $this->fk_seguimiento,
            'fk_regional' => $this->fk_regional,
            'activo' => 1,
            //'activo' => $this->activo,
            'oficial' => $this->oficial,
            //'fk_area' => Yii::$app->user->identity->fk_area,
            'fk_area' => $this->fk_area,
        ]);

        $query->andFilterWhere(['ilike', 'nuri', $this->nuri])
            ->andFilterWhere(['ilike', 'acciones', $this->acciones])
            ->andFilterWhere(['ilike', 'nombre_carpeta', $this->nombre_carpeta])
            ->andFilterWhere(['ilike', 'tipo_tramite', $this->tipo_tramite])
            ->andFilterWhere(['ilike', 'observaciones', $this->observaciones]);

        return $dataProvider;
    }
    
    
    public function searchArchivousuario($params)
    {
        $query = Archivo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['gestion' => SORT_DESC, 'fecha_archivo' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_archivo' => $this->id_archivo,
            'fecha_archivo' => $this->fecha_archivo,
            'terminado' => $this->terminado,
            'gestion' => $this->gestion,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            //'fk_usuario' => $this->fk_usuario,
            'fk_usuario' => Yii::$app->user->identity->id_usuario,
            'fk_seguimiento' => $this->fk_seguimiento,
            'fk_regional' => $this->fk_regional,
            //'activo' => 1,
            'activo' => $this->activo,
            'oficial' => $this->oficial,
            //'fk_area' => Yii::$app->user->identity->fk_area,
            'fk_area' => $this->fk_area,
        ]);

        $query->andFilterWhere(['ilike', 'nuri', $this->nuri])
            ->andFilterWhere(['ilike', 'acciones', $this->acciones])
            ->andFilterWhere(['ilike', 'nombre_carpeta', $this->nombre_carpeta])
            ->andFilterWhere(['ilike', 'tipo_tramite', $this->tipo_tramite])
            ->andFilterWhere(['ilike', 'observaciones', $this->observaciones]);

        return $dataProvider;
    }
    
    
} // end class
