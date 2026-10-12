<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Hojasruta;
use app\models\Dcoumentos;
use Yii;
/**
 * HojasrutaSearch represents the model behind the search form of `app\models\Hojasruta`.
 */
class HojasrutaSearch extends Hojasruta
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_hoja_ruta', 'nro', 'proceso', 'fk_usuario', 'gestion', 'activo', 'fk_documento', 'oficial'], 'integer'],
            [['nur', 'codigo', 'fecha', 'hora', 'fecha_registro', 'hora_registro'], 'safe'],
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
        $query = Hojasruta::find();

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

        $query->andFilterWhere(['ilike', 'nur', $this->nur])
            ->andFilterWhere(['ilike', 'codigo', $this->codigo]);

        return $dataProvider;
    }
    
    public function searchVentanilla($params)
    {
        //$query = Documentos::find()->where([ 'NOT IN' ,'codigo', Hojasruta::find()->select(['codigo'])->where(['=', 'activo', 1])]);
        
       /* $query=Hojasruta::find()
                            ->select('hojas_ruta.*')
                            ->joinWith('documentos')
                            ->where(['hojas_ruta.fk_documento' => 'documentos.id_documento'])
                            ->andWhere(['documentos.fk_tipo_documento' => 7])
                            ->andWhere(['documentos.activo' => 1]); */
                           
        /*$query = Hojasruta::find()
                        ->select('*')
                        ->joinWith('documentos','documentos.id_documento = hojas_ruta.fk_documento')
                        ->where(['documentos.fk_tipo_documento' => 7 ])
                        ->andWhere(['documentos.activo' => 1 ])
                        ->all();*/
        
        $query = Hojasruta::find();
        //$query->joinWith(['documentos']); 
        //$query->select("documentos.*");
        
        $usuario=Yii::$app->user->identity->id_usuario;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id_hoja_ruta' => SORT_DESC]],
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
            'fk_usuario' => $usuario,
            'gestion' => $this->gestion,
            //'gestion' => date('Y'),
            'activo' => 1,
            //'activo' => $this->activo,
            'fk_documento' => $this->fk_documento,
            'oficial' => $this->oficial,
        ]);

        $query->andFilterWhere(['ilike', 'nur', $this->nur])
            //->andFilterWhere(['NOT ilike', 'codigo', 'INF/%'])  
              ->andFilterWhere(['ilike', 'codigo', $this->codigo]);
            //->andFilterWhere(['=', 'documentos.id_documento', $this->fk_documento]);

        return $dataProvider;
    }
    
    public function searchReimprimirhs($params)
    {
        $usuario=Yii::$app->user->identity->id_usuario;
        
        $query = Hojasruta::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id_hoja_ruta' => SORT_DESC]],
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
            'nro' => 0,
            //'nro' => $this->nro,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
            'proceso' => $this->proceso,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            //'fk_usuario' => $this->fk_usuario,
            'fk_usuario' => $usuario,
            'gestion' => $this->gestion,
            'activo' => 1,
            //'activo' => $this->activo,
            'fk_documento' => $this->fk_documento,
            'oficial' => $this->oficial,
        ]);

        $query->andFilterWhere(['ilike', 'nur', $this->nur])
            ->andFilterWhere(['ilike', 'codigo', $this->codigo]);

        return $dataProvider;
    } // end function
    
    
    public function searchTramitessinderivar($params)
    {
        $usuario=Yii::$app->user->identity->id_usuario;
        
        
        
        //$query = Hojasruta::find();
        // CODIGO PARA COMPARAR DOS TABLAS Y QUE EL NURI DE HOJAS RUTA NO ESTE EN LOS SEGUIMIENTOS
        $query = Hojasruta::find()->where([ 'NOT IN' ,'nur', Seguimientos::find()->select(['codigo'])->where(['=', 'activo', 1])]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id_hoja_ruta' => SORT_DESC]],
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
            'nro' => 0,
            //'nro' => $this->nro,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
            'proceso' => $this->proceso,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            //'fk_usuario' => $this->fk_usuario,
            'fk_usuario' => $usuario,
            'gestion' => $this->gestion,
            'activo' => 1,
            //'activo' => $this->activo,
            'fk_documento' => $this->fk_documento,
            'oficial' => $this->oficial,
        ]);

        $query->andFilterWhere(['ilike', 'nur', $this->nur])
            ->andFilterWhere(['ilike', 'codigo', $this->codigo]);

        return $dataProvider;
    } // end function
    
    
    
} //FIN CLASS
