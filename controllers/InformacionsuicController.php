<?php

namespace app\controllers;

use Yii;
use app\models\Documentos;
use app\models\Informacionsuic;
use app\models\InformacionsuicSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\httpclient\Client;

/**
 * InformacionsuicController implements the CRUD actions for Informacionsuic model.
 */
class InformacionsuicController extends Controller
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
     * Lists all Informacionsuic models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InformacionsuicSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Informacionsuic model.
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
     * Creates a new Informacionsuic model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Informacionsuic();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_informacion_suic]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    
    public function actionCreatecarpetapago($id_informe, $id_carta)
    {
        $model = new Informacionsuic();

        if ($model->load(Yii::$app->request->post()) ) {
            
                $model->fecha_registro=date('Y-m-d');
                $model->hora_registro=date('H:i:s');
                $model->fk_usuario=Yii::$app->user->identity->id_usuario;
            	$model->activo=1;
                $id_carta_externa=$_POST['Informacionsuic']['activo'];
            
            if($model->save()){
                
                //CODIGO PARA ENVIAR LOS VALORES A TRAVES DE SERVICIO WEB AL SUIC
                $cite_informe=Documentos::getInformecartaexterna($model->nuri);
                
                $client = new Client();
                $response = $client->createRequest()
                    ->setMethod('POST')
                    ->setFormat(Client::FORMAT_JSON)
                    ->setUrl('http://10.0.10.12/WsTallerOrdenPago/controller/SincronizacionDatosControl.php?op=PostInsertNuri')
                    ->setData(['dCredencial'=>'WFOayG7j73BDR3434V45345as147', 'dIdOrdenPago'=>$model->fk_orden_pago+0, 'dIdTaller'=>$model->fk_taller+0, 'dNuri'=>$model->nuri, 'dCite'=>$cite_informe])
                    ->send();

                if ($response->isOk) {
                    //var_dump($response->data);
                    //echo "status -----> ".$response->data['status']; 
                    //echo "<br>FechaSincronizacionNuri -----> ".$response->data['FechaSincronizacionNuri'];
                    
                    if($response->data['status']=="ok"){
                        
                        // CODIGO PARA INSERTAR LA FECHA DE SINCRONIZACION CON EL SUIC
                        $carpetas=$this->findModel($model->id_informacion_suic);
                        $carpetas->fechasincronizacion=$response->data['FechaSincronizacionNuri'];
                        
                        if($carpetas->save()){
                            
                            Yii::$app->session->setFlash('success', "La <b>Orden de Pago</b> fue asociada correctamente al NURI <b>$model->nuri</b>  y registrada correctamente en el Sistema SUIC.");
                            return $this->redirect(['documentos/updatecartaexterna', 'id' => $id_carta_externa]);    
                        }
                        else{
                            Yii::$app->session->setFlash('error', "Error al registrar la información del Taller y Orden de Pago en el sistema, comuniquese con el administrador del Sistema S.A.C.");
                            //echo "ERROR AL ACTUALIZAR LA INFORMACION EN LA BASE DE INFORMACION SUIC";
                            print_r($model->getAttributes());
                            print_r($model->getErrors());
                            var_dump ($model->getErrors()); die();
                            //exit();
                        }
                        
                    }
                    else{
                        Yii::$app->session->setFlash('error', "Advertencia, el número de Orden de Pago no se encuentra disponible, comuniquese con el administrador del Sistema S.A.C.");
                        //echo "ERROR LA ORDEN DE PAGO NO SE ENCUENTRA DISPONIBLE";
                        //exit();
                    }
                    
                }
                else{
                    
                    Yii::$app->session->setFlash('error', "Error al ingresar la informacion del NURI y CITE en el sistema SUIC, comuniquese con el administrador del Sistema S.A.C.");
                    //echo "ERROR AL GUARDAR INFORMACION EN EL SUIC EN EL SERVICIO WEB";
                    //exit();
                }
                
                
            }    
        }

        return $this->render('carpetapago', [
            'model' => $model,
            'id_informe' => $id_informe,
            'id_carta' => $id_carta,
        ]);
    }
    
    
    // codigo para unir dos select2
    public function actionGetOrden($id){
        
        $id=$id+0; // codigo para convertir el valor de ID  a entero
        
        //echo "========> ".$id;
        //exit();
        
        // CODIGO PARA CONSUMIR UN SERVICIO DEL SISTEMA SUIC
        $client = new Client();
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setFormat(Client::FORMAT_JSON)
                ->setUrl('http://10.0.10.12/WsTallerOrdenPago/controller/SincronizacionDatosControl.php?op=PostOrdenPago')
                ->setData(['dCredencial' => 'WFOayG7j73BDR3434V45345as147',  'dIdTaller' => $id])
                ->send();

            if ($response->isOk) {
                // use your data

                foreach($response->data as $row){
                    echo "<br>".$row['CodigoOrdenPago']." => ".$row['TipoOrden'];

                    echo "<option value='".$row['IdOrdenPago']."'>".$row['CodigoOrdenPago']." - ".$row['TipoOrden']." FCV:".number_format($row['FCV'], 2, ',', '.')." FRC:".number_format($row['FRC'], 2, ',', '.')."</option>";
                }

            }
            else{
                echo "<option></option>";
            }

        
    /*    $total= \app\models\Areas::find()->where([
            'fk_regional'=>$id
        ])->count();
        
        $permisos= \app\models\Areas::find()->where([
                'fk_regional'=>$id
            ])->all();
        
        if($total>0){
            foreach($permisos as $key=>$value){
                
                echo "<option value='".$value->id_area."'>$value->area</option>";
            }
        }
        else{
            echo "<option></option>";
        }*/
        
    }

    /**
     * Updates an existing Informacionsuic model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_informacion_suic]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Informacionsuic model.
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
     * Finds the Informacionsuic model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Informacionsuic the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Informacionsuic::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
