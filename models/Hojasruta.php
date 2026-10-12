<?php

namespace app\models;

use Yii;
use app\models\Documentos;
use app\models\Seguimientos;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "hojas_ruta".
 *
 * @property int $id_hoja_ruta
 * @property string $nur
 * @property string $codigo
 * @property int $nro
 * @property string $fecha
 * @property string $hora
 * @property int $proceso se cambiara a 3 en caso de nuris desvinculados y se mantendra  con activo=1 y nro=0
 * @property string $fecha_registro
 * @property string $hora_registro
 * @property int $fk_usuario
 * @property int $gestion
 * @property int $activo
 * @property int|null $fk_documento
 * @property int|null $oficial
 *
 * @property Usuarios $fkUsuario
 */
class Hojasruta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hojas_ruta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nur', 'codigo', 'nro', 'fecha', 'hora', 'proceso', 'fecha_registro', 'hora_registro', 'fk_usuario', 'gestion'], 'required'],
            [['nro', 'proceso', 'fk_usuario', 'gestion', 'activo', 'fk_documento', 'oficial'], 'default', 'value' => null],
            [['nro', 'proceso', 'fk_usuario', 'gestion', 'activo', 'fk_documento', 'oficial'], 'integer'],
            [['fecha', 'hora', 'fecha_registro', 'hora_registro'], 'safe'],
            [['nur'], 'string', 'max' => 100],
            [['codigo'], 'string', 'max' => 500],
            [['fk_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['fk_usuario' => 'id_usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_hoja_ruta' => 'Id Hoja Ruta',
            'nur' => 'NUR/NURI',
            'codigo' => 'CITE',
            'nro' => 'Nro',
            'fecha' => 'Fecha',
            'hora' => 'Hora',
            'proceso' => 'Proceso',
            'fecha_registro' => 'Fecha Registro',
            'hora_registro' => 'Hora Registro',
            'fk_usuario' => 'Fk Usuario',
            'gestion' => 'Gestion',
            'activo' => 'Activo',
            'fk_documento' => 'Fk Documento',
            'oficial' => 'Oficial',
        ];
    }

    /**
     * Gets query for [[FkUsuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'fk_usuario']);
    }
    
    /*public function getDocumentos()
    {
        return $this->hasOne(Documentos::className(), ['id_documento' => 'fk_documento']);
    }*/
    
    public function getDocumentos($id){

        $model = Documentos::findOne($id);
	return $model;
    }
    
    public static function getListNuriPendiente()
    {
        $usuario=Yii::$app->user->identity->id_usuario;        
                
        /*$sql = "SELECT *
                 FROM seguimientos s
                 WHERE s.derivado_a=$usuario AND s.activo=1 AND s.confirmado=1 AND s.fk_estado in (1,2)";*/
        $sql = "SELECT * FROM lista_nuris_pendientes('$usuario')";
        
        //$result = Listaderivacion::findBySql($sql)->all();
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        //$listData = ArrayHelper::map($result, 'id_usuario_destino', 'nombre_destinatario');
        $listData = ArrayHelper::map($result, 'id_seguimiento','codigo_completo');
        return $listData;
    }
    
    public function getListNuriCreado(){

	$usuario=Yii::$app->user->identity->id_usuario;        

	$sql = "SELECT * FROM lista_nuris_creados('$usuario')";
  	$result = Yii::$app->db->createCommand($sql)->queryAll();

        return ArrayHelper::map($result,'nur','nur');
    }
    
    public static function getGestion(){

	$usuario=Yii::$app->user->identity->id_usuario;        

	$sql = "SELECT DISTINCT gestion FROM hojas_ruta";
  	$result = Yii::$app->db->createCommand($sql)->queryAll();

        return ArrayHelper::map($result,'gestion','gestion');
    }
    
    
    public static function countSeguimiento($nuri){

        $count = Seguimientos::find()->where([
                                    'codigo'=> $nuri,
                                    'activo'=>1 ])->count();        

        return $count;


    } // fin function


    public static function mostrarCITE($nuri){

        $count = Hojasruta::find()->where([
                                    'nur'=> $nuri,
                                    'nro'=> 0,
                                    'activo'=>1 ])->count();        

        if($count==1){
            
            $row=Yii::$app->db->createCommand("SELECT codigo FROM hojas_ruta WHERE nur='$nuri' AND activo=1  AND nro=0 ")->query()->read();
            return $row['codigo'];
        }
        else{
            
            $row=Yii::$app->db->createCommand("SELECT codigo FROM hojas_ruta WHERE nur='$nuri' AND activo=1  AND nro=0 ORDER BY id_hoja_ruta ASC LIMIT 1 ")->query()->read();
            $row2=Yii::$app->db->createCommand("SELECT codigo FROM hojas_ruta WHERE nur='$nuri' AND activo=1  AND nro=0 ORDER BY id_hoja_ruta DESC LIMIT 1 ")->query()->read();
            //return "<ul><li>".$row['codigo']."</li> <li>".$row2['codigo']."</li></ul>";
            return "<b>&#187;</b> ".$row['codigo']."<br><b>&#187; ".$row2['codigo']."</b>";
        }

    } // fin function


    public function verificarArchivo($id_documento){
       
       $usuario=Yii::$app->user->identity->id_usuario;
       $row=Yii::$app->db->createCommand("SELECT * 
                                          FROM hojas_ruta  
                                          WHERE fk_documento=$id_documento
        ")->query()->read();

       $oficial=$row['oficial'];
       $nuri=$row['nur'];


       $count = Archivo::find()->where([
                    'nuri'=> $nuri,
                    'oficial'=> $oficial,
                    'activo'=>1 ])->count();

       if($count>0){
            return 1;
       }
       else{
            return 0;
       }


    }

    //PARA REPORTES AÑADIDO
    public function getDocumento()
    {
        return $this->hasOne(Documentos::class, ['id_documento' => 'fk_documento']);
    }

    public function getSeguimiento()
    {
        return $this->hasOne(Seguimientos::class, ['codigo' => 'nur']);
    }
    //FIN PARA REPORTES AÑADIDO    
    
} // FIN CLASS
