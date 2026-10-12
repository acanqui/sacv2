<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Seguimientos;
use app\models\Areas;
//use yii\helpers\Json;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    /*public function actionIndex()
    {
        return $this->render('index');
    }*/
    
    public function actionIndex()
    {
        //return $this->render('index');
        if(Yii::$app->user->identity){
            
            if(Yii::$app->user->identity->password=="0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8"){
                return $this->redirect(['usuarios/cambiarcontrasena', 'id_usuario'=>Yii::$app->user->identity->id_usuario]);
           
                
                //return $this->redirect(\yii\helpers\Url::toRoute(['updatepassword/createpassword, id_usuario'=>Yii::$app->user->identity->id_usuario], true));
                //return $this->render('index');
            }else{
                
                if(Yii::$app->user->identity->fk_nivel==5){
                    return $this->redirect(['hojasruta/adminventanilla']);
                }else{
                    
                    if((date('Y-m-d')>Seguimientos::getFechaBloqueo()) && Seguimientos::countTotalQueDebenLlegar()>0)
                    {
                        
                        if(Yii::$app->user->identity->usuario=='dge' || Yii::$app->user->identity->usuario=='sistemass' || Yii::$app->user->identity->usuario=='administrativa' || Yii::$app->user->identity->usuario=='financiera'  || Yii::$app->user->identity->usuario=='operativa' || Yii::$app->user->identity->usuario=='contabilidad' || Yii::$app->user->identity->usuario == 'juridica'){ //añadido juridica
                            
                            return $this->render('index');
                        }
                        else{
                            return $this->redirect(['seguimientos/adminbloqueo']);
                        }
                        
                    }
                    else{
                            // codigo parea bloquear en caso de que no se reciban documentos
                            $fecha=Seguimientos::restarDiasfecha(date('Y-m-d'),2);
                            $total=Seguimientos::bloqueonorecibidos($fecha);
                            if($total>0 && Yii::$app->user->identity->usuario=='juridicas'){

                                return $this->redirect(['seguimientos/adminbloqueonorecibidos']);
                            }
                            else{
                                return $this->render('index');
                            }
                    }
                    
                    
                    //return $this->render('index');
                    
                }
                
                
            }
            
    
        } // fin if
        else{
           // echo "hola";
    
           return $this->redirect(['login']);
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionMenudocumentos()
    {
        return $this->render('menudocumentos');
    }
    
    public function actionMenucites()
    {
        return $this->render('menucites');
    }
    
    public function actionMenubusqueda()
    {
        return $this->render('menubusqueda');
    }
    
    public function actionBusquedageneral($palabra="NULL")
    {
        //return $this->render('busquedageneral');
        $palabra=trim($palabra);

        return $this->render('busquedageneral',array(
			'palabra'=>$palabra,
	    ));
    }

    public function actionBusquedasintesis($palabra="NULL",$gestion="NULL")
    {
        //return $this->render('busquedageneral');
        $palabra=trim($palabra);
        $gestion=trim($gestion);

        return $this->render('busquedasintesis',array(

            'palabra'=>$palabra,
            'gestion'=>$gestion,

        ));
    }

    public function actionBusquedanameremitente($palabra="NULL",$gestion="NULL")
    {
        //return $this->render('busquedageneral');
        $palabra=trim($palabra);
        $gestion=trim($gestion);

        return $this->render('busquedanameremitente',array(

            'palabra'=>$palabra,
            'gestion'=>$gestion,

        ));
    }

    public function actionBusquedainstitucionremitente($palabra="NULL",$gestion="NULL")
    {
        //return $this->render('busquedageneral');
        $palabra=trim($palabra);
        $gestion=trim($gestion);

        return $this->render('busquedainstitucionremitente',array(

            'palabra'=>$palabra,
            'gestion'=>$gestion,

        ));
    }

    public function actionBusquedacite($palabra="NULL",$gestion="NULL")
    {
        //return $this->render('busquedageneral');
        $palabra=trim($palabra);
        $gestion=trim($gestion);

        return $this->render('busquedacite',array(

            'palabra'=>$palabra,
            'gestion'=>$gestion,

        ));
    }

    public function actionBusquedareferencia($palabra="NULL",$gestion="NULL")
    {
        //return $this->render('busquedageneral');
        $palabra=trim($palabra);
        $gestion=trim($gestion);

        return $this->render('busquedareferencia',array(

            'palabra'=>$palabra,
            'gestion'=>$gestion,

        ));
    }




    
    public function actionMenuadministrador()
    {
        return $this->render('menuadministrador');
    }
    
    public function actionMenuopciones()
    {
        return $this->render('menuopciones');
    }
    
    public function actionIndexajax()
    {
        return $this->renderAjax('_index');
    }

    public function actionMenudocumentosarchivo($id)
    {
        
        $model = Areas::findOne($id);
        return $this->render('menudocumentosarchivo',['model'=>$model,]);
    }
    
 
    /*   public function actionDocumentosdata() {
        //$html = $this->renderPartial('menudocumentos');
        //return Json::encode($html);
        

        //, ['gestion'=>$gestion ]
        Yii::$app->response->format = Response::FORMAT_JSON;
        return array(
            $this->renderPartial(
                       'documentos'
                )
            );
    } */
}
