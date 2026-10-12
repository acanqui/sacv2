<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Documentos;


use Yii;
/**
 * DocumentosSearch represents the model behind the search form of `app\models\Documentos`.
 */
class DocumentosSearch extends Documentos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_documento', 'gestion', 'fk_usuario', 'fk_tipo_documento', 'fk_estado_documento', 'fk_area', 'fk_documento', 'activo', 'usuario_destino', 'grupo_destino', 'fk_motivo', 'observado', 'fk_regional_suic', 'fk_taller_suic', 'fk_orden_pago_suic', 'carpeta_pago'], 'integer'],
            [['codigo', 'destinatario_titulo', 'destinatario_nombres', 'destinatario_cargo', 'destinatario_institucion', 'remitente_nombres', 'remitente_cargo', 'remitente_institucion', 'referencia', 'contenido', 'fecha', 'hora', 'adjuntos', 'copias', 'via_nombres', 'via_cargo', 'nro_hojas', 'fecha_registro', 'hora_registro', 'ruta_documento', 'nombre_grupo', 'enlace_nube'], 'safe'],
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
        $query = Documentos::find();

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
            'id_documento' => $this->id_documento,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
            'gestion' => $this->gestion,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'fk_usuario' => $this->fk_usuario,
            'fk_tipo_documento' => $this->fk_tipo_documento,
            'fk_estado_documento' => $this->fk_estado_documento,
            'fk_area' => $this->fk_area,
            'fk_documento' => $this->fk_documento,
            'activo' => $this->activo,
            'usuario_destino' => $this->usuario_destino,
            'grupo_destino' => $this->grupo_destino,
            'fk_motivo' => $this->fk_motivo,
            'observado' => $this->observado,
            'fk_regional_suic' => $this->fk_regional_suic,
            'fk_taller_suic' => $this->fk_taller_suic,
            'fk_orden_pago_suic' => $this->fk_orden_pago_suic,
            'carpeta_pago' => $this->carpeta_pago,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'destinatario_titulo', $this->destinatario_titulo])
            ->andFilterWhere(['ilike', 'destinatario_nombres', $this->destinatario_nombres])
            ->andFilterWhere(['ilike', 'destinatario_cargo', $this->destinatario_cargo])
            ->andFilterWhere(['ilike', 'destinatario_institucion', $this->destinatario_institucion])
            ->andFilterWhere(['ilike', 'remitente_nombres', $this->remitente_nombres])
            ->andFilterWhere(['ilike', 'remitente_cargo', $this->remitente_cargo])
            ->andFilterWhere(['ilike', 'remitente_institucion', $this->remitente_institucion])
            ->andFilterWhere(['ilike', 'referencia', $this->referencia])
            ->andFilterWhere(['ilike', 'contenido', $this->contenido])
            ->andFilterWhere(['ilike', 'adjuntos', $this->adjuntos])
            ->andFilterWhere(['ilike', 'copias', $this->copias])
            ->andFilterWhere(['ilike', 'via_nombres', $this->via_nombres])
            ->andFilterWhere(['ilike', 'via_cargo', $this->via_cargo])
            ->andFilterWhere(['ilike', 'nro_hojas', $this->nro_hojas])
            ->andFilterWhere(['ilike', 'ruta_documento', $this->ruta_documento])
            ->andFilterWhere(['ilike', 'nombre_grupo', $this->nombre_grupo])
            ->andFilterWhere(['ilike', 'enlace_nube', $this->enlace_nube]);

        return $dataProvider;
    }
    
    
    public function searchTipo($params, $gestion, $tipo)
    {
        $query = Documentos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id_documento' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_documento' => $this->id_documento,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
            //'gestion' => $this->gestion,
            'gestion' => $gestion,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            //'fk_usuario' => $this->fk_usuario,
            'fk_usuario' => Yii::$app->user->identity->id_usuario,
            'fk_tipo_documento' => $tipo,
            //'fk_tipo_documento' => $this->fk_tipo_documento,
            'fk_estado_documento' => $this->fk_estado_documento,
            'fk_area' => $this->fk_area,
            'fk_documento' => $this->fk_documento,
            //'activo' => $this->activo,
            'activo' => 1,
            'usuario_destino' => $this->usuario_destino,
            'grupo_destino' => $this->grupo_destino,
            'fk_motivo' => $this->fk_motivo,
            'observado' => $this->observado,
            'fk_regional_suic' => $this->fk_regional_suic,
            'fk_taller_suic' => $this->fk_taller_suic,
            'fk_orden_pago_suic' => $this->fk_orden_pago_suic,
            'carpeta_pago' => $this->carpeta_pago,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'destinatario_titulo', $this->destinatario_titulo])
            ->andFilterWhere(['ilike', 'destinatario_nombres', $this->destinatario_nombres])
            ->andFilterWhere(['ilike', 'destinatario_cargo', $this->destinatario_cargo])
            ->andFilterWhere(['ilike', 'destinatario_institucion', $this->destinatario_institucion])
            ->andFilterWhere(['ilike', 'remitente_nombres', $this->remitente_nombres])
            ->andFilterWhere(['ilike', 'remitente_cargo', $this->remitente_cargo])
            ->andFilterWhere(['ilike', 'remitente_institucion', $this->remitente_institucion])
            ->andFilterWhere(['ilike', 'referencia', $this->referencia])
            ->andFilterWhere(['ilike', 'contenido', $this->contenido])
            ->andFilterWhere(['ilike', 'adjuntos', $this->adjuntos])
            ->andFilterWhere(['ilike', 'copias', $this->copias])
            ->andFilterWhere(['ilike', 'via_nombres', $this->via_nombres])
            ->andFilterWhere(['ilike', 'via_cargo', $this->via_cargo])
            ->andFilterWhere(['ilike', 'nro_hojas', $this->nro_hojas])
            ->andFilterWhere(['ilike', 'ruta_documento', $this->ruta_documento])
            ->andFilterWhere(['ilike', 'nombre_grupo', $this->nombre_grupo])
            ->andFilterWhere(['ilike', 'enlace_nube', $this->enlace_nube]);

        return $dataProvider;
    }
    
    
    public function searchCite($params, $gestion, $tipo)
    {
        $query = Documentos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id_documento' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        //$area=Yii::$app->user->identity->fk_area;

        // grid filtering conditions
        $query->andFilterWhere([
            'id_documento' => $this->id_documento,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
            //'gestion' => $this->gestion,
            'gestion' => $gestion,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'fk_usuario' => $this->fk_usuario,
            //'fk_usuario' => Yii::$app->user->identity->id_usuario,
            'fk_tipo_documento' => $tipo,
            //'fk_tipo_documento' => $this->fk_tipo_documento,
            'fk_estado_documento' => $this->fk_estado_documento,
            'fk_area' => Yii::$app->user->identity->fk_area,
            'fk_documento' => $this->fk_documento,
            'activo' => 1,
            //'activo' => $this->activo,
            'usuario_destino' => $this->usuario_destino,
            'grupo_destino' => $this->grupo_destino,
            'fk_motivo' => $this->fk_motivo,
            'observado' => $this->observado,
            'fk_regional_suic' => $this->fk_regional_suic,
            'fk_taller_suic' => $this->fk_taller_suic,
            'fk_orden_pago_suic' => $this->fk_orden_pago_suic,
            'carpeta_pago' => $this->carpeta_pago,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'destinatario_titulo', $this->destinatario_titulo])
            ->andFilterWhere(['ilike', 'destinatario_nombres', $this->destinatario_nombres])
            ->andFilterWhere(['ilike', 'destinatario_cargo', $this->destinatario_cargo])
            ->andFilterWhere(['ilike', 'destinatario_institucion', $this->destinatario_institucion])
            ->andFilterWhere(['ilike', 'remitente_nombres', $this->remitente_nombres])
            ->andFilterWhere(['ilike', 'remitente_cargo', $this->remitente_cargo])
            ->andFilterWhere(['ilike', 'remitente_institucion', $this->remitente_institucion])
            ->andFilterWhere(['ilike', 'referencia', $this->referencia])
            ->andFilterWhere(['ilike', 'contenido', $this->contenido])
            ->andFilterWhere(['ilike', 'adjuntos', $this->adjuntos])
            ->andFilterWhere(['ilike', 'copias', $this->copias])
            ->andFilterWhere(['ilike', 'via_nombres', $this->via_nombres])
            ->andFilterWhere(['ilike', 'via_cargo', $this->via_cargo])
            ->andFilterWhere(['ilike', 'nro_hojas', $this->nro_hojas])
            ->andFilterWhere(['ilike', 'ruta_documento', $this->ruta_documento])
            ->andFilterWhere(['ilike', 'nombre_grupo', $this->nombre_grupo])
            ->andFilterWhere(['ilike', 'enlace_nube', $this->enlace_nube]);

        return $dataProvider;
    }
    
    
    public function searchDocumentosestado($params)
    {
        $query = Documentos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id_documento' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        //$area=Yii::$app->user->identity->fk_area;

        // grid filtering conditions
        $query->andFilterWhere([
            'id_documento' => $this->id_documento,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
            //'gestion' => $this->gestion,
            'gestion' => date('Y'),
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            //'fk_usuario' => $this->fk_usuario,
            'fk_usuario' => Yii::$app->user->identity->id_usuario,
            //'fk_tipo_documento' => $tipo,
            'fk_tipo_documento' => $this->fk_tipo_documento,
            //'fk_estado_documento' => [1,3,6],
            'fk_estado_documento' => $this->fk_estado_documento,
            'fk_area' => $this->fk_area,
            //'fk_area' => Yii::$app->user->identity->fk_area,
            'fk_documento' => $this->fk_documento,
            //'activo' => $this->activo,
            'activo' => 1,
            'usuario_destino' => $this->usuario_destino,
            'grupo_destino' => $this->grupo_destino,
            'fk_motivo' => $this->fk_motivo,
            'observado' => $this->observado,
            'fk_regional_suic' => $this->fk_regional_suic,
            'fk_taller_suic' => $this->fk_taller_suic,
            'fk_orden_pago_suic' => $this->fk_orden_pago_suic,
            'carpeta_pago' => $this->carpeta_pago,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'destinatario_titulo', $this->destinatario_titulo])
            ->andFilterWhere(['ilike', 'destinatario_nombres', $this->destinatario_nombres])
            ->andFilterWhere(['ilike', 'destinatario_cargo', $this->destinatario_cargo])
            ->andFilterWhere(['ilike', 'destinatario_institucion', $this->destinatario_institucion])
            ->andFilterWhere(['ilike', 'remitente_nombres', $this->remitente_nombres])
            ->andFilterWhere(['ilike', 'remitente_cargo', $this->remitente_cargo])
            ->andFilterWhere(['ilike', 'remitente_institucion', $this->remitente_institucion])
            ->andFilterWhere(['ilike', 'referencia', $this->referencia])
            ->andFilterWhere(['ilike', 'contenido', $this->contenido])
            ->andFilterWhere(['ilike', 'adjuntos', $this->adjuntos])
            ->andFilterWhere(['ilike', 'copias', $this->copias])
            ->andFilterWhere(['ilike', 'via_nombres', $this->via_nombres])
            ->andFilterWhere(['ilike', 'via_cargo', $this->via_cargo])
            ->andFilterWhere(['ilike', 'nro_hojas', $this->nro_hojas])
            ->andFilterWhere(['ilike', 'ruta_documento', $this->ruta_documento])
            ->andFilterWhere(['ilike', 'nombre_grupo', $this->nombre_grupo])
            ->andFilterWhere(['in', 'fk_estado_documento', [1,3,6]])
            ->andFilterWhere(['ilike', 'enlace_nube', $this->enlace_nube]);

        return $dataProvider;
    }
    
    public function searchSinNuri($params)
    {
        $usuario=Yii::$app->user->identity->id_usuario;
        
        
        //$queryss = Hojasruta::find()->where([ 'NOT IN' ,'nur', Seguimientos::find()->select(['codigo'])->where(['=', 'activo', 1])]);
        $query = Documentos::find()->where([ 'NOT IN' ,'codigo', Hojasruta::find()->select(['codigo'])->where(['=', 'activo', 1])]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id_documento' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_documento' => $this->id_documento,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
            'gestion' => $this->gestion,
            'fecha_registro' => $this->fecha_registro,
            'hora_registro' => $this->hora_registro,
            'fk_usuario' => $usuario,
            'fk_tipo_documento' => $this->fk_tipo_documento,
            'fk_estado_documento' => $this->fk_estado_documento,
            'fk_area' => $this->fk_area,
            'fk_documento' => $this->fk_documento,
            //'activo' => $this->activo,
            'activo' => 1,
            'usuario_destino' => $this->usuario_destino,
            'grupo_destino' => $this->grupo_destino,
            'fk_motivo' => $this->fk_motivo,
            'observado' => $this->observado,
            'fk_regional_suic' => $this->fk_regional_suic,
            'fk_taller_suic' => $this->fk_taller_suic,
            'fk_orden_pago_suic' => $this->fk_orden_pago_suic,
            'carpeta_pago' => $this->carpeta_pago,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'destinatario_titulo', $this->destinatario_titulo])
            ->andFilterWhere(['ilike', 'destinatario_nombres', $this->destinatario_nombres])
            ->andFilterWhere(['ilike', 'destinatario_cargo', $this->destinatario_cargo])
            ->andFilterWhere(['ilike', 'destinatario_institucion', $this->destinatario_institucion])
            ->andFilterWhere(['ilike', 'remitente_nombres', $this->remitente_nombres])
            ->andFilterWhere(['ilike', 'remitente_cargo', $this->remitente_cargo])
            ->andFilterWhere(['ilike', 'remitente_institucion', $this->remitente_institucion])
            ->andFilterWhere(['ilike', 'referencia', $this->referencia])
            ->andFilterWhere(['ilike', 'contenido', $this->contenido])
            ->andFilterWhere(['ilike', 'adjuntos', $this->adjuntos])
            ->andFilterWhere(['ilike', 'copias', $this->copias])
            ->andFilterWhere(['ilike', 'via_nombres', $this->via_nombres])
            ->andFilterWhere(['ilike', 'via_cargo', $this->via_cargo])
            ->andFilterWhere(['ilike', 'nro_hojas', $this->nro_hojas])
            ->andFilterWhere(['ilike', 'ruta_documento', $this->ruta_documento])
            ->andFilterWhere(['ilike', 'nombre_grupo', $this->nombre_grupo])
            ->andFilterWhere(['!=', 'fk_tipo_documento', 4])
            ->andFilterWhere(['ilike', 'enlace_nube', $this->enlace_nube]);

        return $dataProvider;
    }
    
    
} // FIN CLASS

