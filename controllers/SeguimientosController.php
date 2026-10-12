<?php

namespace app\controllers;

use Yii;
use app\models\Seguimientos;
use app\models\SeguimientosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use kartik\mpdf\Pdf;
use app\models\Documentos;
use app\models\Agrupaciones;
use app\models\Usuarios;
use app\models\Hojasruta;
use app\models\Derivaciontemporal;
use app\models\Recepciontemporal;
use app\models\Areas;

/**
 * SeguimientosController implements the CRUD actions for Seguimientos model.
 */
class SeguimientosController extends Controller
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
     * Lists all Seguimientos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SeguimientosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=10;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionAdminbloqueo()
    {
        $searchModel = new SeguimientosSearch();
        $dataProvider = $searchModel->searchbloqueo(Yii::$app->request->queryParams);
        
        
        $session = Yii::$app->session;
        $session->open();
        $session['query_params'] = json_encode(Yii::$app->request->queryParams);
        $session->close();
        
        
        $dataProvider->pagination->pageSize=10;

        return $this->render('adminbloqueo', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAdminbloqueonorecibidos()
    {
        $searchModel = new SeguimientosSearch();
        $dataProvider = $searchModel->searchbloqueonorecibidos(Yii::$app->request->queryParams);
        
        
        $session = Yii::$app->session;
        $session->open();
        $session['query_params'] = json_encode(Yii::$app->request->queryParams);
        $session->close();
        
        
        $dataProvider->pagination->pageSize=10;

        return $this->render('adminbloqueonorecibidos', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    
    public function actionQuedebenllegar()
    {
        $searchModel = new SeguimientosSearch();
        $dataProvider = $searchModel->searchquedebenllegar(Yii::$app->request->queryParams);
        
        
        $session = Yii::$app->session;
        $session->open();
        $session['query_params'] = json_encode(Yii::$app->request->queryParams);
        $session->close();
        
        
        $dataProvider->pagination->pageSize=10;

        return $this->render('quedebenllegar', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    
    
    public function actionAdminconfirmarderivacionusuario()
    {
        $searchModel = new SeguimientosSearch();
        $dataProvider = $searchModel->searchconfirmarderivacionusuario(Yii::$app->request->queryParams);
        
        
        $session = Yii::$app->session;
        $session->open();
        $session['query_params'] = json_encode(Yii::$app->request->queryParams);
        $session->close();
        
        
        $dataProvider->pagination->pageSize=10;

        return $this->render('adminconfirmarderivacionusuario', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionAdminconfirmarderivacion()
    {
        $searchModel = new SeguimientosSearch();
        $dataProvider = $searchModel->searchconfirmarderivacion(Yii::$app->request->queryParams);
        
        
        $session = Yii::$app->session;
        $session->open();
        $session['query_params'] = json_encode(Yii::$app->request->queryParams);
        $session->close();
        
        
        $dataProvider->pagination->pageSize=10;

        return $this->render('adminconfirmarderivacion', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    
    public function actionQuedebenllegarbloque()
    {
        $searchModel = new SeguimientosSearch();
        $dataProvider = $searchModel->searchquedebenllegarbloque(Yii::$app->request->queryParams);
        
        
        $session = Yii::$app->session;
        $session->open();
        $session['query_params'] = json_encode(Yii::$app->request->queryParams);
        $session->close();
        
        
        $dataProvider->pagination->pageSize=10;

        return $this->render('quedebenllegarbloque', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    
    public function actionPendientesoficiales()
    {
        $searchModel = new SeguimientosSearch();
        $dataProvider = $searchModel->searchpendientesoficiales(Yii::$app->request->queryParams);
        
        $session = Yii::$app->session;
        $session->open();
        $session['query_params'] = json_encode(Yii::$app->request->queryParams);
        $session->close();
        
        $dataProvider->pagination->pageSize=10;

        return $this->render('pendientesoficiales', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionPendientescopias()
    {
        $searchModel = new SeguimientosSearch();
        $dataProvider = $searchModel->searchpendientescopias(Yii::$app->request->queryParams);
        
        
        $session = Yii::$app->session;
        $session->open();
        $session['query_params'] = json_encode(Yii::$app->request->queryParams);
        $session->close();
        
        $dataProvider->pagination->pageSize=10;

        return $this->render('pendientescopias', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionPendientesbloque()
    {
        $searchModel = new SeguimientosSearch();
        $dataProvider = $searchModel->searchpendientesbloque(Yii::$app->request->queryParams);
        
        $session = Yii::$app->session;
        $session->open();
        $session['query_params'] = json_encode(Yii::$app->request->queryParams);
        $session->close();
        
        $dataProvider->pagination->pageSize=10;

        return $this->render('pendientesbloque', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    
    public function actionAdmindesagrupar()
    {
        $searchModel = new SeguimientosSearch();
        $dataProvider = $searchModel->searchagrupaciones(Yii::$app->request->queryParams);
        
        $session = Yii::$app->session;
        $session->open();
        $session['query_params'] = json_encode(Yii::$app->request->queryParams);
        $session->close();
        
        $dataProvider->pagination->pageSize=10;

        return $this->render('admindesagrupar', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    //agrupartramites
    
    public function actionAgrupartramites($id)
    {
     
        $model = $this->findModel($id);
        $searchModel = new SeguimientosSearch();
        $dataProvider = $searchModel->searchagrupartramites(Yii::$app->request->queryParams, $model->id_seguimiento);
        
        $dataProvider->pagination->pageSize=6;

        return $this->render('agrupartramites', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'seguimiento' => $model,
        ]);
    }
    
    public function actionCorregirderivacion()
    {
        $searchModel = new SeguimientosSearch();
        $dataProvider = $searchModel->searchcorregirderivacion(Yii::$app->request->queryParams);
        
        $dataProvider->pagination->pageSize=10;

        return $this->render('corregirderivacion', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /*public function actionDesarchivartramites()
    {
        $searchModel = new SeguimientosSearch();
        $dataProvider = $searchModel->searchdesarchivartramites(Yii::$app->request->queryParams);
        
        
        $session = Yii::$app->session;
        $session->open();
        $session['query_params'] = json_encode(Yii::$app->request->queryParams);
        $session->close();
        
        
        $dataProvider->pagination->pageSize=10;

        return $this->render('desarchivartramites', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/

    /**
     * Displays a single Seguimientos model.
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
    
    public function actionDesagrupar($id)
    {
        return $this->render('desagrupar', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionActasrecepcion()
    {
        return $this->render('actasrecepcion');
    }



    public function actionActasrecepciongeneral()
    {
        $model = new Seguimientos();
        return $this->render('actasrecepciongeneral',
            [
            'model' => $model,
            ]
        );
    }

    
    

    /**
     * Creates a new Seguimientos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Seguimientos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_seguimiento]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Seguimientos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_seguimiento]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    
    public function actionFormcorregirderivacionadmin($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->id_seguimiento]);
            
            //return $this->redirect(['derivarpendiente', 'id'=>$model->id_seguimiento]);
            if($model->save()){
                Yii::$app->session->setFlash('success', "Los datos de la <b>derivación/envió</b> fueron modificados correctamente.");
                return $this->redirect(['corregirderivacion']);
            }
            else{
                    Yii::$app->session->setFlash('error', "Error al modificar los datos de la <b>derivación/envió</b>, comuniquese con el administrador del Sistema S.A.C.");
                    print_r($model->getAttributes());
                    print_r($model->getErrors());
                    var_dump ($model->getErrors()); die();
            }
        }

        return $this->renderPartial('formcorregirderivacion', [
            'model' => $model,
        ]);
    }
    
    public function actionFormcorregirderivacion($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            //return $this->redirect(['view', 'id' => $model->id_seguimiento]);
            if($model->save()){
                Yii::$app->session->setFlash('success', "Los datos de la <b>derivación/envió</b> fueron modificados correctamente.");
                return $this->redirect(['derivarpendiente', 'id'=>$model->id_seguimiento]);
            }
            else{
                    Yii::$app->session->setFlash('error', "Error al modificar los datos de la <b>derivación/envió</b>, comuniquese con el administrador del Sistema S.A.C.");
                    print_r($model->getAttributes());
                    print_r($model->getErrors());
                    var_dump ($model->getErrors()); die();
            }
        }

        return $this->renderPartial('formcorregirderivacion', [
            'model' => $model,
        ]);
    }
    
    public function actionFormcorregirderivaciondocumento($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->id_seguimiento]);
            $id_documento=Seguimientos::obtenerIdDocumento($model->codigo);
            
            if($model->save()){
                Yii::$app->session->setFlash('success', "Los datos de la <b>derivación/envió</b> fueron modificados correctamente.");
                return $this->redirect(['derivardocumento', 'id_documento'=>$id_documento]);
            }
            else{
                    Yii::$app->session->setFlash('error', "Error al modificar los datos de la <b>derivación/envió</b>, comuniquese con el administrador del Sistema S.A.C.");
                    print_r($model->getAttributes());
                    print_r($model->getErrors());
                    var_dump ($model->getErrors()); die();
            }
        }

        return $this->renderPartial('formcorregirderivaciondocumento', [
            'model' => $model,
        ]);
    }
    
    public function actionReestablecerderivacion($id)
    {

        $model = $this->findModel($id);

		if ($model->padre==0) {
			// codigo para documentos nuevos, generados por el usuario
			// primero contamos los nuris derivados
			$derivados=Seguimientos::countDerivados($model->codigo, 0);
			// segundo contamos los que no estan recepcionados,
			// deberia ser igual a la cantidad de derivados
			$no_recibidos=Seguimientos::countNoRecepcionados($model->codigo, 0);

			if ($derivados==$no_recibidos) {
				// codigo para cambiar el estado de las derivaciones
				Seguimientos::updateReestablecerNuevo($model->codigo);
				//Seguimientos::mensajeExitoReestablecer($model->codigo);
			}
			else{
				//Seguimientos::mensajeErrorReestablecer($model->codigo);
                            //echo "error";
                            Yii::$app->session->setFlash('error', "Error al rrestablecer al derivación del tramite, comuniquese con el administrador del Sistema S.A.C.");
                            print_r($model->getAttributes());
                            print_r($model->getErrors());
                            $this->redirect(['corregirderivacion']);
			}

  		}
  		else{

  			// CODIGO PARA REESTABLECER SOLO NURI PENDIENTES
  			// primero contamos los nuris derivados
			$derivados=Seguimientos::countDerivados($model->codigo, $model->padre);
			// segundo contamos los que no estan recepcionados,
			// deberia ser igual a la cantidad de derivados
			$no_recibidos=Seguimientos::countNoRecepcionados($model->codigo, $model->padre);

			if ($derivados==$no_recibidos) {
				// codigo para cambiar el estado de las derivaciones
				Seguimientos::updateReestablecerPendiente($model->codigo,$model->padre);
				//Seguimientos::mensajeExitoReestablecer($model->codigo);
			}
			else{
				//Seguimientos::mensajeErrorReestablecer($model->codigo);
                            Yii::$app->session->setFlash('error', "Error al rrestablecer al derivación del tramite, comuniquese con el administrador del Sistema S.A.C.");
                            print_r($model->getAttributes());
                            print_r($model->getErrors());
                            $this->redirect(['corregirderivacion']);
                            //echo "error";
                            //exit();
			}

  		}
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

        Yii::$app->session->setFlash('success', "La derivación del trámite <b>".$model->codigo."</b>, fue reestablecida correctamente.");    
		$this->redirect(['corregirderivacion']);

    }

    public function actionReestablecerderivacionnorecibidos($id)
    {

        $model = $this->findModel($id);

        if ($model->padre==0) {
            // codigo para documentos nuevos, generados por el usuario
            // primero contamos los nuris derivados
            $derivados=Seguimientos::countDerivados($model->codigo, 0);
            // segundo contamos los que no estan recepcionados,
            // deberia ser igual a la cantidad de derivados
            $no_recibidos=Seguimientos::countNoRecepcionados($model->codigo, 0);

            if ($derivados==$no_recibidos) {
                // codigo para cambiar el estado de las derivaciones
                Seguimientos::updateReestablecerNuevo($model->codigo);
                //Seguimientos::mensajeExitoReestablecer($model->codigo);
            }
            else{
                //Seguimientos::mensajeErrorReestablecer($model->codigo);
                            //echo "error";
                            Yii::$app->session->setFlash('error', "Error al rrestablecer al derivación del tramite, comuniquese con el administrador del Sistema S.A.C.");
                            print_r($model->getAttributes());
                            print_r($model->getErrors());
                            $this->redirect(['adminbloqueonorecibidos']);
            }

        }
        else{

            // CODIGO PARA REESTABLECER SOLO NURI PENDIENTES
            // primero contamos los nuris derivados
            $derivados=Seguimientos::countDerivados($model->codigo, $model->padre);
            // segundo contamos los que no estan recepcionados,
            // deberia ser igual a la cantidad de derivados
            $no_recibidos=Seguimientos::countNoRecepcionados($model->codigo, $model->padre);

            if ($derivados==$no_recibidos) {
                // codigo para cambiar el estado de las derivaciones
                Seguimientos::updateReestablecerPendiente($model->codigo,$model->padre);
                //Seguimientos::mensajeExitoReestablecer($model->codigo);
            }
            else{
                //Seguimientos::mensajeErrorReestablecer($model->codigo);
                            Yii::$app->session->setFlash('error', "Error al rrestablecer al derivación del tramite, comuniquese con el administrador del Sistema S.A.C.");
                            print_r($model->getAttributes());
                            print_r($model->getErrors());
                            $this->redirect(['adminbloqueonorecibidos']);
                            //echo "error";
                            //exit();
            }

        }
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        Yii::$app->session->setFlash('success', "La derivación del trámite <b>".$model->codigo."</b>, fue reestablecida correctamente.");    
        $this->redirect(['adminbloqueonorecibidos']);

    }

    /**
     * Deletes an existing Seguimientos model.
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
     * Finds the Seguimientos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Seguimientos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Seguimientos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionConfirmarderivacion($id)
    {
        $model=$this->findModel($id);
        $nuri=$model->codigo;
        $model->confirmado=1;
                
        if($model->save()){
            Yii::$app->session->setFlash('success', "El <b>envio/derivación</b> del trámite <b>".$nuri."</b>, fue confirmado correctamente.");
            return $this->redirect(['adminconfirmarderivacion']);
        }
        else{
            //echo "ERROR";
            Yii::$app->session->setFlash('error', "Error al confirmar la derivación del tramite <b>".$nuri."</b>, comuniquese con el administrador del Sistema S.A.C.");
            print_r($model->getAttributes());
            print_r($model->getErrors());
            var_dump ($model->getErrors()); die();
        }        

        
    }
    
    public function actionConfirmarderivacionusuario($id)
    {
        $model=$this->findModel($id);
        $nuri=$model->codigo;
        $model->confirmado=1;
                
        if($model->save()){
            Yii::$app->session->setFlash('success', "El envio del trámite <b>".$nuri."</b>, fue confirmado correctamente.");
            return $this->redirect(['adminconfirmarderivacionusuario']);
        }
        else{
            //echo "ERROR";
            Yii::$app->session->setFlash('error', "Error al confirmar la derivación del tramite <b>".$nuri."</b>, comuniquese con el administrador del Sistema S.A.C.");
            print_r($model->getAttributes());
            print_r($model->getErrors());
            var_dump ($model->getErrors()); die();
        }        

        
    }
    
    public function actionSeguimientonuri($nuri)
    {
	$nuri=trim($nuri);

        return $this->render('seguimientonuri',array(
			'nuri'=>$nuri,
	));
    }
    
    
    public function actionActualizar($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }
    
    
    
    public function actionVerescaneadopdf($id) {
        
        $model = Documentos::findOne($id);

        // This will need to be the path relative to the root of your app.
        $filePath = '/uploads/'.$model->gestion;
        // Might need to change '@app' for another alias
        $completePath = Yii::getAlias('./'.$filePath.'/'.$model->ruta_documento);
        //$completePath = Yii::getAlias('@app'.$filePath.'/'.$model->ruta_documento);

        return Yii::$app->response->sendFile($completePath, $model->ruta_documento, ['inline'=>true]);
    }
    
    
    
    public function actionRecibirdocumento($id_seguimiento) {

            
            /*$model = User::find($id);
            $model->name = 'YII';
            $model->email = 'yii2@framework.com';
            $model->save();*/


        
                
             $model = Seguimientos::findOne($id_seguimiento);
             
             //print($model);
             //exit();

		if ($model->oficial==1) {
				$model->fk_estado=1;
				$model->confirmado=1;
				$model->fecha_recepcion=date('Y-m-d');
				$model->hora_recepcion=date('H:i:s');
		}
		else{
			if ($model->oficial==0) {
				$model->fk_estado=2;
				$model->confirmado=1;
				$model->fecha_recepcion=date('Y-m-d');
				$model->hora_recepcion=date('H:i:s');
			}
			else{
				$model->fk_estado=3;
				$model->confirmado=1;
				echo "Error de recepción por favor consulte con el administrador";
                                //exit();
			}
		}


		//$user = User::model()->findByPk($userId);
        if($model->save())
        {
            Yii::$app->session->setFlash('success', "El trámite <b>".$model->codigo."</b>, fue recibido correctamente.");
            return $this->redirect(['quedebenllegar']);
        }
        else{
            //echo "error al actualizar la informacion ";
            //exit();
            Yii::$app->session->setFlash('error', "Error al recibir el tramite <b>".$model->codigo."</b>, comuniquese con el administrador del Sistema S.A.C.");
            print_r($model->getAttributes());
            print_r($model->getErrors());
            var_dump ($model->getErrors()); die();
            
        }

    }
    
    
    
    
    
    public function actionRecibirdocumentobloqueo($id_seguimiento) {

            
            /*$model = User::find($id);
            $model->name = 'YII';
            $model->email = 'yii2@framework.com';
            $model->save();*/

        
             $model = Seguimientos::findOne($id_seguimiento);
             //print($model);
             //exit();

		if ($model->oficial==1) {
				$model->fk_estado=1;
				$model->confirmado=1;
				$model->fecha_recepcion=date('Y-m-d');
				$model->hora_recepcion=date('H:i:s');
		}
		else{
			if ($model->oficial==0) {
				$model->fk_estado=2;
				$model->confirmado=1;
				$model->fecha_recepcion=date('Y-m-d');
				$model->hora_recepcion=date('H:i:s');
			}
			else{
				$model->fk_estado=3;
				$model->confirmado=1;
				//echo "Error de recepción por favor consulte con el administrador";
                                //exit();
			}
		}


		//$user = User::model()->findByPk($userId);
        if($model->save())
        {
            /*if((date('Y-m-d')>Seguimientos::getFechaBloqueo()) && (Seguimientos::countTotalQueDebenLlegar()>0)){
                return $this->redirect(['adminbloqueo']);
            }
            else{*/
            Yii::$app->session->setFlash('success', "El trámite <b>".$model->codigo."</b>, fue recibido correctamente.");
            return $this->redirect(['site/index']);
            //}
        }
        else{
            //echo "error al actualizar la informacion ";
            //exit();
            
            Yii::$app->session->setFlash('error', "Error al recibir el tramite <b>".$model->codigo."</b>, comuniquese con el administrador del Sistema S.A.C.");
            print_r($model->getAttributes());
            print_r($model->getErrors());
            var_dump ($model->getErrors()); die();
            
        }

    }
    
    public function actionDerivarpendiente($id)
    {
                
        $model = new Seguimientos();
        $seguimientos=$this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            
            
            /*$model->proveido=$_POST['Seguimientos']['proveido'];
            $model->fk_accion=$_POST['Seguimientos']['fk_accion'];
            $model->codigo=$_POST['Seguimientos']['codigo'];
            $model->derivado_por=$_POST['Seguimientos']['derivado_por'];
            $model->derivado_a=$_POST['Seguimientos']['derivado_a'];
            $model->fk_estado=$_POST['Seguimientos']['fk_estado'];
            $model->padre=$_POST['Seguimientos']['padre'];*/

            $model->fecha_derivacion=date('Y-m-d');
            $model->hora_derivacion=date('H:i:s');
            $model->fecha_recepcion="1000-01-01";
            $model->hora_recepcion="00:00:00";
            $model->gestion=date('Y');

			//$model->padre=0;
            $model->hijo='0';
            //$model->oficial=$oficial;
            $model->confirmado=0;
            $model->activo=1;
            $model->fk_estado=3;
            
            $model->observado=0;
            $model->accion_archivo="NULL";
            $model->fk_grupo_derivacion=0;
            $model->fk_principal_agrupacion=0;
            
            if($seguimientos->oficial==1){
                if($_POST['Seguimientos']['oficial']==0){
                    $numero_copia=Seguimientos::asignarnumerocopia($seguimientos->codigo);
                    $model->numero_copia=$numero_copia.'';
                    $model->correlativo_copia=$numero_copia;
                }
                else{
                    $model->numero_copia='0';
                    $model->correlativo_copia=0;
                }
            }
            else{
                
                if(Seguimientos::getVerificarDerivacionCopia($seguimientos->id_seguimiento)<=0){
                    $model->numero_copia=$seguimientos->numero_copia;
                    $model->correlativo_copia=0;
                }
                else{
                    $numero_copia=Seguimientos::asignarnumerocopiacopia($seguimientos->id_seguimiento, $seguimientos->codigo);
                    $model->numero_copia=$seguimientos->numero_copia.'.'.$numero_copia;
                    $model->correlativo_copia=$numero_copia;
                }
            }
            
            

            $model->fecha_registro=date('Y-m-d');
            $model->hora_registro=date('H:i:s');
            $model->proveido=strtoupper($model->proveido);
            
            if($model->validate()){
                if($model->save()){
                    Yii::$app->session->setFlash('success', "Registro añadido correctamente.");
                    return $this->redirect(['derivarpendiente', 'id' => $model->padre]);     
                }
                else{
                    Yii::$app->session->setFlash('error', "Error al derivar el tramite <b>".$model->codigo."</b>, comuniquese con el administrador del Sistema S.A.C.");
                    print_r($model->getAttributes());
                    print_r($model->getErrors());
                    var_dump ($model->getErrors()); die();
                }
            }
            else{ 
                    Yii::$app->session->setFlash('error', "Error de validación durante la derivación del tramite <b>".$model->codigo."</b>, comuniquese con el administrador del Sistema S.A.C.");
                    print_r($model->getAttributes());
                    print_r($model->getErrors());
                    var_dump ($model->getErrors()); die();
            }
        }

        return $this->render('derivarpendiente', [
            'model' => $model,
            'seguimientos' => $seguimientos,
        ]);
    }
    
    public function actionDerivardocumento($id_documento)
    {
                
        $model = new Seguimientos();

        if ($model->load(Yii::$app->request->post())) {
            
            
            /*$model->proveido=$_POST['Seguimientos']['proveido'];
            $model->fk_accion=$_POST['Seguimientos']['fk_accion'];
            $model->codigo=$_POST['Seguimientos']['codigo'];
            $model->derivado_por=$_POST['Seguimientos']['derivado_por'];
            $model->derivado_a=$_POST['Seguimientos']['derivado_a'];
            $model->fk_estado=$_POST['Seguimientos']['fk_estado'];
            $model->padre=$_POST['Seguimientos']['padre'];*/
            
            $nuri=$_POST['Seguimientos']['codigo'];

            $model->proveido=strtoupper($model->proveido);
            $model->fecha_derivacion=date('Y-m-d');
            $model->hora_derivacion=date('H:i:s');
            $model->fecha_recepcion="1000-01-01";
            $model->hora_recepcion="00:00:00";
            $model->gestion=date('Y');

			//$model->padre=0;
            $model->hijo='0';
            //$model->oficial=$oficial;
            $model->confirmado=0;
            $model->activo=1;
            $model->fk_estado=3;
            
            $model->observado=0;
            $model->accion_archivo="NULL";
            $model->fk_grupo_derivacion=0;
            $model->fk_principal_agrupacion=0;
            
            
            if($_POST['Seguimientos']['oficial']==0){
                $numero_copia=Seguimientos::asignarnumerocopia($nuri);
                $model->numero_copia=$numero_copia.'';
                $model->correlativo_copia=$numero_copia;
            }
            else{
                $model->numero_copia='0';
                $model->correlativo_copia=0;
            }
            
            $model->fecha_registro=date('Y-m-d');
            $model->hora_registro=date('H:i:s');
            
            
            if($model->validate()){
                if($model->save()){
                    Yii::$app->session->setFlash('success', "Registro añadido correctamente.");
                    return $this->redirect(['derivardocumento', 'id_documento' => $id_documento]);     
                }
                else{
                    Yii::$app->session->setFlash('error', "Error al derivar el tramite <b>".$model->codigo."</b>, comuniquese con el administrador del Sistema S.A.C.");
                    print_r($model->getAttributes());
                    print_r($model->getErrors());
                    var_dump ($model->getErrors()); die();
                }
            }
            else{ 
                    Yii::$app->session->setFlash('error', "Error de validación durante la derivación del tramite <b>".$model->codigo."</b>, comuniquese con el administrador del Sistema S.A.C.");
                    print_r($model->getAttributes());
                    print_r($model->getErrors());
                    var_dump ($model->getErrors()); die();
            }
        }

        return $this->render('derivardocumento', [
            'model' => $model,
            'documento' => Documentos::findOne($id_documento),
            
        ]);
        
    } // EN FUNCTION
    
    
    public function actionConfirmarcopia($id_seguimiento){
        
        $model=$this->findModel($id_seguimiento);
	$id=$model->padre;
	$model->confirmado=1;
        if($model->save()){
            
            Yii::$app->session->setFlash('success', "La copia del trámite <b>".$model->codigo."</b>, fue derivada correctamente.");
            return $this->redirect(['derivarpendiente', 'id' => $id]);
            
        }
        else{
            Yii::$app->session->setFlash('error', "Error al confirmar la copia del NURI/trámite <b>".$model->codigo."</b>, comuniquese con el administrador del Sistema S.A.C.");
            print_r($model->getAttributes());
            print_r($model->getErrors());
            var_dump ($model->getErrors()); die();
        }
        
    }
    
    
   
    
    public function actionConfirmarpendiente($id_seguimiento) {

        $model = Seguimientos::findOne($id_seguimiento);
        $model->fk_estado=4;
        $nuri=$model->codigo;
        $oficial=$model->oficial;
             
        if($model->save())
        {
            $result=Yii::$app->db->createCommand("UPDATE seguimientos SET confirmado=1 WHERE codigo='$nuri' AND activo=1 AND confirmado=0")->execute();
            
            if($result){
                Yii::$app->session->setFlash('success', "El número de trámite pendiente <b>".$nuri."</b>, fue derivado correctamente.");
                return $this->redirect(['pendientesoficiales']);
            }
            else{
                Yii::$app->session->setFlash('error', "Error al derivar el trámite pendiente <b>".$nuri."</b>, comuniquese con el administrador del Sistema S.A.C.");
                print_r($model->getAttributes());
                print_r($model->getErrors());
                var_dump ($model->getErrors()); die();
            }
            
            
        }
        else{
            
            Yii::$app->session->setFlash('error', "Error al actualizar el estado del trámite pendiente <b>".$nuri."</b>, comuniquese con el administrador del Sistema S.A.C.");
            print_r($model->getAttributes());
            print_r($model->getErrors());
            var_dump ($model->getErrors()); die();
            //echo "error al actualizar la informacion ";
            //exit();
            
        }

    }
    
    public function actionEliminarderivacion($id_seguimiento){

		//$model=$this->loadModel($id_seguimiento);
		//$user = User::model()->findByPk($userId);
        $model = $this->findModel($id_seguimiento);
	$id=$model->padre;
	$model->activo =0;

	if($model->update()){
            
            Yii::$app->session->setFlash('success', "El registro se eliminó correctamente.");    
	   //$seguimientos=$this->loadModel($id);
            $seguimientos = $this->findModel($id);
            $this->redirect(array('derivarpendiente','id'=>$seguimientos->id_seguimiento));
	}
        
        else{
                Yii::$app->session->setFlash('error', "Error al eliminar el registro, comuniquese con el administrador del Sistema S.A.C.");
                print_r($model->getAttributes());
                print_r($model->getErrors());
                var_dump ($model->getErrors()); die();
        }
        
    }
    
   
    
    
    
    public function actionConfirmarderivaciondocumento($nuri) {
        
        //$model=$this->findModel($id_seguimiento);
        
        // CODIGO PARA VERIFICAR SI EXISTE EL DOCUMENTO ORIGINAL/OFICIAL EN LA DERIVACION
        //if(Seguimientos::verificarSiExisteOficialDocumento($nuri)==1){
        
            $result=Yii::$app->db->createCommand("UPDATE seguimientos SET confirmado=1 WHERE codigo='$nuri' AND activo=1 AND confirmado=0")->execute();

            if($result){
                Yii::$app->session->setFlash('success', "El número de trámite <b>".$nuri."</b>, fue derivado correctamente.");
                return $this->redirect(['site/menudocumentos']);
            }
            else{
                Yii::$app->session->setFlash('error', "Error al derivar el trámite <b>".$nuri."</b>, comuniquese con el administrador del Sistema S.A.C.");
                print_r($model->getAttributes());
                print_r($model->getErrors());
                var_dump ($model->getErrors()); die();
            }
        /*}
        else{
            Seguimientos::mensajeNoSePuedeConfirmar($nuri) ;
        }*/
        
    }
    
    public function actionConfirmarcopiadocumento($id_seguimiento, $id_documento){
        
        $model=$this->findModel($id_seguimiento);
	$id=$model->padre;
	$model->confirmado=1;
        if($model->save()){
            Yii::$app->session->setFlash('success', "La copia del número de trámite <b>".$nuri."</b>, se derivó correctamente.");
            return $this->redirect(['derivardocumento', 'id_documento' => $id_documento]);
            
        }
        else{
                Yii::$app->session->setFlash('error', "Error al derivar la copia del trámite <b>".$nuri."</b>, comuniquese con el administrador del Sistema S.A.C.");
                print_r($model->getAttributes());
                print_r($model->getErrors());
                var_dump ($model->getErrors()); die();
        }
        
    }
    
    public function actionEliminarderivaciondocumento($id_seguimiento, $id_documento){

		//$model=$this->loadModel($id_seguimiento);
		//$user = User::model()->findByPk($userId);
        $model = $this->findModel($id_seguimiento);
	$model->activo =0;

	if($model->update()){

                    Yii::$app->session->setFlash('success', "El registro se eliminó correctamente.");    
                    $this->redirect(array('derivardocumento','id_documento'=>$id_documento));
	}
        else{
                Yii::$app->session->setFlash('error', "Error al eliminar el registro, comuniquese con el administrador del Sistema S.A.C.");
                print_r($model->getAttributes());
                print_r($model->getErrors());
                var_dump ($model->getErrors()); die();
        }
    } //confirmarCopia
    
    
    public function actionAddnuriagrupacion($id_principal,$nuri_p,$id_hijo,$nuri_h,$oficial){

		$model=new Agrupaciones();
		$model->nur_padre=$nuri_p;
		$model->nur_hijo=$nuri_h;
		$model->oficial=$oficial;
		$model->fk_seguimiento_padre=$id_principal;
		$model->fk_seguimiento_hijo=$id_hijo;
		$model->fk_usuario=Yii::$app->user->identity->id_usuario;
		//$model->fk_usuario=Yii::app()->user->id_usuario;
		$model->fecha_registro=date('Y-m-d');
		$model->hora_registro=date('H:i:s');
		$model->activo=1;
		//$model->

		if ($model->save()) {

			//$seguimientos=$this->loadModel($id_hijo);
                        $seguimientos = $this->findModel($id_hijo);
			$seguimientos->fk_estado=7;
			$seguimientos->hijo=$nuri_p;
			$seguimientos->fk_principal_agrupacion=$id_principal;

			if($seguimientos->update()){
				$this->redirect(array('agrupartramites','id'=>$id_principal));
			}
                        else{
                            Yii::$app->session->setFlash('error', "Error al añadir el NURI/trámite, comuniquese con el administrador del Sistema S.A.C.");
                            print_r($model->getAttributes());
                            print_r($model->getErrors());
                            var_dump ($model->getErrors()); die();
                        }
		}

    }
    
    public function actionDeleteagrupacion($id_agrupacion)
    {
		//$model=$this->loadModel($id);
                $model = Agrupaciones::findOne($id_agrupacion);

		//$id_seguimiento=$model->padre;
		$nuri=$model->nur_padre;
		$id_seguimiento=$model->fk_seguimiento_padre;
		$id_seguimiento_hijo=$model->fk_seguimiento_hijo;

		$model->activo=0;
		//$model->update();
		if($model->update()){

                                //echo "-------------> ".$id_seguimiento_hijo;
                                //exit();
				// codigo para restaurar a un estado anterior el nuri hijo
				$seguimientos= Seguimientos::findOne($id_seguimiento_hijo);
				$seguimientos->hijo='0';
				$seguimientos->fk_principal_agrupacion=0;
				if ($seguimientos->oficial==1) {
					$seguimientos->fk_estado=1;
				}
				else{
					$seguimientos->fk_estado=2;
				}

				if ($seguimientos->update()) {

					$this->redirect(array('agrupartramites','id'=>$id_seguimiento));
				}
                                else
                                {
                                    //echo "error update seguimientos";
                                    //exit();
                                    Yii::$app->session->setFlash('error', "Error al actualizar el estado del trámite NUR/NURI durante la agrupación, comuniquese con el administrador del Sistema S.A.C.");
                                    print_r($model->getAttributes());
                                    print_r($model->getErrors());
                                    var_dump ($model->getErrors()); die();
                                }

                }
                else
                {
                    Yii::$app->session->setFlash('error', "Error al actualizar el estado del trámite NUR/NURI durante la agrupación, comuniquese con el administrador del Sistema S.A.C.");
                    print_r($model->getAttributes());
                    print_r($model->getErrors());
                    var_dump ($model->getErrors()); die();
                }

    }
    
    
    public function actionEliminaragrupacion($id_agrupacion)
    {
		//$model=$this->loadModel($id);
                $model = Agrupaciones::findOne($id_agrupacion);

		//$id_seguimiento=$model->padre;
		$nuri=$model->nur_padre;
		$id_seguimiento=$model->fk_seguimiento_padre;
		$id_seguimiento_hijo=$model->fk_seguimiento_hijo;

		$model->activo=0;
		//$model->update();
		if($model->update()){

                                //echo "-------------> ".$id_seguimiento_hijo;
                                //exit();
				// codigo para restaurar a un estado anterior el nuri hijo
				$seguimientos= Seguimientos::findOne($id_seguimiento_hijo);
				$seguimientos->hijo='0';
				$seguimientos->fk_principal_agrupacion=0;
				if ($seguimientos->oficial==1) {
					$seguimientos->fk_estado=1;
				}
				else{
					$seguimientos->fk_estado=2;
				}

				if ($seguimientos->update()) {

					$this->redirect(array('desagrupar','id'=>$id_seguimiento));
				}
                                else
                                {
                                    //echo "error update seguimientos";
                                    //exit();
                                    Yii::$app->session->setFlash('error', "Error al actualizar el estado del trámite NUR/NURI durante la agrupación, comuniquese con el administrador del Sistema S.A.C.");
                                    print_r($model->getAttributes());
                                    print_r($model->getErrors());
                                    var_dump ($model->getErrors()); die();
                                }

                }
                else
                {
                    Yii::$app->session->setFlash('error', "Error al actualizar el estado del trámite NUR/NURI durante la agrupación, comuniquese con el administrador del Sistema S.A.C.");
                    print_r($model->getAttributes());
                    print_r($model->getErrors());
                    var_dump ($model->getErrors()); die();
                }

    }
    
    public function actionAnadirrespuesta($id)
    {
        return $this->render('anadirrespuesta', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionAnadirinformenur($id_documento, $tipo_documento,$nuri){

		//$seguimientos=Seguimientos::model()->findByPk($id);
		$gestion=date('Y');
		//$area=Yii::app()->user->id_area;
		$area=Yii::$app->user->identity->fk_area;
		//$regional=Yii::app()->user->regional;
		$regional=Yii::$app->user->identity->fk_regional;

		//$user=Usuarios::
		
                //$user=Usuarios::model()->findByPk(Yii::app()->user->id_usuario);
		$user=Usuarios::findOne(Yii::$app->user->identity->id_usuario);
		//Yii::app()->user->id_usuario;


		//codigo para generar el documento solicitado
		$model = new Documentos();
		//$model->id_documento = null;
		$model->codigo=Documentos::getCodigo($gestion,$area,$tipo_documento,$regional);

		$cite=$model->codigo;

		$model->fecha=date('Y-m-d');
		$model->hora=date('H:i:s');
		$model->fecha_registro=date('Y-m-d');
		$model->hora_registro=date('H:i:s');
		$model->gestion=date('Y');
		$model->fk_usuario=Yii::$app->user->identity->id_usuario;
		//$model->fk_usuario=Yii::app()->user->id_usuario;
		$model->fk_tipo_documento=$tipo_documento;
		$model->fk_estado_documento=2;
		$model->fk_documento=0;
		$model->fk_motivo=0;
		$model->fk_area=Yii::$app->user->identity->fk_area; 
		//$model->fk_area=Yii::app()->user->id_area;

		$model->destinatario_titulo='Señor';
		$model->destinatario_nombres='null';
		$model->destinatario_cargo='null';
		$model->destinatario_institucion='null';

		$model->remitente_institucion='null';
		$model->remitente_nombres=$user->nombre;
		$model->remitente_cargo=$user->cargo;
		$model->via_nombres='';
		$model->via_cargo='';

		$model->referencia='null';
		$model->contenido='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		$model->adjuntos='';
		$model->copias='';
		$model->nro_hojas='';
		$model->ruta_documento='null';
		$model->usuario_destino=1;
		$model->grupo_destino=0;
		$model->nombre_grupo='null';
		$model->activo=1;

		$model->isNewRecord = true;


		if ($model->insert()) {
			// codigo para almacenar un nuevo registro en la tabla hojas ruta
			$hojas = new HojasRuta();
			//$hojas->id_hoja_ruta = null;

			$hojas->nur=$nuri;
			$hojas->codigo=$cite;
			$hojas->nro=0;
			$hojas->fecha=date('Y-m-d');
			$hojas->hora=date('H:i:s');
			$hojas->proceso=4;
			$hojas->fecha_registro=date('Y-m-d');
			$hojas->hora_registro=date('H:i:s');
			//$hojas->fk_usuario=Yii::app()->user->id_usuario;
			$hojas->fk_usuario=Yii::$app->user->identity->id_usuario;
			$hojas->gestion=date('Y');
			$hojas->activo=1;
			$hojas->fk_documento=$model->id_documento;
			$hojas->oficial=1;

			$hojas->isNewRecord = true;

			if ($hojas->save()) {
                                Yii::$app->session->setFlash('success', "El Informe fue <b>CREADO</b> y <b>ASOCIADO</b> correctamente al NURI <b>".$nuri."</b> pendiente.");    
				$this->redirect(array('documentos/updatecartaexterna','id'=>$id_documento));
			}
			else{
                                Yii::$app->session->setFlash('error', "Error al <b>ASOCIAR</b> el informe al nuri/trámite <b>".$nuri."</b> pendiente, comuniquese con el administrador del Sistema S.A.C.");
				print_r($model->getAttributes());
                                print_r($model->getErrors());
                                var_dump ($model->getErrors()); die();
			}
		}//if ($model->save()) {
		else{
                        Yii::$app->session->setFlash('error', "Error al <b>CREAR</b> el informe, comuniquese con el administrador del Sistema S.A.C.");
			print_r($model->getAttributes());
                        print_r($model->getErrors());
                        var_dump ($model->getErrors()); die();
		}


    }
    
    
    public function actionAnadirdocumentorespuesta($tipo_documento,$id_seguimiento,$nuri, $oficial){

		//$seguimientos=Seguimientos::model()->findByPk($id);
		$gestion=date('Y');
		//$area=Yii::app()->user->id_area;
		$area=Yii::$app->user->identity->fk_area;
		//$regional=Yii::app()->user->regional;
		$regional=Yii::$app->user->identity->fk_regional;

		//$user=Usuarios::
		
                //$user=Usuarios::model()->findByPk(Yii::app()->user->id_usuario);
		$user=Usuarios::findOne(Yii::$app->user->identity->id_usuario);
		//Yii::app()->user->id_usuario;


		//codigo para generar el documento solicitado
		$model = new Documentos();
		//$model->id_documento = null;
		$model->codigo=Documentos::getCodigo($gestion,$area,$tipo_documento,$regional);

		$cite=$model->codigo;

		$model->fecha=date('Y-m-d');
		$model->hora=date('H:i:s');
		$model->fecha_registro=date('Y-m-d');
		$model->hora_registro=date('H:i:s');
		$model->gestion=date('Y');
		$model->fk_usuario=Yii::$app->user->identity->id_usuario;
		//$model->fk_usuario=Yii::app()->user->id_usuario;
		$model->fk_tipo_documento=$tipo_documento;
		$model->fk_estado_documento=2;
		$model->fk_documento=0;
		$model->fk_motivo=0;
		$model->fk_area=$area;
		//$model->fk_area=Yii::app()->user->id_area;

		$model->destinatario_titulo='Señor';
		$model->destinatario_nombres='null';
		$model->destinatario_cargo='null';
		$model->destinatario_institucion='null';

		$model->remitente_institucion='null';
		$model->remitente_nombres=Documentos::getNameRemitente();
		$model->remitente_cargo=Documentos::getCargoRemitente();
		$model->via_nombres='';
		$model->via_cargo='';

		$model->referencia='null';
		$model->contenido='null';
		$model->adjuntos='';
		$model->copias='';
		$model->nro_hojas='';
		$model->ruta_documento='null';
		$model->usuario_destino=1;
		$model->grupo_destino=0;
		$model->nombre_grupo='null';
		$model->activo=1;

		$model->isNewRecord = true;


		if ($model->insert()) {
			// codigo para almacenar un nuevo registro en la tabla hojas ruta
			$hojas = new HojasRuta();
			//$hojas->id_hoja_ruta = null;

			$hojas->nur=$nuri;
			$hojas->codigo=$cite;
			$hojas->nro=$id_seguimiento;
			$hojas->fecha=date('Y-m-d');
			$hojas->hora=date('H:i:s');
			$hojas->proceso=4;
			$hojas->fecha_registro=date('Y-m-d');
			$hojas->hora_registro=date('H:i:s');
			//$hojas->fk_usuario=Yii::app()->user->id_usuario;
			$hojas->fk_usuario=Yii::$app->user->identity->id_usuario;
			$hojas->gestion=date('Y');
			$hojas->activo=1;
			$hojas->fk_documento=$model->id_documento;
			$hojas->oficial=$oficial;

			$hojas->isNewRecord = true;

			if ($hojas->save()) {
                                Yii::$app->session->setFlash('success', "El documento de respuesta fue <b>CREADO</b> y <b>ASOCIADO</b> correctamente al NURI <b>".$nuri."</b> pendiente.");    
				$this->redirect(array('anadirrespuesta','id'=>$id_seguimiento));
			}
			else{
                                Yii::$app->session->setFlash('error', "Error al <b>ASOCIAR</b> el documento de respuesta al nuri/trámite <b>".$nuri."</b> pendiente, comuniquese con el administrador del Sistema S.A.C.");
				print_r($model->getAttributes());
                                print_r($model->getErrors());
                                var_dump ($model->getErrors()); die();
			}
		}//if ($model->save()) {
		else{
                        Yii::$app->session->setFlash('error', "Error al <b>CREAR</b> el documento de respuesta, comuniquese con el administrador del Sistema S.A.C.");
			print_r($model->getAttributes());
                        print_r($model->getErrors());
                        var_dump ($model->getErrors()); die();
		}


    }
    
    public function actionEliminardocumentorespuesta($id_hoja_ruta){
        
        // codigo para desvincular el CITE del NURI
		$hojasruta=HojasRuta::findOne($id_hoja_ruta);
		$id_seguimiento=$hojasruta->nro;
		$id_documento=$hojasruta->fk_documento;
		$hojasruta->activo=0;
		
                if($hojasruta->save()){
                    //codigo para cambiar el estado del CITE a PENDIENTE
                    $documentos=Documentos::findOne($id_documento);
                    $documentos->fk_estado_documento=5;
                    
                    if($documentos->save()){
                        // codigo para redireccionar
                        Yii::$app->session->setFlash('success', "El documento de respuesta fue <b>DESASOCIADO</b> correctamente del NURI <b></b> pendiente.");    
                        $this->redirect(['anadirrespuesta','id'=>$id_seguimiento]);
                    }
                    else{
                        Yii::$app->session->setFlash('error', "Error al <b>DESASOCIAR</b> el documento de respuesta, comuniquese con el administrador del Sistema S.A.C.");
			print_r($model->getAttributes());
                        print_r($model->getErrors());
                        var_dump ($model->getErrors()); die();
                        $this->redirect(['anadirrespuesta','id'=>$id_seguimiento]);
                    }
                }
    }
    
    public function actionDerivargrupos($id)
    {
        //$model = new Hojasruta();
        $hojasruta = Hojasruta::findOne($id);

        

        /*, [
            'model' => $model,
            'documentos' => $documentos,
        ]*/
        return $this->renderPartial('derivargrupos', [ 'hojasruta'=> $hojasruta]);
    }
    
    public function actionDerivargrupospendiente($id)
    {
        //$model = new Hojasruta();
        $seguimiento = Seguimientos::findOne($id);

        /*, [
            'model' => $model,
            'documentos' => $documentos,
        ]*/
        return $this->renderPartial('derivargrupospendiente', [ 'seguimiento'=> $seguimiento]);
    }
    
    public function actionDerivarcopiagrupos($grupo_derivacion, $proveido, $id_documento, $nuri, $accion)
    {
       /* $proveido=strtoupper($proveido);
        echo "<br> --> ".$grupo_derivacion;
        echo "<br> --> ".$proveido;
        echo "<br> --> ".$id_documento;
        echo "<br> --> ".$nuri;
        //exit(); */

        Seguimientos::derivarcopiasgrupos($grupo_derivacion, $nuri, $proveido, $accion);

        return $this->redirect(['derivardocumento', 'id_documento'=> $id_documento]);
    }
    
    public function actionDerivarcopiagrupospendiente($grupo_derivacion, $proveido, $id_seguimiento )
    {
        Seguimientos::derivarcopiasgrupospendiente($grupo_derivacion, $proveido, $id_seguimiento);

        return $this->redirect(['derivarpendiente', 'id'=> $id_seguimiento]);
    }
    
    
    public function actionAdderivartemporal($id_seguimiento)
    {
        
        $seguimiento = Seguimientos::findOne($id_seguimiento);
        $model = new Derivaciontemporal();
        $model->fk_seguimiento=$id_seguimiento;
        $model->nuri=$seguimiento->codigo;
        $model->fk_usuario=Yii::$app->user->identity->id_usuario;
        
        if($model->save()){
            echo "mensaje de exito";
        }
        else{
            //echo "mensaje de error";
            Yii::$app->session->setFlash('error', "Error al añadir el NURI/trámite, comuniquese con el administrador del Sistema S.A.C.");
            print_r($model->getAttributes());
            print_r($model->getErrors());
            var_dump ($model->getErrors()); die(); 
        }

        return $this->redirect(['pendientesbloque']);
    }
    
    public function actionDerivarpendientesbloque()
    {
        return $this->render('derivarpendientesbloque');
    }
    
    public function actionDeletederivartemp($id)
    {
        //$this->findModel($id)->delete();
        $model = Derivaciontemporal::findOne($id)->delete();

        return $this->redirect(['pendientesbloque']);
    }
    
    public function actionEliminarderivacionbloque($id_seguimiento){

		//$model=$this->loadModel($id_seguimiento);
		//$user = User::model()->findByPk($userId);
                $model = $this->findModel($id_seguimiento);
		$id=$model->padre;
		$model->activo =0;

		if($model->update()){

		    //$seguimientos=$this->loadModel($id);
                    $seguimientos = $this->findModel($id);
                    $this->redirect(array('derivarpendientesbloque','id'=>$seguimientos->id_seguimiento));
		}
                else{ 
                    Yii::$app->session->setFlash('error', "Error al eliminar el NURI/trámite pendiente, comuniquese con el administrador del Sistema S.A.C.");
                    print_r($model->getAttributes());
                    print_r($model->getErrors());
                    var_dump ($model->getErrors()); die();
                }
    }
    
    
    public function actionDerivarpendientebloque($destino, $proveido)
    {
        //echo "---------->".$destino;
        //echo "---------->".$proveido;
        //exit();
                
        $dataReader=Seguimientos::derivarbloque();
        
        foreach($dataReader as $row){
            
            
            $model = new Seguimientos();
            $seguimientos=$this->findModel($row['fk_seguimiento']);
            
            $model->codigo=$seguimientos->codigo;
            $model->derivado_por=Yii::$app->user->identity->id_usuario;
            $model->derivado_a=$destino;
            $model->proveido=strtoupper($proveido);

            $model->fecha_derivacion=date('Y-m-d');
            $model->hora_derivacion=date('H:i:s');
            $model->fecha_recepcion="1000-01-01";
            $model->hora_recepcion="00:00:00";
            $model->gestion=date('Y');

            $model->padre=$seguimientos->id_seguimiento;
            $model->hijo=$seguimientos->hijo;
            $model->oficial=$seguimientos->oficial;
            $model->confirmado=0;
            $model->activo=1;
            $model->fk_estado=3;
            
            $model->fk_accion=$seguimientos->fk_accion;
            
            $model->observado=0;
            $model->accion_archivo="NULL";
            $model->fk_grupo_derivacion=0;
            $model->fk_principal_agrupacion=0;
            
            $model->numero_copia=$seguimientos->numero_copia;
            $model->correlativo_copia=$seguimientos->correlativo_copia;
            
            $model->fecha_registro=date('Y-m-d');
            $model->hora_registro=date('H:i:s');
            
            

            
            if($model->save()){              
            }
            else{ 
                Yii::$app->session->setFlash('error', "Error al derivar el NURI/trámite pendiente, comuniquese con el administrador del Sistema S.A.C.");
                print_r($model->getAttributes());
                print_r($model->getErrors());
                var_dump ($model->getErrors()); die();
            }
            
            
            
            
        }// end foreach  
        

        return $this->redirect(['derivarpendientesbloque']);
        
        
    }// end function
    
    
    public function actionConfirmarpendientebloque()
    {
        //echo "---------->".$destino;
        //echo "---------->".$proveido;
        //exit();
                
        $dataReader=Seguimientos::derivarbloque();
        
        foreach($dataReader as $row){
            
            
            //$model = new Seguimientos();
            $d_seguimiento_padre=$row['fk_seguimiento'];
            $model=$this->findModel($row['fk_seguimiento']);
            $model->fk_estado=4;
            if($model->save()){
                
                Yii::$app->session->setFlash('success', "Los trámites fueron <b>DERIVADOS</b> correctamente");    
                Yii::$app->db->createCommand("UPDATE seguimientos SET confirmado=1 WHERE padre=$d_seguimiento_padre AND activo=1")->execute();
                
            }
            else{ 
                 Yii::$app->session->setFlash('error', "Error al confirmar la derivación de los NURIs/trámites pendientes, comuniquese con el administrador del Sistema S.A.C.");
                 print_r($model->getAttributes());
                 print_r($model->getErrors());
                 var_dump ($model->getErrors()); die();
            }
            
        }// end foreach  
        
        $usuario=Yii::$app->user->identity->id_usuario;   
        Yii::$app->db->createCommand("DELETE FROM derivaciontemporal WHERE fk_usuario=$usuario ")->execute();
        
        

        return $this->redirect(['pendientesbloque']);
        
        
    }// end function
    
    
    
    
    public function actionAdrecibirtemporal($id_seguimiento)
    {
        
        $seguimiento = Seguimientos::findOne($id_seguimiento);
        $model = new Recepciontemporal();
        $model->fk_seguimiento=$id_seguimiento;
        $model->nuri=$seguimiento->codigo;
        $model->fk_usuario=Yii::$app->user->identity->id_usuario;
        
        if($model->save()){
            echo "mensaje de exito";
        }
        else{
            //echo "mensaje de error";
            Yii::$app->session->setFlash('error', "Error al añadir el NURI/trámite, comuniquese con el administrador del Sistema S.A.C.");
            print_r($model->getAttributes());
            print_r($model->getErrors());
            var_dump ($model->getErrors()); die();
        }

        return $this->redirect(['quedebenllegarbloque']);
    }
    
    
    public function actionDeleterecepciontemp($id)
    {
        //$this->findModel($id)->delete();
        $model = Recepciontemporal::findOne($id)->delete();

        return $this->redirect(['quedebenllegarbloque']);
    }
    
    public function actionRecibirbloque() {

        $dataReader=Seguimientos::recibirbloque();
        
        foreach($dataReader as $row){
            
             $model = Seguimientos::findOne($row['fk_seguimiento']);

		if ($model->oficial==1) {
				$model->fk_estado=1;
				$model->confirmado=1;
				$model->fecha_recepcion=date('Y-m-d');
				$model->hora_recepcion=date('H:i:s');
		}
		else{
			if ($model->oficial==0) {
				$model->fk_estado=2;
				$model->confirmado=1;
				$model->fecha_recepcion=date('Y-m-d');
				$model->hora_recepcion=date('H:i:s');
			}
			else{
				$model->fk_estado=3;
				$model->confirmado=1;
				
                                //exit();
			}
		}


		//$user = User::model()->findByPk($userId);
                if($model->save())
                {
                    Yii::$app->session->setFlash('success', "Los trámites fueron <b>RECIBIDOS</b> correctamente");    
                    $recibir = Recepciontemporal::findOne($row['id_recepcion_temporal'])->delete();
                }
                else{
                        Yii::$app->session->setFlash('error', "Error al <b>RECIBIR</b> los NURIs/trámites que deben llegar, comuniquese con el administrador del Sistema S.A.C.");
                        print_r($model->getAttributes());
                        print_r($model->getErrors());
                        var_dump ($model->getErrors()); die();

                }
                
        } // end foreach    
        
        return $this->redirect(['quedebenllegarbloque']);

    } // end function



public function actionResumenpendientes()
{
   return $this->render('resumenpendientes');

}


public function actionResumenpendientespersonal($id_area)
{
   return $this->render('resumenpendientespersonal', ['id_area'=>$id_area]);

}    
    
    


    
//###########################################################################################    
//PROCEDIMIENTOS PARA GENERAR DOCUMENTOS EXCEL    
public function actionPendientesusuarioexcel($id)
{
    return $this->renderPartial('pendientesusuarioexcel', [
            'usuarios' => Usuarios::findOne($id),
        ]);
}

public function actionPendientesareaexcel($id)
{
    
    $model =  Areas::findOne($id);
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="PENDIENTES '.$model->area.'.xls"');
    header('Cache-Control: max-age=0');            
    
    return $this->renderPartial('pendientesareaexcel', [
           'model'=> $model,
        ]);
           
  }
 
public function actionPendientesarearesumenexcel($id)
{
    
    $model =  Areas::findOne($id);
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="PENDIENTES '.$model->area.'.xls"');
    header('Cache-Control: max-age=0');            
    
    return $this->renderPartial('pendientesarearesumenexcel', [
           'model'=> $model,
        ]);
           
  }

public function actionArchivoareaexcel($id)
{
    
    $model =  Areas::findOne($id);
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="ARCHIVO '.$model->area.'.xls"');
    header('Cache-Control: max-age=0');            
    
    return $this->renderPartial('archivoareaexcel', [
           'model'=> $model,
        ]);
           
  }

public function actionPendientespersonalresumenexcel($id)
{
    
    //$model =  Areas::findOne($id);
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="RESUMEN DE PENDIENTES.xls"');
    header('Cache-Control: max-age=0');            
    
    return $this->renderPartial('pendientespersonalresumenexcel', [
           'id'=> $id,
        ]);
           
  }    

  
 
 
//###########################################################################################    
//PROCEDIMIENTOS PARA GENERAR DOCUMENTOS PDF  
    
    public function actionActarecepciongeneralpdf()
    {
        // I want a post
         
            // parse $_POST variables
            //print_r($_POST["Seguimientos"]["id_seguimiento"]);
            //exit();

         $content = $this->renderPartial('reportederivadosgeneralpdf', ['seguimientos'=>$_POST["Seguimientos"]]);

            // setup kartik\mpdf\Pdf component
            $pdf = new Pdf([
               // set to use core fonts only
               'mode' => Pdf::MODE_CORE, 
               // A4 paper format
               'format' => Pdf::FORMAT_LETTER, 
               // portrait orientation
               'orientation' => Pdf::ORIENT_LANDSCAPE, 
               //'orientation' => Pdf::ORIENT_PORTRAIT, 
               // stream to browser inline
               'destination' => Pdf::DEST_DOWNLOAD, 
               'filename'=>'acta recepcion.pdf',
               'marginLeft'=>10,
               'marginRight'=>10,
               'marginTop'=>28,
               'marginBottom'=>5,
               // your html content input
               'content' => $content,  
               // format content from your own css file if needed or use the
               // enhanced bootstrap css built by Krajee for mPDF formatting 
               'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
               // any css to be embedded if required
               /*'cssInline' => '.tabla_agrupacion tr{
                                    border-top-color:#999BA0; border-top-style:solid; border-top-width:0.1px;
                                    }
                                .tabla_agrupacion tr td{
                                        border-bottom: 0.05em solid #1C1C1C;
                                }    
                                .fila{
                                        border-bottom: 1em solid #1C1C1C;
                                }',    */            
                // set mPDF properties on the fly
               'options' => ['title' => 'Krajee Report Title'],
                // call mPDF methods on the fly
                
                 

               'methods' => [ 
                          
                    'SetHeader'=>["<table width='100%' style='vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;'>
                         <tr>
                            <td width='33%' style='font-style: italic;'><img src='./images/logo_hr.png' style='width:110px; height:60px;' ></td>
                            <td width='33%' align='center' style='font-style: italic;'>ACTA DE RECEPCIÓN DE TRÁMITES</td>
                            <td width='30%' align='right' style='font-style: italic;'valign='middle'>Entidad Ejecutora de Renovación Vehicular PATRIA </td>
                         </tr>
                    </table>"],
                        
                   /*'SetFooter'=>[' 
                       <table width="100%" style="border-top: 1px solid; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;">
                         <tr>
                            <td width="50%" style="font-style: italic;">Sistema de Administración de Correspondencia</td>
                            <td>{PAGENO}/{nbpg}</td>
                            <td width="50%" style="text-align: right; font-style: italic;  ">S.A.C.</td>
                         </tr>
                       </table>
                      '], */
                   
                    'SetWatermarkText'=>'DRAFT',  
                   
                    
               ]


           ]);
           return $pdf->render();    


    }    

    public function actionReportederivadoscompleto()
    {
        
        /*return $this->render('reportederivadoscompletopdf');
        exit();*/
        
        $content = $this->renderPartial('reportederivadoscompletopdf');

            // setup kartik\mpdf\Pdf component
            $pdf = new Pdf([
               // set to use core fonts only
               'mode' => Pdf::MODE_CORE, 
               // A4 paper format
               'format' => Pdf::FORMAT_LETTER, 
               // portrait orientation
               //'orientation' => Pdf::ORIENT_PORTRAIT, 
               'orientation' => Pdf::ORIENT_LANDSCAPE, 
               // stream to browser inline
               'destination' => Pdf::DEST_BROWSER, 
               //'destination' => Pdf::DEST_DOWNLOAD, 
               'filename'=>'acta_recepcion.pdf',
               'marginLeft'=>10,
               'marginRight'=>10,
               'marginTop'=>28,
               'marginBottom'=>5,
               // your html content input
               'content' => $content,  
               // format content from your own css file if needed or use the
               // enhanced bootstrap css built by Krajee for mPDF formatting 
               'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
               // any css to be embedded if required
               /*'cssInline' => '.tabla_agrupacion tr{
                                    border-top-color:#999BA0; border-top-style:solid; border-top-width:0.1px;
                                    }
                                .tabla_agrupacion tr td{
                                        border-bottom: 0.05em solid #1C1C1C;
                                }    
                                .fila{
                                        border-bottom: 1em solid #1C1C1C;
                                }',    */            
                // set mPDF properties on the fly
               'options' => ['title' => 'Krajee Report Title'],
                // call mPDF methods on the fly
                
                 

               'methods' => [ 
                          
                    'SetHeader'=>["<table width='100%' style='vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;'>
                         <tr>
                            <td width='33%' style='font-style: italic;'><img src='./images/logo_gnv.png' style='width:200px; height:60px;' ></td>
                            <td width='33%' align='center' style='font-style: italic;'>ACTA DE RECEPCIÓN DE TRÁMITES</td>
                            <td width='30%' align='right' style='font-style: italic;'valign='middle'>Entidad Ejecutora de Renovación Vehicular PATRIA </td>
                         </tr>
                    </table>"],
                        
                   /*'SetFooter'=>[' 
                       <table width="100%" style="border-top: 1px solid; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;">
                         <tr>
                            <td width="50%" style="font-style: italic;">Sistema de Administración de Correspondencia</td>
                            <td>{PAGENO}/{nbpg}</td>
                            <td width="50%" style="text-align: right; font-style: italic;  ">S.A.C.</td>
                         </tr>
                       </table>
                      '], */
                   
                    'SetWatermarkText'=>'DRAFT',  
                   
                    
               ]


           ]);
           return $pdf->render();
    }
    
    public function actionReportedocumentosderivados($valor, $checkbox)
    {
        //echo "----> ".$checkbox;
        //exit();
        /*return $this->render('reportedocumentosderivadospdf', [
            'valor' => $valor,
        ]);*/
        
        if($checkbox=="NO"){
            $setheader= "
                
                
                    <table width='100%' style='vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;'>
                         <tr>
                            <td width='33%' style='font-style: italic;'><img src='./images/logo_gnv.png' style='width:200px; height:60px;' ></td>
                            <td width='33%' align='center' style='font-style: italic;'>ACTA DE RECEPCIÓN DE TRÁMITES</td>
                            <td width='30%' align='right' style='font-style: italic;'valign='middle'>Entidad Ejecutora de Renovación Vehicular PATRIA </td>
                         </tr>
                    </table>
                    
                     ";
        }
        else{
            $setheader="";
        }
        
        $content = $this->renderPartial('reportedocumentosderivadospdf', [ 'valor'=> $valor, 'checkbox'=>$checkbox]);

            // setup kartik\mpdf\Pdf component
            $pdf = new Pdf([
               // set to use core fonts only
               'mode' => Pdf::MODE_CORE, 
               // A4 paper format
               'format' => Pdf::FORMAT_LETTER, 
               // portrait orientation
               //'orientation' => Pdf::ORIENT_PORTRAIT, 
               'orientation' => Pdf::ORIENT_LANDSCAPE, 
               // stream to browser inline
               'destination' => Pdf::DEST_BROWSER, 
               //'destination' => Pdf::DEST_DOWNLOAD,
               'filename'=>'acta recepcion.pdf',
               'marginLeft'=>10,
               'marginRight'=>10,
               'marginTop'=>28,
               'marginBottom'=>5,
               // your html content input
               'content' => $content,  
               // format content from your own css file if needed or use the
               // enhanced bootstrap css built by Krajee for mPDF formatting 
               'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
               // any css to be embedded if required
               /*'cssInline' => '.tabla_agrupacion tr{
                                    border-top-color:#999BA0; border-top-style:solid; border-top-width:0.1px;
                                    }
                                .tabla_agrupacion tr td{
                                        border-bottom: 0.05em solid #1C1C1C;
                                }    
                                .fila{
                                        border-bottom: 1em solid #1C1C1C;
                                }',    */            
                // set mPDF properties on the fly
               'options' => ['title' => 'Krajee Report Title'],
                // call mPDF methods on the fly
                
                 

               'methods' => [ 
                          
                    'SetHeader'=>[$setheader],
                        
                   /*'SetFooter'=>[' 
                       <table width="100%" style="border-top: 1px solid; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;">
                         <tr>
                            <td width="50%" style="font-style: italic;">Sistema de Administración de Correspondencia</td>
                            <td>{PAGENO}/{nbpg}</td>
                            <td width="50%" style="text-align: right; font-style: italic;  ">S.A.C.</td>
                         </tr>
                       </table>
                      '], */
                   
                    'SetWatermarkText'=>'DRAFT',  
                   
                    
               ]


           ]);
           return $pdf->render();
    }
    
    public function actionPendientesusuariopdf($id)
    {
                
        $model =  Usuarios::findOne($id);
        
        /*    return $this->renderPartial('pendientesusuariopdf', [ 'usuarios'=> $model]);
            
            exit(); */
            
            $content = $this->renderPartial('pendientesusuariopdf', [ 'usuarios'=> $model]);

            // setup kartik\mpdf\Pdf component
            $pdf = new Pdf([
               // set to use core fonts only
               'mode' => Pdf::MODE_CORE, 
               // A4 paper format
               'format' => Pdf::FORMAT_LETTER, 
               // portrait orientation
               'orientation' => Pdf::ORIENT_PORTRAIT, 
               // stream to browser inline
               'destination' => Pdf::DEST_DOWNLOAD, 
               'filename'=>'reporte_'.$model->usuario.'.pdf',
               'marginLeft'=>10,
               'marginRight'=>10,
               'marginTop'=>28,
               // your html content input
               'content' => $content,  
               // format content from your own css file if needed or use the
               // enhanced bootstrap css built by Krajee for mPDF formatting 
               'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
               // any css to be embedded if required
               //'cssInline' => '.tabla_agrupacion tr td {border-top-color:#0D1028; border-top-style:solid;  border-top-width:0.1pt;}  ', 
               'cssInline' => '.tabla_agrupacion tr{
                                    border-top-color:#999BA0; border-top-style:solid; border-top-width:0.1px;
                                    }
                                .tabla_agrupacion tr td{
                                        border-bottom: 0.05em solid #1C1C1C;
                                }    
                                .fila{
                                        border-bottom: 1em solid #1C1C1C;
                                }',                
                // set mPDF properties on the fly
               'options' => ['title' => 'Krajee Report Title'],
                // call mPDF methods on the fly
                
                 

               'methods' => [ 
                   'SetHeader'=>['
                          
                       <table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;">
                         <tr>
                            <td width="33%" style="font-style: italic;"><img src="./images/logo_gnv.png" style="width:200px; height:60px;" ></td>
                            <td width="33%" align="center" style="font-style: italic;"></td>
                            <td width="30%" align="right" style="font-style: italic;" valign="middle">Entidad Ejecutora de Conversión a Gas Natural Vehícular</td>
                         </tr>
                       </table>  
                          
                          
                        '], 
                   'SetFooter'=>[' 
                       <table width="100%" style="border-top: 1px solid; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;">
                         <tr>
                            <td width="50%" style="font-style: italic;">Sistema de Administración de Correspondencia</td>
                            <td>{PAGENO}/{nbpg}</td>
                            <td width="50%" style="text-align: right; font-style: italic;  ">S.A.C.</td>
                         </tr>
                       </table>
                      '],
                    'SetWatermarkText'=>'DRAFT',  
                   
                    
               ]


           ]);
           return $pdf->render();
           
    }
    
    public function actionPendientesareapdf()
    {
                
        $model =  Areas::findOne(Yii::$app->user->identity->fk_area);
        
            /*return $this->renderPartial('pendientesareapdf', [ 'model'=> $model]);
            
            exit(); */
            
            $content = $this->renderPartial('pendientesareapdf', [ 'model'=> $model]);

            // setup kartik\mpdf\Pdf component
            $pdf = new Pdf([
               // set to use core fonts only
               'mode' => Pdf::MODE_CORE, 
               // A4 paper format
               'format' => Pdf::FORMAT_LETTER, 
               // portrait orientation
               'orientation' => Pdf::ORIENT_PORTRAIT, 
               // stream to browser inline
               'destination' => Pdf::DEST_DOWNLOAD, 
               'filename'=>'reporte_'.$model->sigla.'.pdf',
               'marginLeft'=>10,
               'marginRight'=>10,
               'marginTop'=>28,
               // your html content input
               'content' => $content,  
               // format content from your own css file if needed or use the
               // enhanced bootstrap css built by Krajee for mPDF formatting 
               'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
               // any css to be embedded if required
               //'cssInline' => '.tabla_agrupacion tr td {border-top-color:#0D1028; border-top-style:solid;  border-top-width:0.1pt;}  ', 
               'cssInline' => '.tabla_agrupacion tr{
                                    border-top-color:#999BA0; border-top-style:solid; border-top-width:0.1px;
                                    }
                                .tabla_agrupacion tr td{
                                        border-bottom: 0.05em solid #1C1C1C;
                                }    
                                .fila{
                                        border-bottom: 1em solid #1C1C1C;
                                }',                
                // set mPDF properties on the fly
               'options' => ['title' => 'Krajee Report Title'],
                // call mPDF methods on the fly
                
                 

               'methods' => [ 
                   'SetHeader'=>['
                          
                       <table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;">
                         <tr>
                            <td width="33%" style="font-style: italic;"><img src="./images/logo_gnv.png" style="width:200px; height:60px;" ></td>
                            <td width="33%" align="center" style="font-style: italic;"></td>
                            <td width="30%" align="right" style="font-style: italic;" valign="middle">Entidad Ejecutora de Conversión a Gas Natural Vehícular</td>
                         </tr>
                       </table>  
                          
                          
                        '], 
                   'SetFooter'=>[' 
                       <table width="100%" style="border-top: 1px solid; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;">
                         <tr>
                            <td width="50%" style="font-style: italic;">Sistema de Administración de Correspondencia</td>
                            <td>{PAGENO}/{nbpg}</td>
                            <td width="50%" style="text-align: right; font-style: italic;  ">S.A.C.</td>
                         </tr>
                       </table>
                      '],
                    'SetWatermarkText'=>'DRAFT',  
                   
                    
               ]


           ]);
           return $pdf->render();
           
    }
    
    
    public function actionImprimirhsadicional($id, $nur,$oficial)
    {
	if ($oficial==1) {
			$valor='Original';
        }
		else{
			$valor='Copia Digital';
	}
                
        $model = $this->findModel($id);
        
            $content = $this->renderPartial('hsadicionalpdf', [ 'model'=> $model]);

            // setup kartik\mpdf\Pdf component
            $pdf = new Pdf([
               // set to use core fonts only
               'mode' => Pdf::MODE_CORE, 
               // A4 paper format
               'format' => Pdf::FORMAT_LETTER, 
               // portrait orientation
               'orientation' => Pdf::ORIENT_PORTRAIT, 
               // stream to browser inline
               'destination' => Pdf::DEST_BROWSER, 
               //'destination' => Pdf::DEST_DOWNLOAD, 
               'filename'=>'hs_'.$model->codigo.'.pdf',
               'marginLeft'=>10,
               'marginRight'=>10,
               'marginTop'=>20,
               // your html content input
               'content' => $content,  
               // format content from your own css file if needed or use the
               // enhanced bootstrap css built by Krajee for mPDF formatting 
               'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
               // any css to be embedded if required
               'cssInline' => '.cuerpo{ width: 100%; font-family:Verdana, Geneva, sans-serif;} .tabla_hs{font-family:Verdana, Geneva, sans-serif;} .tabla_hs tr td, tr th{ border: .3px solid #1C1C1C; border-collapse: collapse;}', 
                // set mPDF properties on the fly
               'options' => ['title' => 'Krajee Report Title'],
                // call mPDF methods on the fly
                
                 

               'methods' => [ 
                   'SetHeader'=>['
                          
                       <table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;">
                         <tr>
                            <td width="33%" style="font-style: italic;">'.$valor.'</td>
                            <td width="33%" align="center" style="font-style: italic;">'.$nur.'</td>
                            <td width="33%" align="right" style="font-style: italic;">EERV-PATRIA</td>
                         </tr>
                       </table>  
                          
                          
                        '], 
                   'SetFooter'=>[' 
                       <table width="100%" style="border-top: 1px solid; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;">
                         <tr>
                            <td width="50%" style="font-style: italic;">Sistema de Administración de Correspondencia</td>
                            <td width="50%" style="text-align: right; font-style: italic;  ">S.A.C.</td>
                         </tr>
                       </table>
                      '],
                    'SetWatermarkText'=>'DRAFT',  
                   
                    
               ]


           ]);
           return $pdf->render();
           
           /*$pdf = new Pdf([
               // set to use core fonts only
               'mode' => Pdf::MODE_CORE, 
               // A4 paper format
               'format' => Pdf::FORMAT_LETTER, 
               // portrait orientation
               'orientation' => Pdf::ORIENT_PORTRAIT, 
               // stream to browser inline
               'destination' => Pdf::DEST_DOWNLOAD, 
               'filename'=>'hs_'.$model->codigo.'.pdf',
               'marginLeft'=>27,
               'marginTop'=>30,
               // your html content input
               'content' => $content,  
               // format content from your own css file if needed or use the
               // enhanced bootstrap css built by Krajee for mPDF formatting 
               'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
               // any css to be embedded if required
               'cssInline' => '.cuerpo{ width: 100%; font-family:Verdana, Geneva, sans-serif;} .tabla_hs{font-family:Verdana, Geneva, sans-serif;} .tabla_hs tr td, tr th{ border: .3px solid #1C1C1C; border-collapse: collapse;}', 
                // set mPDF properties on the fly
               'options' => ['title' => 'Krajee Report Title'],
                // call mPDF methods on the fly

               'methods' => [ 
                   'SetHeader'=>['
                          
                       <table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;">
                         <tr>
                            <td width="20%"><img src="'.Yii::$app->request->baseUrl.'/images/logo_hr.png" width="120px"></td>
                            <td width="80%" align="right" style="font-style: italic;">Sistema de Administración de Garantías <br> '.date('d/m/Y').'</td>
                         </tr>
                       </table>  
                          
                          
                        '], 
                   'SetFooter'=>[' 
                       <table width="100%" style="border-top: 1px solid; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;">
                         <tr>
                            <td width="10%">EERV-PATRIA</td>
                            <td width="80%" align="center" style="font-style: italic;">Entidad Ejecutora de Renovación Vehicular Patria</td>
                            <td width="10%" style="text-align: right;  ">{PAGENO}/{nbpg}</td>
                         </tr>
                       </table>
                      '],
               ]


           ]);*/
        
        
    }
    
    
    public function actionImprimicaratulaagrupacion($id)
    {
                
        $model = $this->findModel($id);
        
            $content = $this->renderPartial('caratulaagrupacionpdf', [ 'model'=> $model]);

            // setup kartik\mpdf\Pdf component
            $pdf = new Pdf([
               // set to use core fonts only
               'mode' => Pdf::MODE_CORE, 
               // A4 paper format
               'format' => Pdf::FORMAT_LETTER, 
               // portrait orientation
               'orientation' => Pdf::ORIENT_PORTRAIT, 
               // stream to browser inline
               'destination' => Pdf::DEST_DOWNLOAD, 
               'filename'=>'hs_'.$model->codigo.'.pdf',
               'marginLeft'=>10,
               'marginRight'=>10,
               'marginTop'=>28,
               // your html content input
               'content' => $content,  
               // format content from your own css file if needed or use the
               // enhanced bootstrap css built by Krajee for mPDF formatting 
               'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
               // any css to be embedded if required
               //'cssInline' => '.tabla_agrupacion tr td {border-top-color:#0D1028; border-top-style:solid;  border-top-width:0.1pt;}  ', 
               'cssInline' => '.tabla_agrupacion tr td {border: #0D1028 0.1pt solid;}  ',                
                // set mPDF properties on the fly
               'options' => ['title' => 'Krajee Report Title'],
                // call mPDF methods on the fly
                
                 

               'methods' => [ 
                   'SetHeader'=>['
                          
                       <table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;">
                         <tr>
                            <td width="33%" style="font-style: italic;"><img src="./images/logo_gnv.png" style="width:200px; height:60px;" ></td>
                            <td width="33%" align="center" style="font-style: italic;"></td>
                            <td width="30%" align="right" style="font-style: italic;" valign="middle">Entidad Ejecutora de Conversión a Gas Natural Vehícular</td>
                         </tr>
                       </table>  
                          
                          
                        '], 
                   'SetFooter'=>[' 
                       <table width="100%" style="border-top: 1px solid; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;">
                         <tr>
                            <td width="50%" style="font-style: italic;">Sistema de Administración de Correspondencia</td>
                            <td width="50%" style="text-align: right; font-style: italic;  ">S.A.C.</td>
                         </tr>
                       </table>
                      '],
                    'SetWatermarkText'=>'DRAFT',  
                   
                    
               ]


           ]);
           return $pdf->render();
           
    }

    public function actionSeguimientonuripdf($nuri)
    {
                
        //$model = $this->findModel($id);
        
        $nuri=trim($nuri);

        $content = $this->renderPartial('seguimientonuripdf', [ 'nuri'=>$nuri]);

            // setup kartik\mpdf\Pdf component
            $pdf = new Pdf([
               // set to use core fonts only
               'mode' => Pdf::MODE_CORE, 
               // A4 paper format
               'format' => Pdf::FORMAT_LETTER, 
               // portrait orientation
               'orientation' => Pdf::ORIENT_PORTRAIT, 
               // stream to browser inline
               'destination' => Pdf::DEST_BROWSER, 
               'filename'=>'seguimiento.pdf',
               'marginLeft'=>10,
               'marginRight'=>10,
               'marginTop'=>28,
               // your html content input
               'content' => $content,  
               // format content from your own css file if needed or use the
               // enhanced bootstrap css built by Krajee for mPDF formatting 
               'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
               // any css to be embedded if required
               //'cssInline' => '.tabla_agrupacion tr td {border-top-color:#0D1028; border-top-style:solid;  border-top-width:0.1pt;}  ', 
               'cssInline' => '/*###########################################################################*/
                            /*CODIGO PARA ESTILOS DE LA TABLA QUE SE MUESTRA EN EL VIEW SEGUIMIENTOS */

                            #table_cabecera_seguimiento {
                                width: 100%;
                            }

                            #table_cabecera_seguimiento tr th {
                                background-color: #086A87;
                                color: #F2F2F2;
                                /*font-size: 39px,*/
                                padding: 5px;
                                padding-left: 12px;

                            }

                            #table_cabecera_seguimiento tr td {
                                padding: 5px;
                            }

                            /*###########################################################################*/
                            /* codigo para la tabla seguimiento*/
                            #table_seguimiento {
                                /*background-color: #086A87;
                                color: #F2F2F2;*/
                                font-size: 14px;
                                width: 100%;
                            }
                            #table_seguimiento tr th {
                                background-color: #086A87;
                                color: #F2F2F2;
                                padding: 4px;
                                padding-left: 12px;

                            }

                            #table_seguimiento tr td {
                                padding: 3px;
                                padding-left: 5px;
                                border: 1px solid rgba(55,72,79, 0.5);
                            }

                            /* codigo para los mensajes personales*/
                            .div_info{

                                border: 0 solid red;
                                padding: 17px;
                                border-radius: 10px; 
                                box-shadow: 2px 2px 2px 2px;
                                background-color: #81BEF7;
                                /*opacity:0.4;*/
                                color: #0B2F3A;

                            }

                            /*codigo  para cambiar el color de personal no asignado a grupos*/
                            .grupoColumn{

                                color: red;
                                font-weight: bold;
                            }

                            /* codigo para cambiar el estilo de las vista de los documentos*/
                            #viewCabecera{

                                font-size: 15px;
                            }

                            #viewContenido{
                                font-size: 15px;
                            }

                            /*####################################################################*/
                            /*################################################*/
                            /*estilo para  numero de copia de seguimiento*/
                            .numero_copiasss{

                             text-align:right;  
                             position:relative;  
                             margin-top: -17px; 
                             font-size: 11px; 
                             font-weight: bold; 
                             border: 0px solid green;

                            }

                            .numero_copia{

                            margin-top:-1px; 
                             text-align:right;  
                             position:relative;  
                              font-size: 9px; 
                             font-weight: bold; 
                             border: 0px solid green;

                            }

                            /*################################################*/
                            /*estilo para mostrar nuri*/

                            .nuri{

                              background:#E8EAEC; 
                              padding:8px; 
                              border-radius: 5px;

                            }

                             #table_seguimiento {
                                    border: solid .3pt gray;
                                    font-size: 7pt;
                                 }

                                 #table_seguimiento tr td{
                                    border: solid .1pt gray;
                                    font-size: 7pt;
                                 }

                                 #table_seguimiento tr th{
                                    border: solid .1pt gray;
                                    font-size: 7pt;
                                 }
                ',                
                // set mPDF properties on the fly
               'options' => ['title' => 'Krajee Report Title'],
                // call mPDF methods on the fly
                
                 

               'methods' => [ 
                   'SetHeader'=>['
                          
                       <table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;">
                         <tr>
                            <td width="33%" style="font-style: italic;"><img src="./images/logo_gnv.png" style="width:200px; height:60px;" ></td>
                            <td width="33%" align="center" style="font-style: italic;"></td>
                            <td width="30%" align="right" style="font-style: italic;" valign="middle">Entidad Ejecutora de Renovaci&oacute;n Vehicular Patria</td>
                         </tr>
                       </table>  
                          
                          
                        '], 
                   'SetFooter'=>[' 
                       <table width="100%" style="border-top: 1px solid; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;">
                         <tr>
                            <td width="50%" style="font-style: italic;">Sistema de Administración de Correspondencia</td>
                            <td width="50%" style="text-align: right; font-style: italic;  ">S.A.C.</td>
                         </tr>
                       </table>
                      '],
                    'SetWatermarkText'=>'DRAFT',  
                   
                    
               ]


           ]);
           return $pdf->render();
           
    }
    
    
    public function actionGenerarquedebenllegarpdf() 
    {
        $session = Yii::$app->session;
        $session->open();
        $queryParams = isset($session['query_params']) ? json_decode($session['query_params'], true) : [];
        $session->close();
        $searchModel = new SeguimientosSearch();
        $dataProvider = $searchModel->searchquedebenllegar($queryParams);
        $dataProvider->pagination->pageSize=1000;
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $formatter = \Yii::$app->formatter;
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
            'format' => Pdf::FORMAT_LETTER, 
            //'defaultFontSize' => 18,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            //'destination' => Pdf::DEST_DOWNLOAD, 
            'filename'=>'que deben llegar.pdf',
            
            //Se renderiza la vista "pdf" (que abrirá la nueva ventana)
            'content' => $this->renderPartial('quedebenllegarpdf', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]),
            'cssInline' => 'table thead th { background: #D7D9DC; color: black; font-size: 13pt; } table thead a { color: black;}  ', 
            'options' => [
                            // any mpdf options you wish to set
            ],
            'methods' => [
                'SetTitle' => 'S.A.C. Sistema de Administración de Correspondencia',
                'SetSubject' => 'Generating PDF files via yii2-mpdf extension has never been easy',
                'SetHeader' => ['S.A.C. Sistema de Administración de Correspondencia|| Fecha: ' . $formatter->asDate(date("r"))],
                'SetFooter' => ['|Página {PAGENO}|'],
                'SetAuthor' => 'Autor: Sistemas',
                'SetCreator' => 'Alvaro Fabian Canqui Callisaya',
//              'SetKeywords' => 'Sie, Yii2, Export, PDF, MPDF, Output, yii2-mpdf',
            ]
        ]);
        return $pdf->render();
    }
    
    
    public function actionPendientesoficialespdf() 
    {
        $session = Yii::$app->session;
        $session->open();
        $queryParams = isset($session['query_params']) ? json_decode($session['query_params'], true) : [];
        $session->close();
        $searchModel = new SeguimientosSearch();
        $dataProvider = $searchModel->searchpendientesoficiales($queryParams);
        $dataProvider->pagination->pageSize=1000;
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $formatter = \Yii::$app->formatter;
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
            'format' => Pdf::FORMAT_LETTER, 
            //'defaultFontSize' => 18,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            //'destination' => Pdf::DEST_DOWNLOAD, 
            'filename'=>'pendientes originales.pdf',
            
            //Se renderiza la vista "pdf" (que abrirá la nueva ventana)
            'content' => $this->renderPartial('pendientesoficialespdf', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]),
            'cssInline' => 'table thead th { background: #D7D9DC; color: black; font-size: 13pt; } table thead a { color: black;}  ', 
            'options' => [
                            // any mpdf options you wish to set
            ],
            'methods' => [
                'SetTitle' => 'S.A.C. Sistema de Administración de Correspondencia',
                'SetSubject' => 'Generating PDF files via yii2-mpdf extension has never been easy',
                'SetHeader' => ['S.A.C. Sistema de Administración de Correspondencia|| Fecha: ' . $formatter->asDate(date("r"))],
                'SetFooter' => ['|Página {PAGENO}|'],
                'SetAuthor' => 'Autor: Sistemas',
                'SetCreator' => 'Alvaro Fabian Canqui Callisaya',
//              'SetKeywords' => 'Sie, Yii2, Export, PDF, MPDF, Output, yii2-mpdf',
            ]
        ]);
        return $pdf->render();
    }
    
    public function actionPendientesbloquepdf() 
    {
        $session = Yii::$app->session;
        $session->open();
        $queryParams = isset($session['query_params']) ? json_decode($session['query_params'], true) : [];
        $session->close();
        $searchModel = new SeguimientosSearch();
        $dataProvider = $searchModel->searchpendientesbloque($queryParams);
        $dataProvider->pagination->pageSize=1000;
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $formatter = \Yii::$app->formatter;
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
            'format' => Pdf::FORMAT_LETTER, 
            //'defaultFontSize' => 18,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            //'destination' => Pdf::DEST_DOWNLOAD, 
            'filename'=>'pendientes.pdf',
            
            //Se renderiza la vista "pdf" (que abrirá la nueva ventana)
            'content' => $this->renderPartial('pendientesbloquepdf', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]),
            'cssInline' => 'table thead th { background: #D7D9DC; color: black; font-size: 13pt; } table thead a { color: black;}  ', 
            'options' => [
                            // any mpdf options you wish to set
            ],
            'methods' => [
                'SetTitle' => 'S.A.C. Sistema de Administración de Correspondencia',
                'SetSubject' => 'Generating PDF files via yii2-mpdf extension has never been easy',
                'SetHeader' => ['S.A.C. Sistema de Administración de Correspondencia|| Fecha: ' . $formatter->asDate(date("r"))],
                'SetFooter' => ['|Página {PAGENO}|'],
                'SetAuthor' => 'Autor: Sistemas',
                'SetCreator' => 'Alvaro Fabian Canqui Callisaya',
//              'SetKeywords' => 'Sie, Yii2, Export, PDF, MPDF, Output, yii2-mpdf',
            ]
        ]);
        return $pdf->render();
    }
    
    
    public function actionPendientescopiaspdf() 
    {
        $session = Yii::$app->session;
        $session->open();
        $queryParams = isset($session['query_params']) ? json_decode($session['query_params'], true) : [];
        $session->close();
        $searchModel = new SeguimientosSearch();
        $dataProvider = $searchModel->searchpendientescopias($queryParams);
        $dataProvider->pagination->pageSize=1000;
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $formatter = \Yii::$app->formatter;
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
            'format' => Pdf::FORMAT_LETTER, 
            //'defaultFontSize' => 18,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            //'destination' => Pdf::DEST_DOWNLOAD, 
            'filename'=>'pendientes copia.pdf',
            
            //Se renderiza la vista "pdf" (que abrirá la nueva ventana)
            'content' => $this->renderPartial('pendientescopiaspdf', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]),
            'cssInline' => 'table thead th { background: #D7D9DC; color: black; font-size: 13pt; } table thead a { color: black;}  ', 
            'options' => [
                            // any mpdf options you wish to set
            ],
            'methods' => [
                'SetTitle' => 'S.A.C. Sistema de Administración de Correspondencia',
                'SetSubject' => 'Generating PDF files via yii2-mpdf extension has never been easy',
                'SetHeader' => ['S.A.C. Sistema de Administración de Correspondencia|| Fecha: ' . $formatter->asDate(date("r"))],
                'SetFooter' => ['|Página {PAGENO}|'],
                'SetAuthor' => 'Autor: Sistemas',
                'SetCreator' => 'Alvaro Fabian Canqui Callisaya',
//              'SetKeywords' => 'Sie, Yii2, Export, PDF, MPDF, Output, yii2-mpdf',
            ]
        ]);
        return $pdf->render();
    }
    
    
    public function actionExportexcel()
    {

            $queryParams = Yii::$app->getRequest()->getQueryParams(); //capture queryParams
            $searchModel = new SeguimientosSearch();
            $dataProvider = $searchModel->searchquedebenllegar($queryParams); //apply queryParams to dataProvider

            $totalCount = $dataProvider->getTotalCount();
            $dataProvider->pagination = ['pageSize' => $totalCount];
            $filename = 'Data-'.Date('YmdGis').'-RPJMN.xls';

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header("Content-Disposition: attachment; filename=".$filename);
            echo '<table >
            <thead>
            <tr>
            <th>wilayah</th>
            <th>tahun</th>
            <th>periode</th>
            <th>id_periode</th>
            <th>nilai</th>

            </tr>
            </thead>';

            foreach($dataProvider->getModels() as $data){
            // foreach($model as $data){
            echo '
            <tr>
            <td>'.$data['codigo'].'</td>
            <td>'.$data['derivado_por'].'</td>
            <td>'.$data['proveido'].'</td>
            <td>'.$data['fecha_derivacion'].'</td>
            <td>'.$data['fk_accion'].'</td>
            

            </tr>
            ';
            }
            echo '</table>';

    }
    
//###########################################################################################    
// FUNCION PARA ABRIR LA VENTANA POPUP

    public function actionVerdocumentoseguimiento($id)
    {
        /*return $this->render('verdocumento', [
            'model' => $this->findModel($id),
        ]);*/
        
        $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->renderAjax('verdocumentoseguimiento', [
                    'model' => $model,
                    'id' => $id,
                ]);
            }
        
    }
    
    public function actionVerdocumentopendiente($id)
    {
        /*return $this->render('verdocumento', [
            'model' => $this->findModel($id),
        ]);*/
        
        
       // $seguimiento=Seguimientos::model()->findByPk($id_seguimiento);
        
        $seguimiento = $this->findModel($id);

    	$connection= Yii::$app->db;
	$row=$connection->createCommand("SELECT fk_documento
					   FROM hojas_ruta
	 				   WHERE nur='$seguimiento->codigo' AND nro=0 AND activo=1 limit 1
				   ")->query()->read();
                
                
        $model = Documentos::findOne($row['fk_documento']);
        
        
        //$model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->renderAjax('verdocumentoseguimiento', [
                    'model' => $model,
                    'id' => $model->id_documento,
                ]);
            }
        
    }
    
    public function actionVerdocumentogenerado($id)
    {
        $model = Documentos::findOne($id);
        
        
        //$model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->renderAjax('verdocumentoseguimiento', [
                    'model' => $model,
                    'id' => $model->id_documento,
                ]);
            }
        
    }
    
    public function actionViewdetallearchivo($id)
    {
        /*return $this->render('verdocumento', [
            'model' => $this->findModel($id),
        ]);*/
        
        $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->renderAjax('viewDetalleArchivo', [
                    'model' => $model,
                    'id_seguimiento' => $id,
                ]);
            }
        
    }
    
//###########################################################################################        
    
    
    
    
}
