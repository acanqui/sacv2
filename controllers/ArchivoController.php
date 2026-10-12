<?php

namespace app\controllers;

use Yii;
use app\models\Archivo;
use app\models\ArchivoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\SeguimientosSearch;
use app\models\Seguimientos;
use app\models\Carpetaarchivo;
use kartik\mpdf\Pdf;

/**
 * ArchivoController implements the CRUD actions for Archivo model.
 */
class ArchivoController extends Controller
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
     * Lists all Archivo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArchivoSearch();
        $dataProvider = $searchModel->searchArchivousuario(Yii::$app->request->queryParams);
        
        $session = Yii::$app->session;
        $session->open();
        $session['query_params'] = json_encode(Yii::$app->request->queryParams);
        $session->close();
        
        $dataProvider->pagination->pageSize=10;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionDesarchivartramites()
    {
        $searchModel = new ArchivoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $session = Yii::$app->session;
        $session->open();
        $session['query_params'] = json_encode(Yii::$app->request->queryParams);
        $session->close();

        return $this->render('desarchivartramites', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Archivo model.
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
    
    public function actionSeleccioncarpeta($id_seguimiento)
    {
        return $this->render('seleccioncarpeta', [
            'seguimientos' => Seguimientos::findOne($id_seguimiento),
        ]);
    }

    /**
     * Creates a new Archivo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatearchivo($id_seguimiento, $id_carpeta)
    {
        $model = new Archivo();

        if ($model->load(Yii::$app->request->post()) ) {
            
            $model->gestion=date('Y');
            $model->fecha_registro=date('Y-m-d');
            $model->hora_registro=date('H:i:s');
            
            $model->fk_usuario=Yii::$app->user->identity->id_usuario;
            $model->fk_area=Yii::$app->user->identity->fk_area;
            $model->fk_regional=Yii::$app->user->identity->fk_regional;
            $model->terminado=0;
            $model->activo=1;
            
            $id_carpeta=$_POST['Archivo']['nombre_carpeta'];
            $oficial=$_POST['Archivo']['oficial'];
            $carpetas = Carpetaarchivo::findOne($id_carpeta);
            $model->nombre_carpeta=$carpetas->nombre_carpeta;
            $model->fk_carpeta_archivo=$id_carpeta;
            
            
            if($model->save()){
                
                // codigo para cambiar el estado del seguimiento en la tabla seguimiento
                $seguimiento=Seguimientos::findOne($id_seguimiento);
                
                if($oficial==1){
                    $seguimiento->fk_estado=5;
                }
                else{
                    $seguimiento->fk_estado=6;
                }

                
                if($seguimiento->save()){
                    Yii::$app->session->setFlash('success', "El trámite <b>".$model->nuri."</b>, se archivó correctamente.");
                    //return $this->redirect(['view', 'id' => $model->id_archivo]);
                    return $this->redirect(['index']);
                }
                else{
                    Yii::$app->session->setFlash('error', "Error al archivar el tramite, comuniquese con el administrador del Sistema S.A.C.");
                    print_r($model->getAttributes());
                    print_r($model->getErrors());
                    var_dump ($model->getErrors()); die();
                }
            }    
        }

        return $this->render('createarchivo', [
            'model' => $model,
            'id_carpeta' => $id_carpeta,
            'seguimientos'=> Seguimientos::findOne($id_seguimiento),
        ]);
    }
    
    

    /**
     * Updates an existing Archivo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            
            $id_carpeta=$_POST['Archivo']['fk_carpeta_archivo'];
            $carpetas = Carpetaarchivo::findOne($id_carpeta);
            $model->nombre_carpeta=$carpetas->nombre_carpeta;
            $model->fk_carpeta_archivo=$id_carpeta;
            
            if($model->save()){
                
                Yii::$app->session->setFlash('success', "Los datos del archivo se modificaron correctamente.");
                return $this->redirect(['index']);
                //return $this->redirect(['view', 'id' => $model->id_archivo]);
            }
            else{
                    Yii::$app->session->setFlash('error', "Error al modificar los datos del archivo, comuniquese con el administrador del Sistema S.A.C.");
                    print_r($model->getAttributes());
                    print_r($model->getErrors());
                    var_dump ($model->getErrors()); die();
            }
        }

        return $this->render('update', [
            'model' => $model,
            'seguimientos'=> Seguimientos::findOne($model->fk_seguimiento),
        ]);
    }
    
    
    public function actionDesarchivar($id_seguimiento, $id_archivo)
    {
	$seguimiento = Seguimientos::findOne($id_seguimiento);
        //$estado=$seguimiento->fk_estado;
        
        
        if ($seguimiento->fk_estado==5) {
		$valor=1;
	}
	else{
		$valor=2;
	}
        
        $seguimiento->fk_estado=$valor;
        
        if($seguimiento->save()){
            
            $model = Archivo::findOne($id_archivo);
            $model->activo=0;
            
            if($model->save()){
                return $this->redirect(['archivo/desarchivartramites']);
            }
            else{
                echo "ERROR";
            }
        }
        else{
            echo "ERROR";
        }
        

	/*$command=Yii::app()->db->createCommand("UPDATE seguimientos
			SET fk_estado=$valor
			WHERE id_seguimiento=$id_seguimiento")->execute();

        $command=Yii::app()->db->createCommand("UPDATE archivo
			SET activo=0
			WHERE fk_seguimiento=$id_seguimiento")->execute();*/



	
	

    } // end function

    /**
     * Deletes an existing Archivo model.
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
     * Finds the Archivo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Archivo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Archivo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
//############################################################################################

    public function actionReportearchivoexcel() 
    {
        //return $this->renderPartial('archivopdf', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
        //exit();

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="REPORTE ARCHIVO.xls"');
        header('Cache-Control: max-age=0');
        
        $session = Yii::$app->session;
        $session->open();
        $queryParams = isset($session['query_params']) ? json_decode($session['query_params'], true) : [];
        $session->close();
        $searchModel = new ArchivoSearch();
        $dataProvider = $searchModel->searchArchivousuario($queryParams);
        $dataProvider->pagination->pageSize=3000;
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $formatter = \Yii::$app->formatter;

        return $this->renderPartial('reportearchivopdf', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);

    }


    public function actionReportearchivopdf() 
    {
        //return $this->renderPartial('archivopdf', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
        //exit();
        
        $session = Yii::$app->session;
        $session->open();
        $queryParams = isset($session['query_params']) ? json_decode($session['query_params'], true) : [];
        $session->close();
        $searchModel = new ArchivoSearch();
        $dataProvider = $searchModel->searchArchivousuario($queryParams);
        $dataProvider->pagination->pageSize=3000;
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $formatter = \Yii::$app->formatter;
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
            'format' => Pdf::FORMAT_LETTER, 
            //'defaultFontSize' => 18,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            //'destination' => Pdf::DEST_DOWNLOAD, 
            'filename'=>'reporte_archivo.pdf',
            
            //Se renderiza la vista "pdf" (que abrirá la nueva ventana)
            'content' => $this->renderPartial('reportearchivopdf', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]),
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
    
    
    public function actionGenerararchivopdf() 
    {
        //return $this->renderPartial('archivopdf', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
        //exit();
        
        $session = Yii::$app->session;
        $session->open();
        $queryParams = isset($session['query_params']) ? json_decode($session['query_params'], true) : [];
        $session->close();
        $searchModel = new ArchivoSearch();
        $dataProvider = $searchModel->search($queryParams);
        $dataProvider->pagination->pageSize=2000;
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $formatter = \Yii::$app->formatter;
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
            'format' => Pdf::FORMAT_LETTER, 
            //'defaultFontSize' => 18,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            //'destination' => Pdf::DEST_DOWNLOAD, 
            'filename'=>'reporte_archivo.pdf',
            
            //Se renderiza la vista "pdf" (que abrirá la nueva ventana)
            'content' => $this->renderPartial('archivopdf', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]),
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
    
    
}// END CLASS
