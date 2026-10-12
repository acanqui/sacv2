<?php

namespace app\controllers;

use Yii;
use app\models\Usuarios;
use app\models\Listaderivacion;
use app\models\UsuariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;




/**
 * UsuariosController implements the CRUD actions for Usuarios model.
 */
class UsuariosController extends Controller
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
     * Lists all Usuarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=10;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUsuariosarea($id_area)
    {
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->searcharea(Yii::$app->request->queryParams, $id_area);
        $dataProvider->pagination->pageSize=10;

        return $this->render('usuariosarea', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionPendientesusuario()
    {
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->searchPendientesArea(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=10;

        return $this->render('pendientesusuario', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

     public function actionPendientesnacional()
    {
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->searchPendientesnacional(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=10;

        return $this->render('pendientesnacional', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionListaderivacion()
    {
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->searchListaDerivacion(Yii::$app->request->queryParams);
        
        
        $dataProvider->pagination->pageSize=7;

        return $this->render('listaderivacion', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuarios model.
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
     * Creates a new Usuarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuarios();

        if ($model->load(Yii::$app->request->post())) {
            
            $model->password="0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8";
            $model->correo=$_POST['Usuarios']['usuario']."@eecgnv.gob.bo";
            $model->fecha_registro=date('Y-m-d');
            $model->hora_registro=date('H:i:s');
            $model->usuario_archivo=0;
            $model->activo=1;
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id_usuario]);
            }    
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionAddlistderivar($id_usuario_destino){
        
	$usuario=Yii::$app->user->identity->id_usuario;
        
        $count = Listaderivacion::find()->where([
            'usuario_origen'=>$usuario,
            'usuario_destino'=>$id_usuario_destino,
            'activo'=>1, ])->count();

	if ($count==0) {
            
            $model = new Listaderivacion();
            $model->usuario_origen=$usuario;
            $model->usuario_destino=$id_usuario_destino;
            $model->activo=1;
            
            if($model->save()){
                Yii::$app->session->setFlash('success', "El usuario fue añadido correctamente a la <b>Lista de Derivación</b>.");
                $this->redirect(['listaderivacion']);
            }
             else{
                Yii::$app->session->setFlash('error', "Error al eliminar el registro, comuniquese con el administrador del Sistema S.A.C.");
                echo print_r($model->getErrors());
            }
            
            
	}
        else{
                Yii::$app->session->setFlash('warning', "El usuario ya se encuentra registrado en la <b>Lista de Derivación</b>.");
                $this->redirect(['listaderivacion']);
            }
    }
    public function actionDeletelistderivar($id_lista_derivacion){
            
            $model = Listaderivacion::findOne($id_lista_derivacion);
            $model->activo=0;
            
            if($model->save()){
                Yii::$app->session->setFlash('success', "El usuario fue eliminado correctamente de la <b>Lista de Derivación</b>.");
                $this->redirect(['listaderivacion']);
            }else{
                Yii::$app->session->setFlash('error', "Error al eliminar el registro, comuniquese con el administrador del Sistema S.A.C.");
                $this->redirect(['listaderivacion']);
            }
            
            
            
    }

    /**
     * Updates an existing Usuarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_usuario]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    public function actionCambiarcontrasena()
    {
        $model = $this->findModel(Yii::$app->user->identity->id_usuario);

        if ($model->load(Yii::$app->request->post())) {
            
            $model->password=hash('sha512',$_POST['Usuarios']['password']);

            $model->update_password=date('Y-m-d H:i:s');
            
            if($model->save()){
                Yii::$app->session->setFlash('success', "La contraseña del usuario: <b>".Yii::$app->user->identity->usuario."</b> fue cambiada correctamente.");
                return $this->redirect(['cambiarcontrasena']);
            }
            else{
                Yii::$app->session->setFlash('error', "Error al cambiar la contraseña.");

                print_r($model->getAttributes());
                    print_r($model->getErrors());
                    var_dump ($model->getErrors()); die();
                    exit();
            }
        }

        return $this->render('cambiarcontrasena', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Usuarios model.
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
    
   public function actionBajausuario($id)
    {
        //$this->findModel($id)->delete();
         $model = $this->findModel($id);
         
         if($model->activo==1)
         { $model->activo=0; }
         else
         { $model->activo=1; }
            
         
         
         if($model->save()){
             return $this->redirect(['index']);
         }
         else{
             echo "error";
         }
           
    }
    
   public function actionResetearpassword($id)
   {
        //$this->findModel($id)->delete();
         $model = $this->findModel($id);
         $model->password="0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8";
         if($model->save()){
             //echo "prueba";
             //exit();
             return $this->redirect(['index']);
         }
         else{
             echo "error";
             exit();
         }
           
   }
   
   

    /**
     * Finds the Usuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuarios::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
