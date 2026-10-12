<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Seguimientos;


use Yii;
/**
 * SeguimientosSearch represents the model behind the search form of `app\models\Seguimientos`.
 */
class SeguimientosSearch extends Seguimientos
{
    // funcion para exportar  la informacion de GRIDVIEW
    public function exportFields()
    {
        return [
            'id_seguimiento' => function ($model) {
                return $model->id_seguimiento;
            },
            'codigo',
            'region_id' => function ($model) {
                // @var $model GeoCity 
                if (isset($model->region->name_ru)) {
                    return $model->region->name_ru;
                }
                return false;
            },
            'proveido',
            'fecha_derivacion'
        ];
    } 
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_seguimiento', 'derivado_por', 'derivado_a', 'fk_accion', 'fk_estado', 'padre', 'oficial', 'gestion', 'confirmado', 'activo', 'fk_grupo_derivacion', 'fk_principal_agrupacion', 'observado', 'correlativo_copia'], 'integer'],
            [['codigo', 'proveido', 'fecha_derivacion', 'hora_derivacion', 'fecha_recepcion', 'hora_recepcion', 'hijo', 'fecha_registro', 'hora_registro', 'numero_copia', 'accion_archivo'], 'safe'],
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
        $query = Seguimientos::find();

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
            'id_seguimiento' => $this->id_seguimiento,
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
            'activo' => $this->activo,
            'fk_grupo_derivacion' => $this->fk_grupo_derivacion,
            'fk_principal_agrupacion' => $this->fk_principal_agrupacion,
            'observado' => $this->observado,
            'correlativo_copia' => $this->correlativo_copia,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'proveido', $this->proveido])
            ->andFilterWhere(['ilike', 'hijo', $this->hijo])
            ->andFilterWhere(['ilike', 'numero_copia', $this->numero_copia])
            ->andFilterWhere(['ilike', 'accion_archivo', $this->accion_archivo]);

        return $dataProvider;
    }
    
    
    public function searchbloqueo($params)
    {
        $query = Seguimientos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['fecha_derivacion' => SORT_ASC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        
        $estado=3;
	$activo=1;
	$confirmado=1;
	$destino=Yii::$app->user->identity->id_usuario;
        
        $fecha_fin=Seguimientos::restarDiasfecha(date('Y-m-d'),2);
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id_seguimiento' => $this->id_seguimiento,
            'derivado_por' => $this->derivado_por,
            //'derivado_a' => $this->derivado_a,
            'derivado_a' => $destino,
            'fecha_derivacion' => $this->fecha_derivacion,
            'hora_derivacion' => $this->hora_derivacion,
            'fecha_recepcion' => $this->fecha_recepcion,
            'hora_recepcion' => $this->hora_recepcion,
            'fk_accion' => $this->fk_accion,
            'fk_estado' => 3,
            //'fk_estado' => $this->fk_estado,
            'padre' => $this->padre,
            'oficial' => $this->oficial,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'gestion' => $this->gestion,
            'confirmado' => 1,
            //'confirmado' => $this->confirmado,
            'activo' => 1,
            //'activo' => $this->activo,
            'fk_grupo_derivacion' => $this->fk_grupo_derivacion,
            'fk_principal_agrupacion' => $this->fk_principal_agrupacion,
            'observado' => $this->observado,
            'correlativo_copia' => $this->correlativo_copia,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'proveido', $this->proveido])
            ->andFilterWhere(['<', 'fecha_derivacion', $fecha_fin])
            ->andFilterWhere(['ilike', 'hijo', $this->hijo])
            ->andFilterWhere(['ilike', 'numero_copia', $this->numero_copia])
            ->andFilterWhere(['ilike', 'accion_archivo', $this->accion_archivo]);

        return $dataProvider;
    }


    public function searchbloqueonorecibidos($params)
    {
        $query = Seguimientos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['fecha_derivacion' => SORT_ASC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        
        $estado=3;
    $activo=1;
    $confirmado=1;
    $remitente=Yii::$app->user->identity->id_usuario;
        
        $fecha_fin=Seguimientos::restarDiasfecha(date('Y-m-d'),1);
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id_seguimiento' => $this->id_seguimiento,
            //'derivado_por' => $this->derivado_por,
            'derivado_por' => $remitente,
            //'derivado_a' => $destino,
            'derivado_a' => $this->derivado_a,
            'fecha_derivacion' => $this->fecha_derivacion,
            'hora_derivacion' => $this->hora_derivacion,
            'fecha_recepcion' => $this->fecha_recepcion,
            'hora_recepcion' => $this->hora_recepcion,
            'fk_accion' => $this->fk_accion,
            'fk_estado' => 3,
            //'fk_estado' => $this->fk_estado,
            'padre' => $this->padre,
            'oficial' => $this->oficial,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'gestion' => $this->gestion,
            'confirmado' => 1,
            //'confirmado' => $this->confirmado,
            'activo' => 1,
            //'activo' => $this->activo,
            'fk_grupo_derivacion' => $this->fk_grupo_derivacion,
            'fk_principal_agrupacion' => $this->fk_principal_agrupacion,
            'observado' => $this->observado,
            'correlativo_copia' => $this->correlativo_copia,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'proveido', $this->proveido])
            ->andFilterWhere(['<=', 'fecha_derivacion', $fecha_fin])
            ->andFilterWhere(['ilike', 'hijo', $this->hijo])
            ->andFilterWhere(['ilike', 'numero_copia', $this->numero_copia])
            ->andFilterWhere(['ilike', 'accion_archivo', $this->accion_archivo]);
            //->andFilterWhere(['<', 'fecha_derivacion', $fecha_fin])

        return $dataProvider;
    }


    
    public function searchquedebenllegarbloque($params)
    {
        //$query = Seguimientos::find();
        $query = Seguimientos::find()->where([ 'NOT IN' ,'id_seguimiento', Recepciontemporal::find()->select(['fk_seguimiento'])->where(['=', 'fk_usuario', Yii::$app->user->identity->id_usuario])]);

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

        
        $estado=3;
	$activo=1;
	$confirmado=1;
	$destino=Yii::$app->user->identity->id_usuario;
        // grid filtering conditions
        $query->andFilterWhere([
            'id_seguimiento' => $this->id_seguimiento,
            'derivado_por' => $this->derivado_por,
            //'derivado_a' => $this->derivado_a,
            'derivado_a' => $destino,
            'fecha_derivacion' => $this->fecha_derivacion,
            'hora_derivacion' => $this->hora_derivacion,
            'fecha_recepcion' => $this->fecha_recepcion,
            'hora_recepcion' => $this->hora_recepcion,
            'fk_accion' => $this->fk_accion,
            'fk_estado' => 3,
            //'fk_estado' => $this->fk_estado,
            'padre' => $this->padre,
            'oficial' => $this->oficial,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'gestion' => $this->gestion,
            'confirmado' => 1,
            //'confirmado' => $this->confirmado,
            'activo' => 1,
            //'activo' => $this->activo,
            'fk_grupo_derivacion' => $this->fk_grupo_derivacion,
            'fk_principal_agrupacion' => $this->fk_principal_agrupacion,
            'observado' => $this->observado,
            'correlativo_copia' => $this->correlativo_copia,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'proveido', $this->proveido])
            ->andFilterWhere(['ilike', 'hijo', $this->hijo])
            ->andFilterWhere(['ilike', 'numero_copia', $this->numero_copia])
            ->andFilterWhere(['ilike', 'accion_archivo', $this->accion_archivo]);

        return $dataProvider;
    }
    
    
    public function searchquedebenllegar($params)
    {
        $query = Seguimientos::find();

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

        
        $estado=3;
	    $activo=1;
	    $confirmado=1;
	    $destino=Yii::$app->user->identity->id_usuario;
        // grid filtering conditions
        $query->andFilterWhere([
            'id_seguimiento' => $this->id_seguimiento,
            'derivado_por' => $this->derivado_por,
            //'derivado_a' => $this->derivado_a,
            'derivado_a' => $destino,
            'fecha_derivacion' => $this->fecha_derivacion,
            'hora_derivacion' => $this->hora_derivacion,
            'fecha_recepcion' => $this->fecha_recepcion,
            'hora_recepcion' => $this->hora_recepcion,
            'fk_accion' => $this->fk_accion,
            'fk_estado' => 3,
            //'fk_estado' => $this->fk_estado,
            'padre' => $this->padre,
            'oficial' => $this->oficial,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'gestion' => $this->gestion,
            'confirmado' => 1,
            //'confirmado' => $this->confirmado,
            'activo' => 1,
            //'activo' => $this->activo,
            'fk_grupo_derivacion' => $this->fk_grupo_derivacion,
            'fk_principal_agrupacion' => $this->fk_principal_agrupacion,
            'observado' => $this->observado,
            'correlativo_copia' => $this->correlativo_copia,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'proveido', $this->proveido])
            ->andFilterWhere(['ilike', 'hijo', $this->hijo])
            ->andFilterWhere(['ilike', 'numero_copia', $this->numero_copia])
            ->andFilterWhere(['ilike', 'accion_archivo', $this->accion_archivo]);

        return $dataProvider;
    }
    
    
    public function searchconfirmarderivacion($params)
    {
        $query = Seguimientos::find();

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

        
	//$destino=Yii::$app->user->identity->id_usuario;
        // grid filtering conditions
        $query->andFilterWhere([
            'id_seguimiento' => $this->id_seguimiento,
            'derivado_por' => $this->derivado_por,
            'derivado_a' => $this->derivado_a,
            //'derivado_a' => $destino,
            'fecha_derivacion' => $this->fecha_derivacion,
            'hora_derivacion' => $this->hora_derivacion,
            'fecha_recepcion' => $this->fecha_recepcion,
            'hora_recepcion' => $this->hora_recepcion,
            'fk_accion' => $this->fk_accion,
            'fk_estado' => 3,
            //'fk_estado' => $this->fk_estado,
            'padre' => $this->padre,
            'oficial' => $this->oficial,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'gestion' => $this->gestion,
            'confirmado' => 0,
            //'confirmado' => $this->confirmado,
            'activo' => 1,
            //'activo' => $this->activo,
            'fk_grupo_derivacion' => $this->fk_grupo_derivacion,
            'fk_principal_agrupacion' => $this->fk_principal_agrupacion,
            'observado' => $this->observado,
            'correlativo_copia' => $this->correlativo_copia,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'proveido', $this->proveido])
            ->andFilterWhere(['ilike', 'hijo', $this->hijo])
            ->andFilterWhere(['ilike', 'numero_copia', $this->numero_copia])
            ->andFilterWhere(['ilike', 'accion_archivo', $this->accion_archivo]);

        return $dataProvider;
    }
    
    public function searchconfirmarderivacionusuario($params)
    {
        $query = Seguimientos::find();

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

        
	//$destino=Yii::$app->user->identity->id_usuario;
        // grid filtering conditions
        $query->andFilterWhere([
            'id_seguimiento' => $this->id_seguimiento,
            'derivado_por' => Yii::$app->user->identity->id_usuario,
            'derivado_a' => $this->derivado_a,
            //'derivado_a' => $destino,
            'fecha_derivacion' => $this->fecha_derivacion,
            'hora_derivacion' => $this->hora_derivacion,
            'fecha_recepcion' => $this->fecha_recepcion,
            'hora_recepcion' => $this->hora_recepcion,
            'fk_accion' => $this->fk_accion,
            'fk_estado' => 3,
            //'fk_estado' => $this->fk_estado,
            'padre' => $this->padre,
            'oficial' => $this->oficial,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'gestion' => $this->gestion,
            'confirmado' => 0,
            //'confirmado' => $this->confirmado,
            'activo' => 1,
            //'activo' => $this->activo,
            'fk_grupo_derivacion' => $this->fk_grupo_derivacion,
            'fk_principal_agrupacion' => $this->fk_principal_agrupacion,
            'observado' => $this->observado,
            'correlativo_copia' => $this->correlativo_copia,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'proveido', $this->proveido])
            ->andFilterWhere(['ilike', 'hijo', $this->hijo])
            ->andFilterWhere(['ilike', 'numero_copia', $this->numero_copia])
            ->andFilterWhere(['ilike', 'accion_archivo', $this->accion_archivo]);

        return $dataProvider;
    }
    
    public function searchpendientesoficiales($params)
    {
        $query = Seguimientos::find();

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
        
        
        $estado=1;
	$activo=1;
	$confirmado=1;
	$oficial=1;
	$destino=Yii::$app->user->identity->id_usuario;
        
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id_seguimiento' => $this->id_seguimiento,
            'derivado_por' => $this->derivado_por,
            //'derivado_a' => $this->derivado_a,
            'derivado_a' => $destino,
            'fecha_derivacion' => $this->fecha_derivacion,
            'hora_derivacion' => $this->hora_derivacion,
            'fecha_recepcion' => $this->fecha_recepcion,
            'hora_recepcion' => $this->hora_recepcion,
            'fk_accion' => $this->fk_accion,
            'fk_estado' => 1,
            //'fk_estado' => $this->fk_estado,
            'padre' => $this->padre,
            'oficial' => $oficial,
            //'oficial' => $this->oficial,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'gestion' => $this->gestion,
            'confirmado' => 1,
            //'confirmado' => $this->confirmado,
            'activo' => 1,
            //'activo' => $this->activo,
            'fk_grupo_derivacion' => $this->fk_grupo_derivacion,
            'fk_principal_agrupacion' => $this->fk_principal_agrupacion,
            'observado' => $this->observado,
            'correlativo_copia' => $this->correlativo_copia,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'proveido', $this->proveido])
            ->andFilterWhere(['ilike', 'hijo', $this->hijo])
            ->andFilterWhere(['ilike', 'numero_copia', $this->numero_copia])
            ->andFilterWhere(['ilike', 'accion_archivo', $this->accion_archivo]);

        return $dataProvider;
    }
    
    
    public function searchpendientescopias($params)
    {
        $query = Seguimientos::find();

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
        
        
        $estado=2;
	$activo=1;
	$confirmado=1;
	$oficial=0;
	$destino=Yii::$app->user->identity->id_usuario;
        
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id_seguimiento' => $this->id_seguimiento,
            'derivado_por' => $this->derivado_por,
            //'derivado_a' => $this->derivado_a,
            'derivado_a' => $destino,
            'fecha_derivacion' => $this->fecha_derivacion,
            'hora_derivacion' => $this->hora_derivacion,
            'fecha_recepcion' => $this->fecha_recepcion,
            'hora_recepcion' => $this->hora_recepcion,
            'fk_accion' => $this->fk_accion,
            'fk_estado' => $estado,
            //'fk_estado' => $this->fk_estado,
            'padre' => $this->padre,
            'oficial' => $oficial,
            //'oficial' => $this->oficial,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'gestion' => $this->gestion,
            'confirmado' => 1,
            //'confirmado' => $this->confirmado,
            'activo' => 1,
            //'activo' => $this->activo,
            'fk_grupo_derivacion' => $this->fk_grupo_derivacion,
            'fk_principal_agrupacion' => $this->fk_principal_agrupacion,
            'observado' => $this->observado,
            'correlativo_copia' => $this->correlativo_copia,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'proveido', $this->proveido])
            ->andFilterWhere(['ilike', 'hijo', $this->hijo])
            ->andFilterWhere(['ilike', 'numero_copia', $this->numero_copia])
            ->andFilterWhere(['ilike', 'accion_archivo', $this->accion_archivo]);

        return $dataProvider;
    }
    
    
    public function searchpendientesbloque($params)
    {
        //$query = Seguimientos::find();
        $query = Seguimientos::find()->where([ 'NOT IN' ,'id_seguimiento', Derivaciontemporal::find()->select(['fk_seguimiento'])->where(['=', 'fk_usuario', Yii::$app->user->identity->id_usuario])]);

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
        
        
        $estado=1;
	$activo=1;
	$confirmado=1;
	$oficial=1;
	$destino=Yii::$app->user->identity->id_usuario;
        
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id_seguimiento' => $this->id_seguimiento,
            'derivado_por' => $this->derivado_por,
            //'derivado_a' => $this->derivado_a,
            'derivado_a' => $destino,
            'fecha_derivacion' => $this->fecha_derivacion,
            'hora_derivacion' => $this->hora_derivacion,
            'fecha_recepcion' => $this->fecha_recepcion,
            'hora_recepcion' => $this->hora_recepcion,
            'fk_accion' => $this->fk_accion,
            //'fk_estado' => 1,
            'fk_estado' => [1,2],
            'padre' => $this->padre,
            //'oficial' => $oficial,
            'oficial' => $this->oficial,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'gestion' => $this->gestion,
            'confirmado' => 1,
            //'confirmado' => $this->confirmado,
            'activo' => 1,
            //'activo' => $this->activo,
            'fk_grupo_derivacion' => $this->fk_grupo_derivacion,
            'fk_principal_agrupacion' => $this->fk_principal_agrupacion,
            'observado' => $this->observado,
            'correlativo_copia' => $this->correlativo_copia,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'proveido', $this->proveido])
            ->andFilterWhere(['ilike', 'hijo', $this->hijo])
            ->andFilterWhere(['ilike', 'numero_copia', $this->numero_copia])
            ->andFilterWhere(['ilike', 'accion_archivo', $this->accion_archivo]);

        return $dataProvider;
    }
    
    
    
    public function searchagrupaciones($params)
    {
        $query = Seguimientos::find();

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
        
        
        $estado=1;
	$activo=1;
	$confirmado=1;
	$oficial=1;
	//$destino=Yii::$app->user->identity->id_usuario;
        
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id_seguimiento' => $this->id_seguimiento,
            'derivado_por' => $this->derivado_por,
            //'derivado_a' => $this->derivado_a,
            'derivado_a' => Yii::$app->user->identity->id_usuario,
            'fecha_derivacion' => $this->fecha_derivacion,
            'hora_derivacion' => $this->hora_derivacion,
            'fecha_recepcion' => $this->fecha_recepcion,
            'hora_recepcion' => $this->hora_recepcion,
            'fk_accion' => $this->fk_accion,
            //'fk_estado' => 1,
            'fk_estado' => $this->fk_estado,
            'padre' => $this->padre,
            //'oficial' => $oficial,
            'oficial' => $this->oficial,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'gestion' => $this->gestion,
            'confirmado' => 1,
            //'confirmado' => $this->confirmado,
            'activo' => 1,
            //'activo' => $this->activo,
            'fk_grupo_derivacion' => $this->fk_grupo_derivacion,
            'fk_principal_agrupacion' => $this->fk_principal_agrupacion,
            'observado' => 1,
            //'observado' => $this->observado,
            'correlativo_copia' => $this->correlativo_copia,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'proveido', $this->proveido])
            ->andFilterWhere(['ilike', 'hijo', $this->hijo])
            ->andFilterWhere(['ilike', 'numero_copia', $this->numero_copia])
            ->andFilterWhere(['ilike', 'accion_archivo', $this->accion_archivo]);

        return $dataProvider;
    }
    
    
    public function searchderivadosa($params, $nuri)
    {
        $query = Seguimientos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['oficial' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        
        $estado=1;
	$activo=1;
	$confirmado=1;
	
	$origen=Yii::$app->user->identity->id_usuario;
        
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id_seguimiento' => $this->id_seguimiento,
            'derivado_por' => $origen,
            //'derivado_por' => $this->derivado_por,
            'derivado_a' => $this->derivado_a,
            //'derivado_a' => $destino,
            'fecha_derivacion' => $this->fecha_derivacion,
            'hora_derivacion' => $this->hora_derivacion,
            'fecha_recepcion' => $this->fecha_recepcion,
            'hora_recepcion' => $this->hora_recepcion,
            'fk_accion' => $this->fk_accion,
            'fk_estado' => 3,
            //'fk_estado' => $this->fk_estado,
            'padre' => $this->padre,
            'oficial' => $this->oficial,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'gestion' => $this->gestion,
            'confirmado' => 0,
            //'confirmado' => $this->confirmado,
            'activo' => 1,
            //'activo' => $this->activo,
            'fk_grupo_derivacion' => $this->fk_grupo_derivacion,
            'fk_principal_agrupacion' => $this->fk_principal_agrupacion,
            'observado' => $this->observado,
            'correlativo_copia' => $this->correlativo_copia,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $nuri])
            ->andFilterWhere(['ilike', 'proveido', $this->proveido])
            ->andFilterWhere(['ilike', 'hijo', $this->hijo])
            ->andFilterWhere(['ilike', 'numero_copia', $this->numero_copia])
            ->andFilterWhere(['ilike', 'accion_archivo', $this->accion_archivo]);

        return $dataProvider;
    }
    
    public function searchderivadosdestinobloque($params)
    {
        $query = Seguimientos::find();
        $query = Seguimientos::find()->where([ '=' ,'padre', Derivaciontemporal::find()->select(['fk_seguimiento'])->where(['=', 'fk_usuario', Yii::$app->user->identity->id_usuario])]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['oficial' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        

	$origen=Yii::$app->user->identity->id_usuario;
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id_seguimiento' => $this->id_seguimiento,
            'derivado_por' => $origen,
            //'derivado_por' => $this->derivado_por,
            'derivado_a' => $this->derivado_a,
            //'derivado_a' => $destino,
            'fecha_derivacion' => $this->fecha_derivacion,
            'hora_derivacion' => $this->hora_derivacion,
            'fecha_recepcion' => $this->fecha_recepcion,
            'hora_recepcion' => $this->hora_recepcion,
            'fk_accion' => $this->fk_accion,
            'fk_estado' => 3,
            //'fk_estado' => $this->fk_estado,
            'padre' => $this->padre,
            'oficial' => $this->oficial,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'gestion' => $this->gestion,
            'confirmado' => 0,
            //'confirmado' => $this->confirmado,
            'activo' => 1,
            //'activo' => $this->activo,
            'fk_grupo_derivacion' => $this->fk_grupo_derivacion,
            'fk_principal_agrupacion' => $this->fk_principal_agrupacion,
            'observado' => $this->observado,
            'correlativo_copia' => $this->correlativo_copia,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'proveido', $this->proveido])
            ->andFilterWhere(['ilike', 'hijo', $this->hijo])
            ->andFilterWhere(['ilike', 'numero_copia', $this->numero_copia])
            ->andFilterWhere(['ilike', 'accion_archivo', $this->accion_archivo]);

        return $dataProvider;
    }
    
   public function searchagrupartramites($params, $id_seguimiento)
    {
        $query = Seguimientos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['oficial' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        
       $estado=1;
	   $activo=1;
	   $confirmado=1;
	   $oficial=1;
	   $destino=Yii::$app->user->identity->id_usuario;
        
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id_seguimiento' => $this->id_seguimiento,
            'derivado_por' => $this->derivado_por,
            //'derivado_a' => $this->derivado_a,
            'derivado_a' => $destino,
            'fecha_derivacion' => $this->fecha_derivacion,
            'hora_derivacion' => $this->hora_derivacion,
            'fecha_recepcion' => $this->fecha_recepcion,
            'hora_recepcion' => $this->hora_recepcion,
            'fk_accion' => $this->fk_accion,
            'fk_estado' => array(1,2),
            //'fk_estado' => $this->fk_estado,
            'padre' => $this->padre,
            'oficial' => $this->oficial,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'gestion' => $this->gestion,
            'confirmado' => 1,
            //'confirmado' => $this->confirmado,
            'activo' => 1,
            //'activo' => $this->activo,
            'fk_grupo_derivacion' => $this->fk_grupo_derivacion,
            'fk_principal_agrupacion' => $this->fk_principal_agrupacion,
            'observado' => $this->observado,
            'correlativo_copia' => $this->correlativo_copia,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $this->codigo])
              ->andFilterWhere(['ilike', 'proveido', $this->proveido])
              ->andFilterWhere(['ilike', 'hijo', $this->hijo])
              ->andFilterWhere(['ilike', 'numero_copia', $this->numero_copia])
              ->andFilterWhere(['<>', 'id_seguimiento', $id_seguimiento])
              ->andFilterWhere(['ilike', 'accion_archivo', $this->accion_archivo]);

        return $dataProvider;
    }
    
    public function searchcorregirderivacion($params)
    {
        $query = Seguimientos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['fecha_derivacion' => SORT_DESC, 'hora_derivacion' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        
        $estado=1;
	$activo=1;
	$confirmado=1;
	$oficial=1;
	$origen=Yii::$app->user->identity->id_usuario;
        
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id_seguimiento' => $this->id_seguimiento,
            'derivado_por' => $origen,
            //'derivado_por' => $this->derivado_por,
            'derivado_a' => $this->derivado_a,
            //'derivado_a' => $destino,
            'fecha_derivacion' => $this->fecha_derivacion,
            'hora_derivacion' => $this->hora_derivacion,
            'fecha_recepcion' => $this->fecha_recepcion,
            'hora_recepcion' => $this->hora_recepcion,
            'fk_accion' => $this->fk_accion,
            'fk_estado' => 3,
            //'fk_estado' => $this->fk_estado,
            'padre' => $this->padre,
            'oficial' => $this->oficial,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'gestion' => $this->gestion,
            'confirmado' => 1,
            //'confirmado' => $this->confirmado,
            'activo' => 1,
            //'activo' => $this->activo,
            'fk_grupo_derivacion' => $this->fk_grupo_derivacion,
            'fk_principal_agrupacion' => $this->fk_principal_agrupacion,
            'observado' => $this->observado,
            'correlativo_copia' => $this->correlativo_copia,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'proveido', $this->proveido])
            ->andFilterWhere(['ilike', 'hijo', $this->hijo])
            ->andFilterWhere(['ilike', 'numero_copia', $this->numero_copia])
            ->andFilterWhere(['ilike', 'accion_archivo', $this->accion_archivo]);

        return $dataProvider;
    }
    
    public function searchdesarchivartramites($params)
    {
        $query = Seguimientos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id_seguimiento' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_seguimiento' => $this->id_seguimiento,
            'derivado_por' => $this->derivado_por,
            'derivado_a' => $this->derivado_a,
            //'derivado_a' => $destino,
            'fecha_derivacion' => $this->fecha_derivacion,
            'hora_derivacion' => $this->hora_derivacion,
            'fecha_recepcion' => $this->fecha_recepcion,
            'hora_recepcion' => $this->hora_recepcion,
            'fk_accion' => $this->fk_accion,
            'fk_estado' => [5,6],
            //'fk_estado' => $this->fk_estado,
            'padre' => $this->padre,
            'oficial' => $this->oficial,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'gestion' => $this->gestion,
            'confirmado' => 1,
            //'confirmado' => $this->confirmado,
            'activo' => 1,
            //'activo' => $this->activo,
            'fk_grupo_derivacion' => $this->fk_grupo_derivacion,
            'fk_principal_agrupacion' => $this->fk_principal_agrupacion,
            'observado' => $this->observado,
            'correlativo_copia' => $this->correlativo_copia,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'proveido', $this->proveido])
            ->andFilterWhere(['ilike', 'hijo', $this->hijo])
            ->andFilterWhere(['ilike', 'numero_copia', $this->numero_copia])
            ->andFilterWhere(['ilike', 'accion_archivo', $this->accion_archivo]);

        return $dataProvider;
    }
    
    
    
    
}// FIN CLASS
