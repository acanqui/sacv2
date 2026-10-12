<?php

namespace app\controllers;

use Yii;
use app\models\Alias;
use app\models\AliasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AliasController implements the CRUD actions for Alias model.
 */
class AliasController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Alias models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AliasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Alias model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Alias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Alias();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_alias]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionFormaddresponsable($id)
    {
        
        //echo "====> ".$id;
        //exit();
        
        $model = new Alias();

        if ($model->load(Yii::$app->request->post())) {
            
            $usuario=Yii::$app->user->identity->id_usuario;

            $model->nombre = strtoupper($model->nombre);
            $model->cargo = strtoupper($model->cargo);
            
            $model->descripcion=strtoupper($model->descripcion);
            $model->fecha_registro=date('Y-m-d');
            $model->hora_registro=date('H:i:s');
            $model->fk_usuario=$id;
            $model->activo=1;
            
            // CODIGO PARA DAR DE BAJA TODOS LOS REGISTROS ANTERIORES
            Yii::$app->db->createCommand("UPDATE alias SET activo=0 WHERE fk_usuario=$id ")->execute();
            
            if($model->save()){
                return $this->redirect(['usuarios/index']);
            }
            
            
        }

        return $this->renderPartial('formaddresponsable', [
            'model' => $model,
            //'id_usuario' => $id,
        ]);
    }

    /**
     * Updates an existing Alias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_alias]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Alias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Alias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Alias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Alias::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
