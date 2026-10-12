<?php

namespace app\controllers;

use Yii;
use app\models\Carpetaarchivo;
use app\models\CarpetaarchivoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CarpetaarchivoController implements the CRUD actions for Carpetaarchivo model.
 */
class CarpetaarchivoController extends Controller
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
     * Lists all Carpetaarchivo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CarpetaarchivoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Carpetaarchivo model.
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
     * Creates a new Carpetaarchivo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Carpetaarchivo();

        if ($model->load(Yii::$app->request->post())) {
            
            
            $model->nombre_carpeta=$_POST['Carpetaarchivo']['nombre_carpeta'];
            $model->fecha_registro=date('Y-m-d');
            $model->hora_registro=date('H:i:s');
            $model->activo=1;
            $model->fk_usuario=Yii::$app->user->identity->id_usuario;
            $model->fk_area=Yii::$app->user->identity->fk_area;
            
            
            if($model->save()){
                Yii::$app->session->setFlash('success', "El nombre de la Carpeta se registró correctamente.");
                //return $this->redirect(['view', 'id' => $model->id_carpeta_archivo]);
                return $this->redirect(['index']);
            }
            else{
                Yii::$app->session->setFlash('error', "Error al registrar el nombre de la Carpeta, comuniquese con el administrador del Sistema S.A.C.");
                print_r($model->getAttributes());
                print_r($model->getErrors());
                var_dump ($model->getErrors()); die();
                //echo "error";
            }
            
            
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Carpetaarchivo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            
            $model->nombre_carpeta=$_POST['Carpetaarchivo']['nombre_carpeta'];
            
            if($model->save()){    
                Yii::$app->session->setFlash('success', "El nombre de la Carpeta se modificó correctamente.");
                //return $this->redirect(['view', 'id' => $model->id_carpeta_archivo]);
                return $this->redirect(['index']);
            }
            else{
                Yii::$app->session->setFlash('error', "Error al modificar el nombre de la Carpeta, comuniquese con el administrador del Sistema S.A.C.");
                print_r($model->getAttributes());
                print_r($model->getErrors());
                var_dump ($model->getErrors()); die();
                //echo "error";
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Carpetaarchivo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        /*$this->findModel($id)->delete();
        return $this->redirect(['index']);*/
        
        $model = $this->findModel($id);
         
         if($model->activo==1)
         { $model->activo=0; }
         else
         { $model->activo=1; }
            
         
         
         if($model->save()){
             Yii::$app->session->setFlash('success', "la Carpeta se eliminó correctamente.");
             return $this->redirect(['index']);
         }
         else{
                Yii::$app->session->setFlash('error', "Error al eliminar la Carpeta, comuniquese con el administrador del Sistema S.A.C.");
                print_r($model->getAttributes());
                print_r($model->getErrors());
                var_dump ($model->getErrors()); die();
         }
    }

    /**
     * Finds the Carpetaarchivo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Carpetaarchivo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Carpetaarchivo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
