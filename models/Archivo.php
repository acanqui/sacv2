<?php

namespace app\models;
use yii\helpers\ArrayHelper;
use app\models\Regionales;
use app\models\Seguimientos;
use app\models\Areas;
use Yii;


/**
 * This is the model class for table "archivo".
 *
 * @property int $id_archivo
 * @property string $nuri
 * @property string $acciones
 * @property string $nombre_carpeta
 * @property string $fecha_archivo
 * @property string $tipo_tramite
 * @property string|null $observaciones
 * @property int|null $terminado
 * @property int $gestion
 * @property string $fecha_registro
 * @property string $hora_registro
 * @property int $fk_usuario
 * @property int $fk_seguimiento
 * @property int $fk_regional
 * @property int|null $activo
 * @property int|null $oficial
 * @property int|null $fk_area
 */
class Archivo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'archivo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nuri', 'acciones', 'nombre_carpeta', 'fecha_archivo', 'tipo_tramite', 'gestion', 'fk_usuario', 'fk_seguimiento', 'fk_regional'], 'required'],
            [['fecha_archivo', 'fecha_registro', 'hora_registro'], 'safe'],
            [['terminado', 'gestion', 'fk_usuario', 'fk_seguimiento', 'fk_regional', 'activo', 'oficial', 'fk_area'], 'default', 'value' => null],
            [['terminado', 'gestion', 'fk_usuario', 'fk_seguimiento', 'fk_regional', 'activo', 'oficial', 'fk_area'], 'integer'],
            [['nuri'], 'string', 'max' => 15],
            [['acciones', 'observaciones'], 'string', 'max' => 1000],
            [['nombre_carpeta'], 'string', 'max' => 500],
            [['tipo_tramite'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_archivo' => 'Id Archivo',
            'nuri' => 'Hoja de Ruta',
            'acciones' => 'Acciones',
            'nombre_carpeta' => 'Nombre Carpeta',
            'fecha_archivo' => 'Fecha Archivo',
            'tipo_tramite' => 'Tipo Tramite',
            'observaciones' => 'Observaciones',
            'terminado' => 'Terminado',
            'gestion' => 'Gestion',
            'fecha_registro' => 'Fecha Registro',
            'hora_registro' => 'Hora Registro',
            'fk_usuario' => 'Fk Usuario',
            'fk_seguimiento' => 'Fk Seguimiento',
            'fk_regional' => 'Fk Regional',
            'activo' => 'Activo',
            'oficial' => 'Oficial',
            'fk_area' => 'Fk Area',
        ];
    }
    
    public static function getListGestion()
    {
                
        $usuario=Yii::$app->user->identity->id_usuario;        
        
        $sql="	SELECT DISTINCT(gestion) FROM archivo WHERE activo=1";		
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        $listData = ArrayHelper::map($result, 'gestion', 'gestion');
        return $listData;
    }
    
    public static function getListCarpeta()
    {
                
        $usuario=Yii::$app->user->identity->id_usuario;        
        
        $sql="	SELECT id_carpeta_archivo, nombre_carpeta FROM carpetaarchivo WHERE activo=1 AND fk_usuario=$usuario";		
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        $listData = ArrayHelper::map($result, 'nombre_carpeta', 'nombre_carpeta');
        return $listData;
    }
    
    public static function getListCarpetaform()
    {
                
        $usuario=Yii::$app->user->identity->id_usuario;        
        
        $sql="	SELECT id_carpeta_archivo, nombre_carpeta FROM carpetaarchivo WHERE activo=1 AND fk_usuario=$usuario";		
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        $listData = ArrayHelper::map($result, 'id_carpeta_archivo', 'nombre_carpeta');
        return $listData;
    }
    
    public function getNameArea($id){

        $model = Areas::findOne($id);
	return $model->area;
    }
    
    public function getNameRegional($id){

        $model = Regionales::findOne($id);
	return $model->regional;
    }
    
    public function getListCITEs($nuri){

        $connection= Yii::$app->db;
		//$usuario=Yii::app()->user->id_usuario;
        $command=$connection->createCommand("SELECT * FROM hojas_ruta WHERE nur='$nuri' AND activo=1");
        $dataReader=$command->query();
        return $dataReader;

    }
    
    public function getListcarpetas(){

        $inicio=date('Y-01-01');
        $fin=date('Y-12-31');
        
	$usuario=Yii::$app->user->identity->id_usuario;
        //$command=Yii::$app->db->createCommand("SELECT c.*,  FROM carpetaarchivo c WHERE  c.activo=1 AND c.fk_usuario=$usuario ORDER BY c.id_carpeta_archivo DESC");
        $command=Yii::$app->db->createCommand("SELECT c.*, EXTRACT(YEAR FROM fecha_registro) gestion FROM carpetaarchivo c WHERE  c.activo=1 AND c.fk_usuario=$usuario ORDER BY c.id_carpeta_archivo DESC");
        $dataReader=$command->query();
        return $dataReader;

        //fecha_registro BETWEEN '$inicio' AND '$fin' AND

    }

    
    /*
    public static function getListGestion()
    {
        
        $sql="	SELECT DISTINCT gestion FROM archivo WHERE activo=1";		
        //$result = Listaderivacion::findBySql($sql)->all();
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        //$listData = ArrayHelper::map($result, 'id_usuario_destino', 'nombre_destinatario');
        $listData = ArrayHelper::map($result, 'gestion', 'gestion');
        return $listData;
    }*/
    
    
    
}// END CLASS
