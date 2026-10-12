<?php

namespace app\controllers;

use Yii;
use app\models\Hojasruta;
use app\models\HojasrutaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


use app\models\Documentos;
use app\models\Seguimientos;
/**
 * HojasrutaController implements the CRUD actions for Hojasruta model.
 */
class HojasrutaController extends Controller
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
     * Lists all Hojasruta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HojasrutaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionAdminventanilla()
    {
        $searchModel = new HojasrutaSearch();
        $dataProvider = $searchModel->searchVentanilla(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize=10;
        
        return $this->render('adminventanilla', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionReimprimirhojaruta()
    {
        $searchModel = new HojasrutaSearch();
        $dataProvider = $searchModel->searchReimprimirhs(Yii::$app->request->queryParams);
        
        $dataProvider->pagination->pageSize=10;

        return $this->render('reimprimirhojaruta', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionTramitessinderivar()
    {
        $searchModel = new HojasrutaSearch();
        $dataProvider = $searchModel->searchTramitessinderivar(Yii::$app->request->queryParams);
        
        $dataProvider->pagination->pageSize=10;

        return $this->render('tramitessinderivar', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Hojasruta model.
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
     * Creates a new Hojasruta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Hojasruta();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_hoja_ruta]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionAsignarpendiente($id)
    {
        $model = new Hojasruta();
        $documentos = Documentos::findOne($id);

        if ($model->load(Yii::$app->request->post())) {
            
            $seguimientos=Seguimientos::findOne($_POST['Hojasruta']['nro']);
            $model->oficial=$seguimientos->oficial;
            $model->nur=trim($seguimientos->codigo);
            
            //if($model->save()){
                
                switch ($documentos->fk_tipo_documento) {
                    case 1:
                        $direccion='documentos/updateinforme';
                        break;
                    case 2:
                        $direccion='documentos/updatenotainterna';
                        break;
                    case 3:
                        $direccion='documentos/updatememorandum';
                        break;
                    case 4:
                        $direccion='documentos/updatecarta';
                        break;
                    case 5:
                        $direccion='documentos/updatecircular';
                        break;
                    case 8:
                        $direccion='documentos/updateinstructivo';
                        break;
                }

                if($model->save()){
                    $this->redirect([$direccion,'id'=>$documentos->id_documento]);
                }
                
                //return $this->redirect(['view', 'id' => $model->id_hoja_ruta]);
            //}    
        }

        return $this->renderPartial('asignarpendiente', [
            'model' => $model,
            'documentos' => $documentos,
        ]);
    }
    
    
    public function actionAsignarnuricreado($id)
    {
        $model = new Hojasruta();
        $documentos = Documentos::findOne($id);

        if ($model->load(Yii::$app->request->post())) {
            
            //$seguimientos=Seguimientos::findOne($_POST['Hojasruta']['nro']);
            $model->oficial=1;
            $model->nro=0;
            //$model->nur=trim($seguimientos->codigo);
            
            //if($model->save()){
                
                switch ($documentos->fk_tipo_documento) {
                    case 1:
                        $direccion='documentos/updateinforme';
                        break;
                    case 2:
                        $direccion='documentos/updatenotainterna';
                        break;
                    case 3:
                        $direccion='documentos/updatememorandum';
                        break;
                    case 4:
                        $direccion='documentos/updatecarta';
                        break;
                    case 5:
                        $direccion='documentos/updatecircular';
                        break;
                    case 8:
                        $direccion='documentos/updateinstructivo';
                        break;
                }

                if($model->save()){
                    $this->redirect([$direccion,'id'=>$documentos->id_documento]);
                }
                
                //return $this->redirect(['view', 'id' => $model->id_hoja_ruta]);
            //}    
        }

        return $this->renderPartial('asignarnuricreado', [
            'model' => $model,
            'documentos' => $documentos,
        ]);
    }

    /**
     * Updates an existing Hojasruta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_hoja_ruta]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Hojasruta model.
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
     * Finds the Hojasruta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Hojasruta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Hojasruta::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
