<?php

namespace app\controllers;

use Yii;

use kartik\mpdf\Pdf;
use app\models\Documentos;
use app\models\Hojasruta;
use app\models\DocumentosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\UploadedFile;

//use app\models\Yii;
/**
 * DocumentosController implements the CRUD actions for Documentos model.
 */
class DocumentosController extends Controller
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
     * Lists all Documentos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionDocumentossinnuri()
    {
        $searchModel = new DocumentosSearch();
        $dataProvider = $searchModel->searchSinNuri(Yii::$app->request->queryParams);
        
        $session = Yii::$app->session;
        $session->open();
        $session['query_params'] = json_encode(Yii::$app->request->queryParams);
        $session->close();
        
        
        $dataProvider->pagination->pageSize=10;

        return $this->render('documentossinnuri', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionDocumentosestado()
    {
        $searchModel = new DocumentosSearch();
        $dataProvider = $searchModel->searchDocumentosestado(Yii::$app->request->queryParams);
        
        $session = Yii::$app->session;
        $session->open();
        $session['query_params'] = json_encode(Yii::$app->request->queryParams);
        $session->close();
        
        $dataProvider->pagination->pageSize=10;

        return $this->render('documentosestado', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionAdmintipo($gestion, $tipo)
    {
        $searchModel = new DocumentosSearch();
        $dataProvider = $searchModel->searchTipo(Yii::$app->request->queryParams, $gestion, $tipo);
        
        $dataProvider->pagination->pageSize=10;

        return $this->render('admintipo', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'gestion' => $gestion,
            'tipo' => $tipo,
        ]);
    }
    
    public function actionAdmincites($gestion, $tipo)
    {
        $searchModel = new DocumentosSearch();
        $dataProvider = $searchModel->searchCite(Yii::$app->request->queryParams, $gestion, $tipo);
        
        $dataProvider->pagination->pageSize=10;

        return $this->render('admincite', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'gestion' => $gestion,
            'tipo' => $tipo,
        ]);
    }

    /**
     * Displays a single Documentos model.
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
    
    public function actionVerdocumento($id)
    {
        /*return $this->render('verdocumento', [
            'model' => $this->findModel($id),
        ]);*/
        
        $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->renderAjax('verdocumento', [
                    'model' => $model,
                ]);
            }
        
    }

    /**
     * Creates a new Documentos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Documentos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_documento]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionCreatecartaexterna()
    {
        $model = new Documentos();

        if ($model->load(Yii::$app->request->post())) {
            
            //$model->fecha=Yii::$app->formatter->asDate($_POST['Documentos']['fecha'], 'php:Y-m-d');
            
            //$model->fecha= date("Y-m-d", strtotime($_POST['Documentos']['fecha']));
            /*$date = date_create($_POST['Documentos']['fecha']);
            $model->fecha= date_format($date, "Y-m-d");*/
            

            $model->fecha= Documentos::cambiarfecha($_POST['Documentos']['fecha']);
            $model->destinatario_titulo='null';          
            //$model->remitente_institucion='null';
            $model->hora=date('H:i:s');
            $model->via_nombres='null';
            $model->via_cargo='null';
            //$model->nro_hojas='';
            $model->gestion=date('Y');
            $model->fecha_registro=date('Y-m-d');
            $model->hora_registro=date('H:i:s');
            
            $model->fk_usuario=Yii::$app->user->identity->id_usuario;
            $model->fk_area=Yii::$app->user->identity->fk_area;
            $model->fk_tipo_documento=7;
            $model->fk_documento=0;
            //$model->ruta_documento='S/R';
            $model->activo=1;
            //$model->usuario_destino=0;
            $model->nombre_grupo='null';
            
            
            
            
            
           $archivo = UploadedFile::getInstance($model, 'archivo');
           echo "----------------> ";
           print_r($archivo);
           echo '<pre>';
           print_r($_FILES);
           echo '</pre>';
           //exit();
           
           if (!is_null($archivo)) {
               
             $nombre_archivo = $archivo->name;
             
             $array=explode(".", $archivo->name);
             $count=count($array);
             $ext = $array[$count-1];
             
              // generate a unique file name to prevent duplicate filenames
              //$model->ruta_documento = Yii::$app->security->generateRandomString().".{$ext}";
              $model->ruta_documento = date('dmYHis').".{$ext}";
              // the path to save file, you can set an uploadPath
              // in Yii::$app->params (as used in example below)                       
              Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/'.date('Y').'/';
              $path = Yii::$app->params['uploadPath'] . $model->ruta_documento;
              $archivo->saveAs($path);
               
               /*foreach ($model->archivo as $archivo) {
                   
                   $rnd = rand(0, 99999999);
                  
                    
                    $archivo->saveAs('/web/uploads/2022/'.$rnd.'.'.$archivo->extension);
                    $ruta_documento=$rnd.'.'.$archivo->extension;
                    $model->ruta_documento = $rnd . '.' . $archivo->extension;
                    
                    //echo "ruta ----> ".$ruta_documento;
                   // exit();
                } */
               
                
               
            }
            else{
                $model->ruta_documento="S/R";
                echo "no subbio el archivo";
                Yii::$app->session->setFlash('error', "Error al subir el documento <b>PDF</b> al servidor, comuniquese con el administrador del Sistema S.A.C.");
                exit();
            }
            
            
           // $model->codigo='0';
            
            if($model ->validate())
            { 
                $gestion=date('Y');
		$area=Yii::$app->user->identity->fk_area;
		$tipo_documento=7;
		$regional=Yii::$app->user->identity->fk_regional;

		//$model->codigo=Documentos::getCodigo($gestion,$area,$tipo_documento,$regional);
                                
                if($model->save()){
                    //CODIGO PARA ASIGNAR NUR
                    $gestion = date('Y');
                    Documentos::insertNurHojaRuta($gestion, $model->id_documento, $model->codigo);
                    
                    Yii::$app->session->setFlash('success', "La información de la Nota Externa se registró correctamente. El NUR asigando es: <b>". Documentos::getnumeronuri($model->id_documento)."</b>");
                    return $this->redirect(['updatecartaexterna', 'id' => $model->id_documento]);
                }
                else{
                    Yii::$app->session->setFlash('error', "Error al registrar la información de la Nota Externa, comuniquese con el administrador del Sistema S.A.C.");
                    print_r($model->getAttributes());
                    print_r($model->getErrors());
                    var_dump ($model->getErrors()); die();
                }
            }
            else{
                print_r($model->getAttributes());
                print_r($model->getErrors()); 
            }
            
        }

        return $this->render('createcartaexterna', [
            'model' => $model,
        ]);
    }
    
    public function actionCreatecarta()
    {
        $model = new Documentos();

        if ($model->load(Yii::$app->request->post())) {
            
            //$model->fecha=Yii::$app->formatter->asDate($_POST['Documentos']['fecha'], 'php:Y-m-d');
            
            //$model->fecha= date("Y-m-d", strtotime($_POST['Documentos']['fecha']));
            /*$date = date_create($_POST['Documentos']['fecha']);
            $model->fecha= date_format($date, "Y-m-d");*/
            $model->fecha= Documentos::cambiarfecha($_POST['Documentos']['fecha']);
                  
            $model->remitente_institucion='null';
            $model->hora=date('H:i:s');
            $model->via_nombres='null';
            $model->via_cargo='null';
            //$model->nro_hojas='';
            $model->gestion=date('Y');
            $model->fecha_registro=date('Y-m-d');
            $model->hora_registro=date('H:i:s');
            
            $model->fk_usuario=Yii::$app->user->identity->id_usuario;
            $model->fk_area=Yii::$app->user->identity->fk_area;
            $model->fk_tipo_documento=4;
            $model->fk_documento=0;
            $model->ruta_documento='S/R';
            $model->activo=1;
            //$model->usuario_destino=0;
            $model->nombre_grupo='null';
            $model->fk_motivo=0;
            
            
            $model->codigo='0';
            
            if($model ->validate())
            { 
                $gestion=date('Y');
		$area=Yii::$app->user->identity->fk_area;
		$tipo_documento=4;
		$regional=Yii::$app->user->identity->fk_regional;

		$model->codigo=Documentos::getCodigo($gestion,$area,$tipo_documento,$regional);
                
                
                if($model->save()){
                    Yii::$app->session->setFlash('success', "La información de la Carta se registró correctamente. El CITE asignado es: <b>".$model->codigo."</b>");
                    return $this->redirect(['updatecarta', 'id' => $model->id_documento]);
                    
                }
                else{
                    Yii::$app->session->setFlash('error', "Error al registrar la información de la carta, comuniquese con el administrador del Sistema S.A.C.");
                    print_r($model->getAttributes());
                    print_r($model->getErrors());
                }
            }
            else{
                print_r($model->getAttributes());
                print_r($model->getErrors()); 
            }
            
        }

        return $this->render('createcarta', [
            'model' => $model,
        ]);
    }
    
    public function actionCreatenotainterna()
    {
        $model = new Documentos();

        if ($model->load(Yii::$app->request->post())) {
            
            //$model->fecha=Yii::$app->formatter->asDate($_POST['Documentos']['fecha'], 'php:Y-m-d');
            
            //$model->fecha= date("Y-m-d", strtotime($_POST['Documentos']['fecha']));
            /*$date = date_create($_POST['Documentos']['fecha']);
            $model->fecha= date_format($date, "Y-m-d");*/
            //$model->fecha= Documentos::cambiarfecha($_POST['Documentos']['fecha']);
                    
            $model->remitente_institucion='null';
            $model->destinatario_institucion='null';
            $model->fecha=date('Y-m-d');
            $model->hora=date('H:i:s');
            $model->destinatario_titulo='null';
            //$model->via_cargo='null';
            //$model->nro_hojas='';
            $model->gestion=date('Y');
            $model->fecha_registro=date('Y-m-d');
            $model->hora_registro=date('H:i:s');
            
            $model->fk_usuario=Yii::$app->user->identity->id_usuario;
            $model->fk_area=Yii::$app->user->identity->fk_area;
            $model->fk_tipo_documento=2;
            $model->fk_documento=0;
            $model->ruta_documento='S/R';
            $model->activo=1;
            //$model->usuario_destino=0;
            $model->nombre_grupo='null';
            $model->fk_motivo=0;
            
            
            $model->codigo='0';
            
            if($model ->validate())
            { 
                $gestion=date('Y');
		$area=Yii::$app->user->identity->fk_area;
		$tipo_documento=2;
		$regional=Yii::$app->user->identity->fk_regional;

		$model->codigo=Documentos::getCodigo($gestion,$area,$tipo_documento,$regional);
                                
                if($model->save()){
                    Yii::$app->session->setFlash('success', "La información de la Nota Interna se registró correctamente. El CITE asignado es: <b>".$model->codigo."</b>");
                    return $this->redirect(['updatenotainterna', 'id' => $model->id_documento]);
                }
                else{
                    Yii::$app->session->setFlash('error', "Error al registrar la información de la Nota Interna, comuniquese con el administrador del Sistema S.A.C.");
                    print_r($model->getAttributes());
                    print_r($model->getErrors());
                }
            }
            else{
                print_r($model->getAttributes());
                print_r($model->getErrors()); 
            }
            
        }

        return $this->render('createnotainterna', [
            'model' => $model,
        ]);
    }
    
    public function actionCreateinforme()
    {
        $model = new Documentos();

        if ($model->load(Yii::$app->request->post())) {
            
            //$model->fecha=Yii::$app->formatter->asDate($_POST['Documentos']['fecha'], 'php:Y-m-d');
            
            //$model->fecha= date("Y-m-d", strtotime($_POST['Documentos']['fecha']));
            /*$date = date_create($_POST['Documentos']['fecha']);
            $model->fecha= date_format($date, "Y-m-d");*/
            //$model->fecha= Documentos::cambiarfecha($_POST['Documentos']['fecha']);
                    
            $model->remitente_institucion='null';
            $model->destinatario_institucion='null';
            $model->fecha=date('Y-m-d');
            $model->hora=date('H:i:s');
            $model->destinatario_titulo='null';
            //$model->via_cargo='null';
            //$model->nro_hojas='';
            $model->gestion=date('Y');
            $model->fecha_registro=date('Y-m-d');
            $model->hora_registro=date('H:i:s');
            
            $model->fk_usuario=Yii::$app->user->identity->id_usuario;
            $model->fk_area=Yii::$app->user->identity->fk_area;
            $model->fk_tipo_documento=1;
            $model->fk_documento=0;
            $model->ruta_documento='S/R';
            $model->activo=1;
            //$model->usuario_destino=0;
            $model->nombre_grupo='null';
            $model->fk_motivo=0;
            
            
            $model->codigo='0';
            
            if($model ->validate())
            { 
                $gestion=date('Y');
		$area=Yii::$app->user->identity->fk_area;
		$tipo_documento=1;
		$regional=Yii::$app->user->identity->fk_regional;

		$model->codigo=Documentos::getCodigo($gestion,$area,$tipo_documento,$regional);
                                
                if($model->save()){
                    Yii::$app->session->setFlash('success', "La información del Informe se registró correctamente. El CITE asignado es: <b>".$model->codigo."</b>");
                    return $this->redirect(['updateinforme', 'id' => $model->id_documento]);
                }
                else{
                    Yii::$app->session->setFlash('error', "Error al registrar la información del Informe, comuniquese con el administrador del Sistema S.A.C.");
                    print_r($model->getAttributes());
                    print_r($model->getErrors());
                }
            }
            else{
                print_r($model->getAttributes());
                print_r($model->getErrors()); 
            }
            
        }

        return $this->render('createinforme', [
            'model' => $model,
        ]);
    }
    
    public function actionCreatecircular()
    {
        $model = new Documentos();

        if ($model->load(Yii::$app->request->post())) {
            
            //$model->fecha=Yii::$app->formatter->asDate($_POST['Documentos']['fecha'], 'php:Y-m-d');
            
            //$model->fecha= date("Y-m-d", strtotime($_POST['Documentos']['fecha']));
            /*$date = date_create($_POST['Documentos']['fecha']);
            $model->fecha= date_format($date, "Y-m-d");*/
            //$model->fecha= Documentos::cambiarfecha($_POST['Documentos']['fecha']);
                    
            $model->remitente_institucion='null';
            $model->destinatario_institucion='null';
            
            $model->destinatario_cargo='null';
            $model->via_nombres='null';
            $model->via_cargo='null';
            
            $model->fecha=date('Y-m-d');
            $model->hora=date('H:i:s');
            $model->destinatario_titulo='null';
            //$model->via_cargo='null';
            //$model->nro_hojas='';
            $model->gestion=date('Y');
            $model->fecha_registro=date('Y-m-d');
            $model->hora_registro=date('H:i:s');
            
            $model->fk_usuario=Yii::$app->user->identity->id_usuario;
            $model->fk_area=Yii::$app->user->identity->fk_area;
            $model->fk_tipo_documento=5;
            $model->fk_documento=0;
            $model->ruta_documento='S/R';
            $model->activo=1;
            //$model->usuario_destino=0;
            $model->nombre_grupo='null';
            $model->fk_motivo=0;
            
            
            $model->codigo='0';
            
            if($model ->validate())
            { 
                $gestion=date('Y');
		$area=Yii::$app->user->identity->fk_area;
		$tipo_documento=5;
		$regional=Yii::$app->user->identity->fk_regional;

		$model->codigo=Documentos::getCodigo($gestion,$area,$tipo_documento,$regional);
                                
                if($model->save()){
                    Yii::$app->session->setFlash('success', "La información de la Circular se registró correctamente. El CITE asignado es: <b>".$model->codigo."</b>");
                    return $this->redirect(['updatecircular', 'id' => $model->id_documento]);
                }
                else{
                    Yii::$app->session->setFlash('error', "Error al registrar la información de la Circular, comuniquese con el administrador del Sistema S.A.C.");
                    print_r($model->getAttributes());
                    print_r($model->getErrors());
                }
            }
            else{
                print_r($model->getAttributes());
                print_r($model->getErrors()); 
            }
            
        }

        return $this->render('createcircular', [
            'model' => $model,
        ]);
    }
    
    public function actionCreatememorandum()
    {
        $model = new Documentos();

        if ($model->load(Yii::$app->request->post())) {
            
            //$model->fecha=Yii::$app->formatter->asDate($_POST['Documentos']['fecha'], 'php:Y-m-d');
            
            //$model->fecha= date("Y-m-d", strtotime($_POST['Documentos']['fecha']));
            /*$date = date_create($_POST['Documentos']['fecha']);
            $model->fecha= date_format($date, "Y-m-d");*/
            //$model->fecha= Documentos::cambiarfecha($_POST['Documentos']['fecha']);
                    
            $model->remitente_institucion='null';
            $model->destinatario_institucion='null';
            
            //$model->destinatario_cargo='null';
            $model->via_nombres='null';
            $model->via_cargo='null';
            
            $model->fecha=date('Y-m-d');
            $model->hora=date('H:i:s');
            $model->destinatario_titulo='null';
            //$model->via_cargo='null';
            //$model->nro_hojas='';
            $model->gestion=date('Y');
            $model->fecha_registro=date('Y-m-d');
            $model->hora_registro=date('H:i:s');
            
            $model->fk_usuario=Yii::$app->user->identity->id_usuario;
            $model->fk_area=Yii::$app->user->identity->fk_area;
            $model->fk_tipo_documento=3;
            $model->fk_documento=0;
            $model->ruta_documento='S/R';
            $model->activo=1;
            //$model->usuario_destino=0;
            $model->nombre_grupo='null';
            $model->fk_motivo=0;
            
            
            $model->codigo='0';
            
            if($model ->validate())
            { 
                $gestion=date('Y');
		$area=Yii::$app->user->identity->fk_area;
		$tipo_documento=3;
		$regional=Yii::$app->user->identity->fk_regional;

		$model->codigo=Documentos::getCodigo($gestion,$area,$tipo_documento,$regional);
                                
                if($model->save()){
                    Yii::$app->session->setFlash('success', "La información del Memorando se registró correctamente. El CITE asignado es: <b>".$model->codigo."</b>");
                    return $this->redirect(['updatememorandum', 'id' => $model->id_documento]);
                }
                else{
                    Yii::$app->session->setFlash('error', "Error al registrar la información del Memorando, comuniquese con el administrador del Sistema S.A.C.");
                    print_r($model->getAttributes());
                    print_r($model->getErrors());
                }
            }
            else{
                print_r($model->getAttributes());
                print_r($model->getErrors()); 
            }
            
        }

        return $this->render('creatememorandum', [
            'model' => $model,
        ]);
    }
    
    public function actionCreateinstructivo()
    {
        $model = new Documentos();

        if ($model->load(Yii::$app->request->post())) {
            
            //$model->fecha=Yii::$app->formatter->asDate($_POST['Documentos']['fecha'], 'php:Y-m-d');
            
            //$model->fecha= date("Y-m-d", strtotime($_POST['Documentos']['fecha']));
            /*$date = date_create($_POST['Documentos']['fecha']);
            $model->fecha= date_format($date, "Y-m-d");*/
            //$model->fecha= Documentos::cambiarfecha($_POST['Documentos']['fecha']);
                    
            $model->remitente_institucion='null';
            $model->destinatario_institucion='null';
            
            //$model->destinatario_cargo='null';
            $model->via_nombres='null';
            $model->via_cargo='null';
            
            $model->fecha=date('Y-m-d');
            $model->hora=date('H:i:s');
            $model->destinatario_titulo='null';
            //$model->via_cargo='null';
            //$model->nro_hojas='';
            $model->gestion=date('Y');
            $model->fecha_registro=date('Y-m-d');
            $model->hora_registro=date('H:i:s');
            
            $model->fk_usuario=Yii::$app->user->identity->id_usuario;
            $model->fk_area=Yii::$app->user->identity->fk_area;
            $model->fk_tipo_documento=8;
            $model->fk_documento=0;
            $model->ruta_documento='S/R';
            $model->activo=1;
            //$model->usuario_destino=0;
            $model->nombre_grupo='null';
            $model->fk_motivo=0;
            
            
            $model->codigo='0';
            
            if($model ->validate())
            { 
                $gestion=date('Y');
		$area=Yii::$app->user->identity->fk_area;
		$tipo_documento=8;
		$regional=Yii::$app->user->identity->fk_regional;

		$model->codigo=Documentos::getCodigo($gestion,$area,$tipo_documento,$regional);
                                
                if($model->save()){
                    Yii::$app->session->setFlash('success', "La información del Instructivo se registró correctamente. El CITE asignado es: <b>".$model->codigo."</b>");
                    return $this->redirect(['updateinstructivo', 'id' => $model->id_documento]);
                }
                else{
                    Yii::$app->session->setFlash('error', "Error al registrar la información del Instructivo, comuniquese con el administrador del Sistema S.A.C.");
                    print_r($model->getAttributes());
                    print_r($model->getErrors());
                }
            }
            else{
                print_r($model->getAttributes());
                print_r($model->getErrors()); 
            }
            
        }

        return $this->render('createinstructivo', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Documentos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->save()){
            
                Yii::$app->session->setFlash('success', "La contraseña fue cambiada correctamente.");
                return $this->redirect(['view', 'id' => $model->id_documento]);
            }
            else{
                Yii::$app->session->setFlash('error', "Error al cambiar la contraseña.");
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    public function actionUpdatecartaexterna($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->fecha= Documentos::cambiarfecha($_POST['Documentos']['fecha']);
            
            $archivo = UploadedFile::getInstance($model, 'archivo');
           echo "----------------> ";
           print_r($archivo);
           echo '<pre>';
            print_r($_FILES);
            echo '</pre>';
           //exit();
           
           if (!is_null($archivo)) {
               
             $nombre_archivo = $archivo->name;
             
             $array=explode(".", $archivo->name);
             $count=count($array);
             $ext = $array[$count-1];
             
              // generate a unique file name to prevent duplicate filenames
              //$model->ruta_documento = Yii::$app->security->generateRandomString().".{$ext}";
              $model->ruta_documento = date('dmYHis').".{$ext}";
              // the path to save file, you can set an uploadPath
              // in Yii::$app->params (as used in example below)                       
              Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/'.date('Y').'/';
              $path = Yii::$app->params['uploadPath'] . $model->ruta_documento;
              $archivo->saveAs($path);
               
               /*foreach ($model->archivo as $archivo) {
                   
                   $rnd = rand(0, 99999999);
                  
                    
                    $archivo->saveAs('/web/uploads/2022/'.$rnd.'.'.$archivo->extension);
                    $ruta_documento=$rnd.'.'.$archivo->extension;
                    $model->ruta_documento = $rnd . '.' . $archivo->extension;
                    
                    //echo "ruta ----> ".$ruta_documento;
                   // exit();
                } */
               
                
               
            }
            
            
            
            if($model->save()){

                Documentos::actualizarcitehojasruta($model->id_documento, $model->codigo);
            
                Yii::$app->session->setFlash('success', "La Nota Externa con CITE N° <b>".$model->codigo."</b>, se modificó correctamente.");
                return $this->redirect(['updatecartaexterna', 'id' => $model->id_documento]);
            }
            else{
                Yii::$app->session->setFlash('error', "Error al modificar la Nota Externa con CITE N° ".$model->codigo.", comuniquese con el administrador del Sistema S.A.C.");
            }
            
            
        }

        return $this->render('updatecartaexterna', [
            'model' => $model,
        ]);
    }
    
    
    public function actionUpdatecarta($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {

            $model->fecha= Documentos::cambiarfecha($_POST['Documentos']['fecha']);
            $model->fk_motivo=0;
            
            if($model->save()){
            
                Yii::$app->session->setFlash('success', "La carta con CITE N° <b>".$model->codigo."</b>, se modificó correctamente.");
                return $this->redirect(['updatecarta', 'id' => $model->id_documento]);
            }
            else{
                Yii::$app->session->setFlash('error', "Error al modificar la carta con CITE N° ".$model->codigo.", comuniquese con el administrador del Sistema S.A.C.");
            }
            
            
        }

        return $this->render('updatecarta', [
            'model' => $model,
        ]);
    }
    
    
    public function actionUpdatenotainterna($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {

            $model->fk_motivo=0;
            
            if($model->save()){
            
                Yii::$app->session->setFlash('success', "La Nota Interna con CITE N° <b>".$model->codigo."</b>, se modificó correctamente.");
                return $this->redirect(['updatenotainterna', 'id' => $model->id_documento]);
            }
            else{
                Yii::$app->session->setFlash('error', "Error al modificar la Nota Interna con CITE N° ".$model->codigo.", comuniquese con el administrador del Sistema S.A.C.");
            }
            
            
            
        }

        return $this->render('updatenotainterna', [
            'model' => $model,
        ]);
    }
    
    public function actionUpdateinforme($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {

            $model->fk_motivo=0;
            
            
            if($model->save()){
            
                Yii::$app->session->setFlash('success', "El Informe con CITE N° <b>".$model->codigo."</b>, se modificó correctamente.");
                return $this->redirect(['updateinforme', 'id' => $model->id_documento]);
            }
            else{
                Yii::$app->session->setFlash('error', "Error al modificar el Informe con CITE N° ".$model->codigo.", comuniquese con el administrador del Sistema S.A.C.");
            }
            
        }

        return $this->render('updateinforme', [
            'model' => $model,
        ]);
    }
    
    public function actionUpdatecircular($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            
            $model->fk_motivo=0;
            
            if($model->save()){
            
                Yii::$app->session->setFlash('success', "La Circular con CITE  N° <b>".$model->codigo."</b>, se modificó correctamente.");
                return $this->redirect(['updatecircular', 'id' => $model->id_documento]);
            }
            else{
                Yii::$app->session->setFlash('error', "Error al modificar la Circular con CITE N° ".$model->codigo.", comuniquese con el administrador del Sistema S.A.C.");
            }
            
        }

        return $this->render('updatecircular', [
            'model' => $model,
        ]);
    }
    
    public function actionUpdatememorandum($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            
            $model->fk_motivo=0;

            if($model->save()){
            
                Yii::$app->session->setFlash('success', "El Memorando con CITE  N° <b>".$model->codigo."</b>, se modificó correctamente.");
                return $this->redirect(['updatememorandum', 'id' => $model->id_documento]);
            }
            else{
                Yii::$app->session->setFlash('error', "Error al modificar el Memorando con CITE N° ".$model->codigo.", comuniquese con el administrador del Sistema S.A.C.");
            }
            
        }

        return $this->render('updatememorandum', [
            'model' => $model,
        ]);
    }
    
    public function actionUpdateinstructivo($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            
            $model->fk_motivo=0;

            if($model->save()){
            
                Yii::$app->session->setFlash('success', "El Instructivo con CITE  N° <b>".$model->codigo."</b>, se modificó correctamente.");
                return $this->redirect(['updateinstructivo', 'id' => $model->id_documento]);
            }
            else{
                Yii::$app->session->setFlash('error', "Error al modificar el Instructivo con CITE N° ".$model->codigo.", comuniquese con el administrador del Sistema S.A.C.");
            }
            
            
        }

        return $this->render('updateinstructivo', [
            'model' => $model,
        ]);
    }
    
    public function actionAsignarnuevocite($id_documento){
        
        /*$documento_original = Documentos::findOne($model->id_documento);
        $documento_copy = new Documentos();
        $documento_copy->attributes = $documento_original->attributes;
        $documento_copy->isNewRecord = true;
        //$documento_copy->id_documento = null;
        $documento_copy->save();*/
        
        $gestion=date('Y');
        $area=Yii::$app->user->identity->fk_area;

        /*añadido */
        if ($area == 12) { //12 es el id de area para el area SGC
            $areaQuery = 1;
        } else {
            $areaQuery = $area;
        }
        /*fin añadido */

	    //$tipo_dpocumento=4;
	    $regional=Yii::$app->user->identity->fk_regional;


        
        $documentos = Documentos::findOne($id_documento);
        $model= new Documentos();
        
        $model->attributes = $documentos->attributes;
        $model->isNewRecord = true;
        
        $model->codigo=Documentos::getCodigo($gestion,$areaQuery,$documentos->fk_tipo_documento,$regional); //modificado $area
	//$model->destinatario_titulo='S/D';
	
        //$model->destinatario_institucion='S/D';

    	$model->fecha=date('Y-m-d');
    	$model->hora=date('H:i:s');
    	$model->gestion=date('Y');
    	$model->fecha_registro=date('Y-m-d');
    	$model->hora_registro=date('H:i:s');
        $model->fk_motivo=0;
        
        
        //$documento_copy->id_documento = null;
        
        switch ($documentos->fk_tipo_documento) {
            case 1:
	        $direccion='updateinforme';
                break;
	    case 2:
	        $direccion='updatenotainterna';
	        break;
	    case 3:
	        $direccion='updatememorandum';
	        break;
            case 4:
	        $direccion='updatecarta';
	        break;
            case 5:
	        $direccion='updatecircular';
	        break;
            case 8:
	        $direccion='updateinstructivo';
	        break;
	}
        
        if($model->save()){
            $this->redirect([$direccion,'id'=>$model->id_documento]);
        }
        else{

            print_r($model->getAttributes());
            print_r($model->getErrors());
            var_dump ($model->getErrors()); die();
            exit();
        }
        
    }
    
    
    public function actionAsignarnuri($id_documento)
    {
		$usuario=Yii::$app->user->identity->id_usuario;

		$model=Documentos::findOne($id_documento);

		$gestion=date('Y');
		$tipo_documento=6;
		$nuri=Documentos::getNuri($gestion,$tipo_documento);

		$hojas= new Hojasruta();
		$hojas->nur=$nuri;
		$hojas->codigo=$model->codigo;
		$cite=$model->codigo;;
		$hojas->nro=0;
		$hojas->fecha=date('Y-m-d');
		$hojas->hora=date('H:i:s');
		$hojas->proceso=4;
		$hojas->fecha_registro=date('Y-m-d');
		$hojas->hora_registro=date('H:i:s');
		$hojas->fk_usuario=$usuario;
		$hojas->gestion=$gestion;
		$hojas->fk_documento=$id_documento;
		$hojas->oficial=1;
		$hojas->activo=1;
		//$hojas->save();

		switch ($model->fk_tipo_documento) {
					    case 1:
					        $direccion='updateinforme';
					        break;
					    case 2:
					        $direccion='updatenotainterna';
					        break;
					    case 3:
					        $direccion='updatememorandum';
					        break;
					    case 4:
					        $direccion='updatecarta';
					        break;
					    case 5:
					        $direccion='updatecircular';
					        break;
					    case 8:
					        $direccion='updateinstructivo';
					        break;
					}




				//echo "---> ".$direccion;

		if($hojas->save()){
				// codigo para cambiar el estado del documento a disponible
				$documentos=Documentos::findOne($id_documento);
				$documentos->fk_estado_documento=2;
				$documentos->save();

				$this->redirect([$direccion,'id'=>$model->id_documento]);
			}
			else{
				print_r($hojas->getErrors());
			}

    }

    


//###########################################################################################    
//PROCEDIMIENTOS PARA GENERAR DOCUMENTOS WORD
public function actionNotainformeword($id_documento)
 {
    return $this->render('notainformeword', [
            'documentos' => Documentos::findOne($id_documento),
        ]);
 }  

 public function actionCartaword($id_documento)
{
    return $this->render('cartaword', [
            'documentos' => Documentos::findOne($id_documento),
        ]);
} 

public function actionCircularword($id_documento)
{
    return $this->render('circularword', [
            'documentos' => Documentos::findOne($id_documento),
        ]);
}

public function actionInstructivoword($id_documento)
{
    return $this->render('instructivoword', [
            'documentos' => Documentos::findOne($id_documento),
        ]);
}

public function actionMemorandoword($id_documento)
{
    return $this->render('memorandoword', [
            'documentos' => Documentos::findOne($id_documento),
        ]);
}   

    
//###########################################################################################    
//PROCEDIMIENTOS PARA GENERAR DOCUMENTOS EXCEL   
public function actionReportecite($id_area, $tipo, $gestion)
{
    return $this->renderPartial('reporteciteexcel', [
            'tipo' => $tipo,
            'gestion' => $gestion,
            'id_area' => $id_area,
        ]);
}

public function actionReportecitearchivo($id_area, $tipo, $gestion)
{
    return $this->renderPartial('reportecitearchivoexcel', [
            'tipo' => $tipo,
            'gestion' => $gestion,
            'id_area' => $id_area,
        ]);
}


 
 
 
//###########################################################################################    
//PROCEDIMIENTOS PARA GENERAR DPCUMENTOS PDF   
    public function actionGenerarhrexternopdf($id_hoja_ruta, $id_documento)
    {
       /* return $this->render('generarhrexternopdf', [
            'hojasruta' => Hojasruta::findOne($id_hoja_ruta),
            'documentos' => Documentos::findOne($id_documento),
        ]); 
        
        exit(); */
        
        $hojasruta = Hojasruta::findOne($id_hoja_ruta);
        
        $content = $this->renderPartial('generarhrexternopdf', [ 'hojasruta' => $hojasruta, 'documentos' => Documentos::findOne($id_documento),]);

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
               'filename'=>'HS-'.$hojasruta->nur.'.pdf',
               'marginLeft'=>7,
               'marginRight'=>7,
               'marginTop'=>14.6,
               'marginBottom'=>10,
               // your html content input
               'content' => $content,  
               // format content from your own css file if needed or use the
               // enhanced bootstrap css built by Krajee for mPDF formatting 
               'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
               // any css to be embedded if required
               'cssInline' => '.cuerpo {
                                          width: 100%;
                                          font-family:Verdana, Geneva, sans-serif;
                                        }
                               .tabla_hs{
                                          font-family:Verdana, Geneva, sans-serif;
                                        }
                               .tabla_hs tr td, tr th{
                                           border: .3px solid #1C1C1C;   
                                           border-collapse: collapse;
                                        }', 
                // set mPDF properties on the fly
               'options' => ['title' => 'Krajee Report Title'],
                // call mPDF methods on the fly
                
                 

               'methods' => [ 
                   'SetHeader'=>['
                          
                       <table width="100%" style="vertical-align: top; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;">
                         <tr>
                            <td width="33%" style="font-style: italic;">EERV PATRIA</td>
                            <td width="33%" align="center" style="font-style: italic;"></td>
                            <td width="33%" align="right" style="font-style: italic;">NUR/NURI</td>
                         </tr>
                       </table>  
                          
                          
                        '], 
                   'SetFooter'=>[' 
                       <table width="100%" style="border-top: 1px solid; vertical-align: bottom; font-family: serif; font-size: 12pt; color: #000000; font-weight:bold;">
                         <tr>
                            <td width="50%" style="font-style: italic;">Sistema de Administración de Correspondencia V.2</td>
                            <td width="33%" align="center" style="font-style: italic;">'.$hojasruta->nur.'</td>
                            <td width="50%" style="text-align: right; font-style: italic;  ">S.A.C.</td>
                         </tr>
                       </table>
                      '],
                    'SetWatermarkText'=>'DRAFT',  
                   
                    
               ]


           ]);
           return $pdf->render();
    }
    
    public function actionGenerarhrinternopdf($id_hoja_ruta, $id_documento)
    {
       /* return $this->render('generarhrinternopdf', [
            'hojasruta' => Hojasruta::findOne($id_hoja_ruta),
            'documentos' => Documentos::findOne($id_documento),
        ]); 
        
        exit(); */
        
        $hojasruta = Hojasruta::findOne($id_hoja_ruta);
        
        $content = $this->renderPartial('generarhrinternopdf', [ 'hojasruta' => $hojasruta, 'documentos' => Documentos::findOne($id_documento),]);

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
               'filename'=>'HS-'.$hojasruta->nur.'.pdf',
               'marginLeft'=>7,
               'marginRight'=>7,
               'marginTop'=>14.6,
               'marginBottom'=>10,
               // your html content input
               'content' => $content,  
               // format content from your own css file if needed or use the
               // enhanced bootstrap css built by Krajee for mPDF formatting 
               'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
               // any css to be embedded if required
               'cssInline' => '.cuerpo {
                                          width: 100%;
                                          font-family:Verdana, Geneva, sans-serif;
                                        }
                               .tabla_hs{
                                          font-family:Verdana, Geneva, sans-serif;
                                        }
                               .tabla_hs tr td, tr th{
                                           border: .3px solid #1C1C1C;   
                                           border-collapse: collapse;
                                        }', 
                // set mPDF properties on the fly
               'options' => ['title' => 'Krajee Report Title'],
                // call mPDF methods on the fly
                
                 

               'methods' => [ 
                   'SetHeader'=>['
                          
                       <table width="100%" style="vertical-align: top; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;">
                         <tr>
                            <td width="33%" style="font-style: italic;">EERV - PATRIA</td>
                            <td width="33%" align="center" style="font-style: italic;"></td>
                            <td width="33%" align="right" style="font-style: italic;">NUR/NURI</td>
                         </tr>
                       </table>  
                          
                          
                        '], 
                   'SetFooter'=>[' 
                       <table width="100%" style="border-top: 1px solid; vertical-align: bottom; font-family: serif; font-size: 12pt; color: #000000; font-weight:bold;">
                         <tr>
                            <td width="50%" style="font-style: italic;">Sistema de Administración de Correspondencia V.2</td>
                            <td width="33%" align="center" style="font-style: italic;">'.$hojasruta->nur.'</td>
                            <td width="50%" style="text-align: right; font-style: italic;  ">S.A.C.</td>
                         </tr>
                       </table>
                      '],
                    'SetWatermarkText'=>'DRAFT',  
                   
                    
               ]


           ]);
           return $pdf->render();
    }
    
    public function actionDocumentossinnuripdf() 
    {
        $session = Yii::$app->session;
        $session->open();
        $queryParams = isset($session['query_params']) ? json_decode($session['query_params'], true) : [];
        $session->close();
        $searchModel = new DocumentosSearch();
        $dataProvider = $searchModel->searchSinNuri($queryParams);
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
            'filename'=>'documentos sin NURI.pdf',
            
            //Se renderiza la vista "pdf" (que abrirá la nueva ventana)
            'content' => $this->renderPartial('documentossinnuripdf', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]),
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
    
    public function actionDocumentosestadopdf() 
    {
        $session = Yii::$app->session;
        $session->open();
        $queryParams = isset($session['query_params']) ? json_decode($session['query_params'], true) : [];
        $session->close();
        $searchModel = new DocumentosSearch();
        $dataProvider = $searchModel->searchDocumentosestado($queryParams);
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
            'filename'=>'documentos sin NURI.pdf',
            
            //Se renderiza la vista "pdf" (que abrirá la nueva ventana)
            'content' => $this->renderPartial('documentosestadopdf', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]),
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

    /**
     * Deletes an existing Documentos model.
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
     * Finds the Documentos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Documentos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Documentos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
