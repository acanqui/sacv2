<?php

namespace app\models;
use app\models\Hojasruta;
use app\models\Usuarios;
use app\models\Areas;
use app\models\Agrupaciones;
use yii\helpers\ArrayHelper;
use kartik\growl\Growl;
use yii\helpers\Html;
use Yii;

use yii\data\SqlDataProvider;

/**
 * This is the model class for table "seguimientos".
 *
 * @property int $id_seguimiento
 * @property string $codigo
 * @property int $derivado_por
 * @property int $derivado_a
 * @property string $proveido
 * @property string $fecha_derivacion
 * @property string $hora_derivacion
 * @property string $fecha_recepcion
 * @property string $hora_recepcion
 * @property int $fk_accion
 * @property int $fk_estado
 * @property int $padre
 * @property int $oficial
 * @property string|null $hijo
 * @property string $fecha_registro
 * @property string $hora_registro
 * @property int $gestion
 * @property int $confirmado
 * @property int $activo
 * @property int|null $fk_grupo_derivacion
 * @property int|null $fk_principal_agrupacion
 * @property string|null $numero_copia
 * @property int|null $observado
 * @property string|null $accion_archivo
 * @property int|null $correlativo_copia
 *
 * @property Agrupaciones[] $agrupaciones
 * @property ArchivadosDigitales[] $archivadosDigitales
 * @property Acciones $fkAccion
 * @property Estados $fkEstado
 * @property Usuarios $derivadoPor
 * @property Usuarios $derivadoA
 */
class Seguimientos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seguimientos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            
            ['derivado_a','required','message'=>'El Nombre de Destino no puede quedar vacío '],
            ['proveido','required','message'=>'El Proveído no puede quedar vacío '],
            ['fk_accion','required','message'=>'La Acción/Tipo Proceso no puede quedar vacío '],
            ['oficial','required','message'=>'El Tipo de trámite no puede quedar vacío '],
            
            [['codigo', 'derivado_por', 'derivado_a', 'proveido', 'fecha_derivacion', 'hora_derivacion', 'fecha_recepcion', 'hora_recepcion', 'fk_accion', 'fk_estado', 'padre', 'oficial', 'fecha_registro', 'hora_registro', 'gestion'], 'required'],
            [['derivado_por', 'derivado_a', 'fk_accion', 'fk_estado', 'padre', 'oficial', 'gestion', 'confirmado', 'activo', 'fk_grupo_derivacion', 'fk_principal_agrupacion', 'observado', 'correlativo_copia'], 'default', 'value' => null],
            [['derivado_por', 'derivado_a', 'fk_accion', 'fk_estado', 'padre', 'oficial', 'gestion', 'confirmado', 'activo', 'fk_grupo_derivacion', 'fk_principal_agrupacion', 'observado', 'correlativo_copia'], 'integer'],
            [['proveido', 'accion_archivo'], 'string'],
            [['fecha_derivacion', 'hora_derivacion', 'fecha_recepcion', 'hora_recepcion', 'fecha_registro', 'hora_registro'], 'safe'],
            [['codigo', 'hijo'], 'string', 'max' => 45],
            [['numero_copia'], 'string', 'max' => 32],
            [['fk_accion'], 'exist', 'skipOnError' => true, 'targetClass' => Acciones::className(), 'targetAttribute' => ['fk_accion' => 'id_accion']],
            [['fk_estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['fk_estado' => 'id_estado']],
            [['derivado_por'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['derivado_por' => 'id_usuario']],
            [['derivado_a'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['derivado_a' => 'id_usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_seguimiento' => '',
            'codigo' => 'Codigo',
            'derivado_por' => 'Derivado Por',
            'derivado_a' => 'Derivado A',
            'proveido' => 'Proveido',
            'fecha_derivacion' => 'Fecha Derivacion',
            'hora_derivacion' => 'Hora Derivacion',
            'fecha_recepcion' => 'Fecha Recepcion',
            'hora_recepcion' => 'Hora Recepcion',
            'fk_accion' => 'Acción/Tipo Proceso',
            'fk_estado' => 'Fk Estado',
            'padre' => 'Padre',
            'oficial' => 'Oficial',
            'hijo' => 'Hijo',
            'fecha_registro' => 'Fecha Registro',
            'hora_registro' => 'Hora Registro',
            'gestion' => 'Gestion',
            'confirmado' => 'Confirmado',
            'activo' => 'Activo',
            'fk_grupo_derivacion' => 'Fk Grupo Derivacion',
            'fk_principal_agrupacion' => 'Fk Principal Agrupacion',
            'numero_copia' => 'Numero Copia',
            'observado' => 'Observado',
            'accion_archivo' => 'Accion Archivo',
            'correlativo_copia' => 'Correlativo Copia',
        ];
    }

    /**
     * Gets query for [[Agrupaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAgrupaciones()
    {
        return $this->hasMany(Agrupaciones::className(), ['fk_seguimiento_padre' => 'id_seguimiento']);
    }

    /**
     * Gets query for [[ArchivadosDigitales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArchivadosDigitales()
    {
        return $this->hasMany(ArchivadosDigitales::className(), ['fk_seguimiento' => 'id_seguimiento']);
    }

    /**
     * Gets query for [[FkAccion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkAccion()
    {
        return $this->hasOne(Acciones::className(), ['id_accion' => 'fk_accion']);
    }

    /**
     * Gets query for [[FkEstado]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkEstado()
    {
        return $this->hasOne(Estados::className(), ['id_estado' => 'fk_estado']);
    }

    /**
     * Gets query for [[DerivadoPor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDerivadoPor()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'derivado_por']);
    }

    /**
     * Gets query for [[DerivadoA]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDerivadoA()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'derivado_a']);
    }
    
    //##########################################################
    // CODIGO AÑADIDO 
    public function countQueDebenLlegar($oficial,$id_usuario){

        return Seguimientos::find()->where(['derivado_a'=>$id_usuario,
            'oficial'=>$oficial,
            'activo'=>1,
            'confirmado'=>1,
            'fk_estado'=>3, ])->count();
    }
    
    
    public static function countTramitesarchivados(){

        return Archivo::find()->where(['fk_area'=>Yii::$app->user->identity->fk_area,
            'activo'=>1,
            'gestion'=>date('Y'),
             ])->count();
    }
    
    public static function countTramitesSinConfirmar($id_usuario){

        return Seguimientos::find()->where(['derivado_por'=>$id_usuario,
            'activo'=>1,
            'confirmado'=>0,
            'fk_estado'=>3, ])->count();
    }
    
    public function countTramitesSinRecibir($id_usuario){

        return Seguimientos::find()->where(['derivado_por'=>$id_usuario,
            'activo'=>1,
            'confirmado'=>1,
            'fk_estado'=>3, ])->count();
    }
    
    public function vertificarAgrupado($nuri, $id_seguimiento){

        /*return Agrupaciones::find()->where(['nur_hijo'=>$nuri,
            'activo'=>1,
             ])->count();*/

        //return Agrupaciones::find()->where(['nur_hijo'=>$nuri])->andWhere(['activo'=>1])->andWhere(['<>','fk_seguimiento_hijo', $id_seguimiento])->count();
        return Agrupaciones::find()->where(['nur_hijo'=>$nuri])->andWhere(['activo'=>1])->andWhere(['fk_seguimiento_hijo'=>$id_seguimiento])->count();
    }
    
    
    
    public static function getMostrarCodigo($oficial, $codigo, $numero_copia){

		if ($oficial==1) { 
		       $result="<center>
				<i  class='fa fa-thumbs-o-up' style='font-size: 20px; color:#222D32;'></i>&nbsp;&nbsp;&nbsp; <i>Original</i><br>
				<b>".$codigo."</b>
				</center>";
		}
		else{
		      $result=" <center>
				<i>Copia</i><br>
				<b>".$codigo."</b><br>
                                <span style='font-size:8.5pt;'>Copia ".$numero_copia."</span>
				</center>";
		
		}

		return $result;
    }
    
    public static function getVerNuriAgrupado($nuri){

	$count=Agrupaciones::find()->where(['nur_padre'=>$nuri,
            'activo'=>1,
         ])->count();
        
        if($count>0){
            return "<center><div style='font-size: 8.5pt; color:#D4480A; line-height :8pt;'>Trámite agrupado</div></center>";
        }
        else{
            return "";
        }

		
    }
    
    public static function getUsuarioPendientes($id){
        
       // $connection= Yii::$app->db;
            
		//$usuarios=Usuarios::model()->findByPk($id);
                $usuarios = Usuarios::findOne($id);
                $row=Yii::$app->db->createCommand("select 
                          (CASE
                            WHEN u.fk_nivel=1 THEN
                                COALESCE(NULLIF((select concat(a.nombre) from alias a where a.fk_usuario=u.id_usuario AND a.activo=1 order by id_alias desc limit 1),''),'S/N')
                            WHEN u.fk_nivel=3 THEN
                                COALESCE(NULLIF((select concat(a.nombre) from alias a where a.fk_usuario=u.id_usuario AND a.activo=1 order by id_alias desc limit 1),''),'S/N')    
                            ELSE
                                (u.nombre) 
                            END) nombre_funcionario,
                            u.cargo
                        FROM usuarios u 
                        WHERE u.id_usuario=$usuarios->id_usuario ")->query()->read();

		return $row['nombre_funcionario']."<br><i style='font-size:11px; color:#0B2F3A;'><b>".$row['cargo']."</b></i>";
		//return $row['nombre_funcionario']." <br> ".$row['cargo']."<br><i style='font-size:11px; color:#0B2F3A;'><b>".$usuarios->fkArea->area."</b></i>";
    }
    
    public static function getUsuarioArea($id){
        
        $usuarios = Usuarios::findOne($id);
        return "<i style='font-size:11px; color:#0B2F3A;'><b>".$usuarios->fkArea->area."</b></i>";
    }
    
    public static function getReferenciaSintesis($nuri,$proveido){

		//$connection_mysql= Yii::app()->dbmysql;
		$connection_postgres= Yii::$app->db;

			$row_post=$connection_postgres->createCommand("SELECT d.referencia, d.contenido, d.fk_tipo_documento
									FROM hojas_ruta h, documentos d
									WHERE h.nur='$nuri' AND h.nro=0 AND h.activo=1 AND h.fk_documento=d.id_documento
									ORDER BY h.fecha ASC
								")->query()->read();
			// VER TEMPORALMENTE QUE REGISTR FALLA:
        		/*if ($row_post === false) {
		            throw new \yii\web\HttpException(500, "El error lo causa el codigo/nur: " . $nuri . " " . $proveido);
        		}*/

			// pasar condicion:
		        //$referencia = isset($row_post['referencia']) ? $row_post['referencia'] : 'No tiene';
	
			$referencia=$row_post['referencia'];
			
                    $result="<table width='100%' align='center' cellpadding='0' cellspacing='0'>
				<tr style='background:transparent;'>
					<td width='15%' style='font-size:8.2pt;'><b>Referencia: </b></td>
                                        <td style='font-size:8.5pt; border-bottom:1px solid #D5D7DC;'>".$referencia."</td>
				</tr>
				<tr style='background:transparent;'>
					<td width='15%' style='font-size:8.2pt;'><b>Prove&iacute;do: </b></td>
                                        <td style='font-size:8.5pt; border-bottom:1px solid #D5D7DC;'>".$proveido."</td>
				</tr>
                            </table> ";    
			
                        $sintesis=$row_post['contenido'];
			//$sintesis = isset($row_post['contenico']) ? $row_post['contenido'] : 'No tiene contenido';

			$sintesis = str_replace("&NBSP;", "", $sintesis);
                                
			if ($row_post['fk_tipo_documento']==7 && trim($sintesis)!="") {
				
                                
                            
                            $result2="<table width='100%' align='center' cellpadding='0' cellspacing='0'>    
                                    <tr style='background:transparent'>
                                    <td width='15%' style='font-size:8.2pt;'><b>Sintesis: </b></td>
                                    <td style='font-size:8.5pt;'>
                                                    ".trim($sintesis)."
                                    </td>
                                    </tr>
                                </table>  ";  
				
                        }else{
                            $result2="";
                        }

		
            return $result." ".$result2;

	}// fin function
        
    public static function countNuriHojasRuta($nuri){

        $connection= Yii::$app->db;
        
        $count = Hojasruta::find()->where(['nur'=>$nuri,
		            'nro'=>0,
		            'proceso'=>4,
		            'oficial'=>1,
		            'activo'=>1, ])->count();
      
        return $count;


    } // fin function
    
    public static function getCabeceraSeguimiento($nuri){

        $connection= Yii::$app->db;
	 	$row=$connection->createCommand("SELECT *
			 				   FROM cabecera_seguimiento('$nuri')")->query()->read();

	return $row;

    }
    
    
    public static function getNurisAsociados($nuri){

	$connection= Yii::$app->db;
		//$usuario=Yii::app()->user->id_usuario;
        $command=$connection->createCommand("SELECT h.id_hoja_ruta, h.codigo, d.id_documento, d.codigo as cite, d.fk_tipo_documento
			   FROM hojas_ruta h, documentos d
			   WHERE h.nur='$nuri'
			   AND h.activo=1
			   AND h.nro=0
			   AND h.fk_documento=d.id_documento
			   ");
        $dataReader=$command->query();
        return $dataReader;
    }
    
    public static function listaCartaExterna($nuri){

	$connection= Yii::$app->db;
		//$usuario=Yii::app()->user->id_usuario;
        $command=$connection->createCommand("SELECT *
			   FROM lista_carta_externa('$nuri')");
        $dataReader=$command->query();

        return $dataReader;

    }
    
    public static function getListAgrupacion($nuri){

        $command=Yii::$app->db->createCommand("SELECT * FROM agrupaciones WHERE nur_padre='$nuri' AND activo=1");
        $dataReader=$command->query();

        return $dataReader;

    }
    
   
    
    public static function countNuriSecundarioAgrupacion($nuri){

        $connection= Yii::$app->db;

	/*$count = Agrupaciones::model()->countByAttributes(array(
            'nur_hijo'=>$nuri,
            'activo'=>1,
        ));*/
                
        $count = Agrupaciones::find()->where([
                                    'nur_hijo'=>$nuri,
                                    'activo'=>1, ])->count();        

        return $count;


    } // fin function
    
    
    public static function getValueOriginalCopia($nuri, $oficial){

        $count = Seguimientos::find()->where([
                                    'codigo'=>$nuri,
                                    'activo'=>1, 
                                    'confirmado'=>0, 
                                    'fk_estado'=>3, 
        ])->count();
        
         $countoficial = Seguimientos::find()->where([
                                    'codigo'=>$nuri,
                                    'activo'=>1, 
                                    'oficial'=>1, 
                                    'confirmado'=>0, 
                                    'fk_estado'=>3, 
        ])->count();
        
        if($oficial==1){
            
            if($count>=1 && $countoficial==1){ $valor=0;   }
            else{  $valor=1;           }
        }
    else{
            $valor=0;    
        }

        return $valor;
        
    } // fin function
    
    public static function geStateOriginalCopia($nuri, $oficial){

        $count = Seguimientos::find()->where([
                                    'codigo'=>$nuri,
                                    'activo'=>1, 
                                    'confirmado'=>0, 
                                    'fk_estado'=>3, 
        ])->count();
       
        $countoficial = Seguimientos::find()->where([
                                    'codigo'=>$nuri,
                                    'activo'=>1, 
                                    'oficial'=>1, 
                                    'confirmado'=>0, 
                                    'fk_estado'=>3, 
        ])->count();
        
        
        if($oficial==1){
            
            if($count>=1 && $countoficial==1){ $estado=true;   }
            else{  $estado=false;           }
        }
    else{
            if($oficial==0){
                $estado=true;
            }
            else{
                $estado=false;    
            }    
        }

        return $estado;
    } // fin function
    
    
    public static function getDerivarDocumentoOriginalCopia($nuri){

        $count = Seguimientos::find()->where([
                                    'codigo'=>$nuri,
                                    'activo'=>1, 
                                    'confirmado'=>0, 
                                    'fk_estado'=>3, 
        ])->count();
        
         $countoficial = Seguimientos::find()->where([
                                    'codigo'=>$nuri,
                                    'activo'=>1, 
                                    'oficial'=>1, 
                                    'confirmado'=>0, 
                                    'fk_estado'=>3, 
        ])->count();
         
        if($count>0){
             
             if($countoficial==1){$valor=0; } else{$valor=1; } 
             //if($countcopia==1){ $valor=0;   }
         }else{
             $valor=1;
         }
        
        return $valor;
    } // fin function
    
    
    
    
    public static function geStateDerivarDocumentoOriginalCopia($nuri){

        $countoficial = Seguimientos::find()->where([
                                    'codigo'=>$nuri,
                                    'activo'=>1, 
                                    'oficial'=>1, 
                                    'confirmado'=>0, 
                                    'fk_estado'=>3, 
        ])->count();
        
        if($countoficial==1){
            $estado=true;
        }
        else{
            $estado=false;
        }

        return $estado;
    } // fin function
    
    
    public static function countDerivarSinConfirmar($nuri){

        $count = Seguimientos::find()->where([
                                    'codigo'=>$nuri,
                                    'activo'=>1, 
                                    'confirmado'=>0, 
                                    'fk_estado'=>3, 
        ])->count();

        return $count;
    } // fin function
    
    
    public static function countCopiaNuri($oficial, $nuri){
        
        if($oficial==0){
            $count = Seguimientos::find()->where([
                                    'codigo'=>$nuri,
                                    'activo'=>1, 
                                    'oficial'=>0,
                                    'derivado_por'=>Yii::$app->user->identity->id_usuario,    
                                    'confirmado'=>0, 
                                    'fk_estado'=>3, 
            ])->count();
            
            if($count>0){
                $result=true;
            }
            else{
                $result=false;
            }
        }
        else{
            $result=false;
        }

        

        return $result;
    } // fin function
    
    
    
    public static function countNuriPrincipal($nuri){

        $connection= Yii::$app->db;

	/* $count = Agrupaciones::model()->countByAttributes(array(
            'nur_padre'=>$nuri,
            'activo'=>1,
            //'oficial'=>1
        ));*/
        
        $count = Agrupaciones::find()->where([
                                    'nur_padre'=>$nuri,
                                    'activo'=>1, ])->count(); 

        return $count;


    } // fin function
    
    public static function getSearchNuri($nuri,$oficial){

	$connection= Yii::$app->db;

        $command=$connection->createCommand("SELECT * FROM busqueda_nuri('$nuri','$oficial')");
        $dataReader=$command->query();

        return $dataReader;

    }
    
    public static function countSeguimientoHojaRuta($id_seguimiento){

        /*$connection= Yii::$app->db;

		$count = HojasRuta::model()->countByAttributes(array(
            'nro'=> $id_seguimiento,
            'activo'=>1
        ));*/
                
        $count = HojasRuta::find()->where([
                                    'nro'=> $id_seguimiento,
                                    'activo'=>1 ])->count();        

        return $count;


    } // fin function
    
    public static function getCiteHojaRuta($id_seguimiento){

		$connection= Yii::$app->db;
		$command=$connection->createCommand("SELECT *
			   FROM hojas_ruta
				WHERE nro=$id_seguimiento
				AND activo=1
			   ");
	        $dataReader=$command->query();

	        return $dataReader;
    }
    
    public static function getNuriPrincipal($nuri){

		$connection= Yii::$app->db;


	    $row=$connection->createCommand("SELECT *
			   FROM agrupaciones
				WHERE nur_hijo='$nuri'
				AND activo=1
		")->query()->read();

       return $row['nur_padre'];

    }
    public static function listaAgrupacion($nuri){
        
                

	$connection= Yii::$app->db;
	$command=$connection->createCommand("SELECT a.*, 
            
                                    (CASE
					WHEN a.oficial=1 THEN
                                          '' 
					ELSE
                                          COALESCE(NULLIF((select s.numero_copia from seguimientos s where s.id_seguimiento=a.fk_seguimiento_hijo and s.activo=1),''),'S/N')
                                    END) copia,
                                    
                                    (CASE
					WHEN a.oficial=1 THEN
                                            'Original'
					ELSE
                                            'Copia'
                                    END) estado_tramite
                                    
			   FROM agrupaciones a
				WHERE a.nur_padre='$nuri'
				AND a.activo=1
			   ");
	        $dataReader=$command->query();

	        return $dataReader;

    }
    
    public static function getObtenerNuri($id_documento){
        
         
        $count = Hojasruta::find()->where([
            'fk_documento'=>$id_documento,
            'activo'=>1, ])->count();        
        
        if($count>0){
	    $connection= Yii::$app->db;
	    $row=$connection->createCommand("SELECT *
			   FROM hojas_ruta
				WHERE fk_documento=$id_documento
				AND activo=1
		")->query()->read();

            return $row['nur'];
        }
        else{
            return "";
        }

    }
    
    public static function countIdSeguimiento($id_seguimiento){
       /* $connection= Yii::app()->db;

		$count = Seguimientos::model()->countByAttributes(array(
            'id_seguimiento'=>$id_seguimiento,
            'activo'=>1,
        ));*/
        
        $count = Seguimientos::find()->where([
            'id_seguimiento'=>$id_seguimiento,
            'activo'=>1, ])->count();        

        return $count;
    } // fin function
    
    public static function returnIdArchivo($id_seguimiento){

		$connection= Yii::$app->db;


	    $row=$connection->createCommand("
	    	SELECT * 
        	FROM archivo
        	WHERE fk_seguimiento=$id_seguimiento AND activo=1 ORDER BY id_archivo DESC LIMIT 1
		")->query()->read();

       return $row;
    }
    
    public static function countPendientes($oficial,$estado,$id_usuario){

	/*$count = Seguimientos::model()->countByAttributes(array(
            'derivado_a'=>$id_usuario,
            'oficial'=>$oficial,
            'activo'=>1,
            'confirmado'=>1,
            'fk_estado'=>$estado,
        )); */
        
         $count = Seguimientos::find()->where([
            'derivado_a'=>$id_usuario,
            'oficial'=>$oficial,
            'activo'=>1,
            'confirmado'=>1,
            'fk_estado'=>$estado, ])->count();
         
         
        return $count;
    }
    
    public static function getListCitesAsignados($nuri){

	$connection= Yii::$app->db;

        $command=$connection->createCommand("
        	SELECT *
        	FROM hojas_ruta
        	WHERE nur='$nuri' and nro=0 AND activo=1
        ");
        $dataReader=$command->query();

        return $dataReader;

    }
    
    public static function getListCitesAsignadosPendiente($nuri){

	$connection= Yii::$app->db;

        $command=$connection->createCommand("
        	SELECT h.nur, d.codigo cite, char_length(trim(contenido)) num_contenido
        	FROM hojas_ruta h, documentos d
        	WHERE h.nur='$nuri' AND h.fk_documento=d.id_documento AND h.activo=1 AND d.activo=1
        	AND d.fk_tipo_documento NOT IN (6,7)
        ");
        
        /*
         $command=$connection->createCommand("
        	SELECT h.nur, d.codigo cite, char_length(trim(contenido)) num_contenido
        	FROM hojas_ruta h, documentos d
        	WHERE h.nro='$nro' AND h.fk_documento=d.id_documento AND h.activo=1 AND d.activo=1
        	AND d.fk_tipo_documento NOT IN (6,7)
        ");
         */
        
        $dataReader=$command->query();
        //  AND d.fk_area
        return $dataReader;

    }
    
    public static function countCharCites($nuri){

	$connection= Yii::$app->db;


	$row=$connection->createCommand("
	    	SELECT 
					(SELECT count (*)
						FROM hojas_ruta h, documentos d
						WHERE h.nur='$nuri' AND h.fk_documento=d.id_documento AND h.activo=1 AND d.activo=1
						AND d.fk_tipo_documento NOT IN (6,7) AND char_length(trim(contenido))<301) as total_menor,
						
					(SELECT count (*) 
						FROM hojas_ruta h, documentos d
						WHERE h.nur='$nuri' AND h.fk_documento=d.id_documento AND h.activo=1 AND d.activo=1
						AND d.fk_tipo_documento NOT IN (6,7) AND char_length(trim(contenido))>301) as total_mayor 
                    
		")->query()->read();

       return $row;

    }
    
    
    public static function countDocumentosAsociados($id_seguimiento){

	$connection= Yii::$app->db;

        $row=$connection->createCommand("
	    	SELECT count (id_hoja_ruta) total_documentos
        	FROM hojas_ruta h
        	WHERE h.nro=$id_seguimiento AND h.activo=1
		")->query()->read();

       return $row['total_documentos'];

    }
    
    public static function getListSeguimiento($nur){

	$connection= Yii::$app->db;

        $command=$connection->createCommand("
        	SELECT id_seguimiento, codigo , padre
        	FROM seguimientos
        	WHERE codigo='$nur' and activo=1 ORDER BY id_seguimiento DESC
        ");
        $dataReader=$command->query();

        return $dataReader;

    }
    
    
    public static function getListDestino()
    {
        /*$usuario=Yii::app()->user->id_usuario;
	$sql2="	SELECT * FROM lista_derivacion($usuario)";		
	$result = Yii::app()->db->createCommand($sql2)->queryAll();

	return CHtml::listData($result,'id_usuario_destino','nombre_destino','nombre_area');*/
                
        $usuario=Yii::$app->user->identity->id_usuario;        
                
        $sql1 = "SELECT l.usuario_destino,
                COALESCE(NULLIF((select 

                                    (CASE
					WHEN u.fk_nivel=1 THEN
                                            COALESCE(NULLIF((select concat(a.nombre,' - ',a.cargo) from alias a where a.fk_usuario=u.id_usuario AND a.activo=1 order by id_alias desc limit 1),''),'S/N')
                                        WHEN u.fk_nivel=3 THEN
                                            COALESCE(NULLIF((select concat(a.nombre,' - ',a.cargo) from alias a where a.fk_usuario=u.id_usuario AND a.activo=1 order by id_alias desc limit 1),''),'S/N')    
					ELSE
                                            (u.nombre || ' - ' || u.cargo) 
                                    END) 


                                 from usuarios u 
                                 where u.id_usuario=l.usuario_destino and u.activo=1),''),'S/N') as user_destino 
                                 
                FROM lista_derivacion l
                WHERE l.usuario_origen=$usuario AND l.activo=1 ";
    
        
        
        $sql2="	SELECT * FROM lista_derivacion($usuario)";		
        //$result = Listaderivacion::findBySql($sql)->all();
        $result = Yii::$app->db->createCommand($sql1)->queryAll();
        //$listData = ArrayHelper::map($result, 'id_usuario_destino', 'nombre_destinatario');
        $listData = ArrayHelper::map($result, 'usuario_destino', 'user_destino');
        return $listData;
    }
    
    
    
    public static function getListRemitente()
    {
        /*$usuario=Yii::app()->user->id_usuario;
	$sql2="	SELECT * FROM lista_derivacion($usuario)";		
	$result = Yii::app()->db->createCommand($sql2)->queryAll();

	return CHtml::listData($result,'id_usuario_destino','nombre_destino','nombre_area');*/
                
        $usuario=Yii::$app->user->identity->id_usuario;        
                
        $sql1 = "select 

                                    (CASE
					WHEN u.fk_nivel=1 THEN
                                            COALESCE(NULLIF((select concat(a.nombre,' - ',a.cargo) from alias a where a.fk_usuario=u.id_usuario AND a.activo=1 order by id_alias desc limit 1),''),'S/N')
                                        WHEN u.fk_nivel=3 THEN
                                            COALESCE(NULLIF((select concat(a.nombre,' - ',a.cargo) from alias a where a.fk_usuario=u.id_usuario AND a.activo=1 order by id_alias desc limit 1),''),'S/N')    
					ELSE
                                            (u.nombre || ' - ' || u.cargo) 
                                    END) nombre_cargo


                                 from usuarios u 
                                 where u.id_usuario=(SELECT DISTINCT derivado_por FROM seguimientos WHERE activo=1) and u.activo=1 
                ";
        
        $result = Yii::$app->db->createCommand($sql1)->queryAll();
        $listData = ArrayHelper::map($result, 'id_usuario', 'nombre_cargo');
        return $listData;
    }
    
    public static function getListGrupo()
    {
                
        $usuario=Yii::$app->user->identity->id_usuario;        
        
        $sql="	SELECT * FROM grupo_derivacion WHERE fk_usuario=$usuario";		
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        $listData = ArrayHelper::map($result, 'id_grupo_derivacion', 'nombre_grupo');
        return $listData;
    }
    
    
    
    public function getListaNurisAgrupados($id_seguimiento){

	$connection= Yii::$app->db;

	//$usuario=Yii::app()->user->id_usuario;
	$usuario=Yii::$app->user->identity->id_usuario;

        $command=$connection->createCommand("SELECT * FROM lista_nuris_agrupados($usuario,$id_seguimiento)");
        $dataReader=$command->query();

        return $dataReader;

    }
    public function getListaNurisAgrupadosCompleto($nuri){

	$connection= Yii::$app->db;

	//$usuario=Yii::app()->user->id_usuario;
	$usuario=Yii::$app->user->identity->id_usuario;


        $command=$connection->createCommand("SELECT *
			   FROM lista_nuris_agrupados_completo('$nuri')");
        $dataReader=$command->query();

        return $dataReader;

    }
    
    public function getUsuario($id){

        $model = Usuarios::findOne($id);
	return $model->nombre;
    }
    
    public function getAnadirRespuesta($id_seguimiento){

	$connection= Yii::$app->db;

        $command=$connection->createCommand("
        	SELECT *
        	FROM hojas_ruta h, documentos d
        	WHERE h.nro=$id_seguimiento AND h.activo=1
        	AND h.fk_documento=d.id_documento
        ");
        $dataReader=$command->query();

        return $dataReader;

    }
    public static function countExistResponseNURI($id_seguimiento, $tipo_documento){
               
      $row=Yii::$app->db->createCommand("
	    	SELECT count (*) total
        	FROM hojas_ruta h, documentos d
        	WHERE h.nro=$id_seguimiento 
                    AND h.activo=1 
                    AND d.activo=1 
                    AND h.fk_documento=d.id_documento
                    AND d.fk_tipo_documento=$tipo_documento
		")->query()->read();

       return $row['total'];
        
        
    } // fin function
    
    public function countDerivados($nuri, $id_seguimiento){
        
        $count = Seguimientos::find()->where([
           'codigo'=>$nuri,
            'padre'=>$id_seguimiento,
            'activo'=>1,
            'derivado_por'=>Yii::$app->user->identity->id_usuario, 
        ])->count();
         
         
        return $count;
        
        
    } // fin function
    
    public function countNoRecepcionados($nuri, $id_seguimiento){

        $count = Seguimientos::find()->where([
           'codigo'=>$nuri,
            'padre'=>$id_seguimiento,
            'activo'=>1,
            'fk_estado'=>3,
            'derivado_por'=>Yii::$app->user->identity->id_usuario,
        ])->count();        

        return $count;
    } // fin function
    
    public function updateReestablecerPendiente($nur,$id_seguimiento){

	$connection= Yii::$app->db;
	$connection->createCommand("UPDATE seguimientos SET confirmado=0, activo=0 WHERE codigo='$nur' AND padre=$id_seguimiento ")->execute();

	// codigo para restaurar a pendientes el nuri padre
        $seguimientos = Seguimientos::findOne($id_seguimiento);
            if ($seguimientos->oficial==1) {
            	$seguimientos->fk_estado=1;
            }
            else{
		$seguimientos->fk_estado=2;
            }
	$seguimientos->save();

    }
    
    public function updateReestablecerNuevo($nur){

	$connection= Yii::$app->db;
	$connection->createCommand("UPDATE seguimientos SET confirmado=0, activo=0 WHERE codigo='$nur'")->execute();
    }
    
    public function derivarcopiasgrupos($id_grupo_derivacion, $nuri, $proveido, $accion){

        $command=Yii::$app->db->createCommand("
        	SELECT *
        	FROM detalle_grupo_derivacion 
        	WHERE fk_grupo_derivacion=$id_grupo_derivacion AND activo=1
        ");
        $dataReader=$command->query();
        
        foreach ($dataReader as $row){
            
            $model = new Seguimientos();
            $model->codigo=strtoupper($nuri);
            $model->derivado_por=Yii::$app->user->identity->id_usuario;
            $model->derivado_a=$row['usuario_origen'];
            $model->proveido=strtoupper($proveido);
            $model->fecha_derivacion=date('Y-m-d');
            $model->hora_derivacion=date('H:i:s');
            $model->fecha_recepcion="1000-01-01";
            $model->hora_recepcion="00:00:00";
            $model->gestion=date('Y');

            $model->hijo='0';
            $model->padre='0';
            $model->oficial=0;
            $model->confirmado=0;
            $model->activo=1;
            $model->fk_estado=3;
            $model->fk_accion=$accion;

            $model->observado=0;
            $model->accion_archivo="NULL";
            $model->fk_grupo_derivacion=$id_grupo_derivacion;
            $model->fk_principal_agrupacion=0;
            
            $numero_copia=Seguimientos::asignarnumerocopia($nuri);
            $model->numero_copia=$numero_copia.'';
            $model->correlativo_copia=$numero_copia;

            //$model->numero_copia='0';
            //$model->correlativo_copia=0;

            $model->fecha_registro=date('Y-m-d');
            $model->hora_registro=date('H:i:s');            
            $model->save();
            
        } // fin foreach
        
    } // fin function
    
    public function derivarcopiasgrupospendiente($id_grupo_derivacion, $proveido, $id_seguimiento){
        
        $seguimientos = Seguimientos::findOne($id_seguimiento);

        $command=Yii::$app->db->createCommand("
        	SELECT *
        	FROM detalle_grupo_derivacion 
        	WHERE fk_grupo_derivacion=$id_grupo_derivacion AND activo=1
        ");
        $dataReader=$command->query();
        
        foreach ($dataReader as $row){
            
            $model = new Seguimientos();
            $model->codigo=strtoupper($seguimientos->codigo);
            $model->derivado_por=Yii::$app->user->identity->id_usuario;
            $model->derivado_a=$row['usuario_origen'];
            $model->proveido=strtoupper($proveido);
            $model->fecha_derivacion=date('Y-m-d');
            $model->hora_derivacion=date('H:i:s');
            $model->fecha_recepcion="1000-01-01";
            $model->hora_recepcion="00:00:00";
            $model->gestion=date('Y');

            $model->hijo='0';
            $model->padre=$seguimientos->id_seguimiento;
            $model->oficial=0;
            $model->confirmado=0;
            $model->activo=1;
            $model->fk_estado=3;
            $model->fk_accion=$seguimientos->fk_accion;

            $model->observado=0;
            $model->accion_archivo="NULL";
            $model->fk_grupo_derivacion=$id_grupo_derivacion;
            $model->fk_principal_agrupacion=0;
            
            if($seguimientos->oficial==1){
                $numero_copia=Seguimientos::asignarnumerocopia($seguimientos->codigo);
                $model->numero_copia=$numero_copia.'';
                $model->correlativo_copia=$numero_copia;
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
            
            
            
            
            /*
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
            }*/
            
            
            
            
            
            
            

            //$model->numero_copia='0';
            //$model->correlativo_copia=0;

            $model->fecha_registro=date('Y-m-d');
            $model->hora_registro=date('H:i:s');            
            $model->save();
            
        } // fin foreach
        
    } // fin function
    
    
    public function contaraccionesdistintas($nuri){
        
         $row=Yii::$app->db->createCommand("
	    	SELECT count (distinct(fk_accion)) total
        	FROM seguimientos
        	WHERE codigo='$nuri'
                    AND activo=1 
                    AND confirmado=0 
		")->query()->read();

       return $row['total'];
    }
    
    public function obtenerIdDocumento($nuri){
        
        $usuario=Yii::$app->user->identity->id_usuario;
        
         $row=Yii::$app->db->createCommand("
	    	SELECT fk_documento
        	FROM hojas_ruta
        	WHERE nur='$nuri' AND activo=1 AND nro=0 AND fk_usuario=$usuario ORDER BY id_hoja_ruta ASC LIMIT 1
		")->query()->read();

       return $row['fk_documento'];
    }
    
    public function verificarSiExisteOficialDocumento($nuri){

        $count = Seguimientos::find()->where([
           'codigo'=>$nuri,
            'activo'=>1,
            'fk_estado'=>3,
            'oficial'=>1,
            'confirmado'=>0,
            'derivado_por'=>Yii::$app->user->identity->id_usuario,
        ])->count();        

        return $count;
    } // fin function
    
    
    public function asignarnumerocopia($nuri){
        
        $row=Yii::$app->db->createCommand("
	    	SELECT max(correlativo_copia) mayor
        	FROM seguimientos
        	WHERE codigo='$nuri' AND activo=1 AND oficial=0
		")->query()->read();
        
        //$numero=$row['mayor']+1;
        return $row['mayor']+1;
        
    }
    
    public function asignarnumerocopiacopia($id_seguimiento, $nuri){
        
        $row=Yii::$app->db->createCommand("
	    	SELECT max(correlativo_copia) mayor
        	FROM seguimientos
        	WHERE codigo='$nuri' AND padre=$id_seguimiento AND activo=1 AND oficial=0
		")->query()->read();
        
        //$numero=$row['mayor']+1;
        return $row['mayor']+1;
        
    }
    
    public static function getAccion($nuri){
        
        $row=Yii::$app->db->createCommand("
	    	SELECT accion
        	FROM seguimientos s, acciones a 
        	WHERE s.codigo='$nuri' AND s.activo=1 AND s.fk_accion=a.id_accion AND s.oficial=1
                ORDER BY id_seguimiento ASC LIMIT 1    
		")->query()->read();
        
        //$numero=$row['mayor']+1;
        return $row['accion'];
        
    }
    
    public static function verificarNuriPendiente($id_documento){
        
        $counths = Hojasruta::find()->where([
                         'activo'=>1,
                         'fk_usuario'=>Yii::$app->user->identity->id_usuario,
                         'fk_documento'=>$id_documento,
                     ])->count();
        
        if($counths>0){
        
            $row=Yii::$app->db->createCommand("
                    SELECT *
                    FROM hojas_ruta
                    WHERE fk_documento=$id_documento AND activo=1
                    ")->query()->read();

            //$numero=$row['mayor']+1;
            if($row['nro']==0){
                // codigo para verificar si esta derivado
                $count = Seguimientos::find()->where([
                        'codigo'=>$row['nur'],
                         'activo'=>1,
                         'fk_estado'=>3,
                         'oficial'=>[1,0],
                         'confirmado'=>1,
                         'derivado_por'=>Yii::$app->user->identity->id_usuario,
                     ])->count();        

                if($count>0){    
                    return false;          
                }
                else{   
                    
                    $countrecibido = Seguimientos::find()->where([
                        'codigo'=>$row['nur'],
                         'activo'=>1,
                         'fk_estado'=>1,
                         'oficial'=>[1,0],
                         'confirmado'=>1,
                         'derivado_por'=>Yii::$app->user->identity->id_usuario,
                     ])->count();
                    
                    if($countrecibido>0){
                        return false;          
                    }
                    else{
                        return true;          
                    }
                    
                    
                }
            }
            else{
                
                //echo "----> ".$row['nur'];
                //exit();

                $countseguimiento = Seguimientos::find()->where([
                        'codigo'=>$row['nur'],
                         'activo'=>1,
                         'fk_estado'=>[1,2],
                         'confirmado'=>1,
                         'derivado_a'=>Yii::$app->user->identity->id_usuario,
                     ])->count();

                if($countseguimiento==0){     return false;          }
                else {  return true;   }


            }
        }
        else{
            return false;
        }
        
    } //end function
    
    public static function verificarNuriPendienteNuevo($id_documento){
        
        $row=Yii::$app->db->createCommand("
	    	SELECT *
        	FROM hojas_ruta
        	WHERE fk_documento=$id_documento AND activo=1
		")->query()->read();
        
        if($row['nro']==0){


            $countderivado = Seguimientos::find()->where([
                        'codigo'=>$row['nur'],
                         'activo'=>1,
                         'confirmado'=>1,
                         'derivado_por'=>Yii::$app->user->identity->id_usuario,
                     ])->count();


            if($countderivado==0){
                echo Html::a("<i style='font-size:15pt;' class='fa fa-share-square'></i><br><span style='font-size:9pt;'>&nbsp;&nbsp;&nbsp; Derivar &nbsp;&nbsp;&nbsp;&nbsp;</span>", ['seguimientos/derivardocumento', 'id_documento' => $id_documento], ['class' => 'btn btn-warning']); 
            }
            else{

                echo Html::a("<i style='font-size:15pt;' class='fa fa-paw'></i><br><span style='font-size:9pt;'>&nbsp;&nbsp;&nbsp; Seguimiento&nbsp;&nbsp;&nbsp;&nbsp;</span>", ['seguimientos/seguimientonuri', 'nuri' => Documentos::getNuriAsignado($id_documento)], ['class' => 'btn btn-warning']);
            }
        }
        else{
            $row=Yii::$app->db->createCommand("
	    	SELECT *
        	FROM hojas_ruta
        	WHERE fk_documento=$id_documento AND activo=1
		")->query()->read();
            
            echo Html::a("<i style='font-size:15pt;' class='fa fa-share-square'></i><br><span style='font-size:9pt;'>&nbsp;&nbsp;&nbsp; Derivar Pendiente&nbsp;&nbsp;&nbsp;&nbsp;</span>", ['seguimientos/derivarpendiente', 'id' => $row['nro']], ['class' => 'btn btn-warning']); 
        }
        
        
    } //end function
    
    public function getIdHojaruta($id_seguimiento){
        
        $usuario=Yii::$app->user->identity->id_usuario;
        
        $row=Yii::$app->db->createCommand("
	    	SELECT id_hoja_ruta
        	FROM hojas_ruta
        	WHERE nro=$id_seguimiento AND activo=1 AND fk_usuario=$usuario ORDER BY id_hoja_ruta ASC LIMIT 1
		")->query()->read();
        
        return $row['id_hoja_ruta'];
    }
    
    
    public function getVerificarDerivacionCopia($id_seguimiento){
        
       $seguimientos = Seguimientos::findOne($id_seguimiento); 
        
       $count = Seguimientos::find()->where([
                        'codigo'=>$seguimientos->codigo,
                         'activo'=>1,
                         'fk_estado'=>3,
                         'confirmado'=>0,
                         'numero_copia'=>$seguimientos->numero_copia,
                         'derivado_por'=>Yii::$app->user->identity->id_usuario,
                     ])->count();
       
       return $count;
    }
    
    public static function getObtenerReferenciaRemitente($nuri){

	$connection= Yii::$app->db;

       $row=$connection->createCommand("SELECT d.remitente_nombres, d.remitente_cargo, d.referencia, d.codigo cite,d.fecha
			FROM hojas_ruta h, documentos d
			WHERE h.nur='$nuri'
			AND h.nro=0
			AND h.oficial=1
			AND h.activo=1
			AND h.fk_documento=d.id_documento
		")->query()->read();

       return $row;
    }
    
    public function getNoRecibidosUsuario($id_usuario){

        $command=Yii::$app->db->createCommand("
        	SELECT * FROM no_recibidos_usuario($id_usuario)
        ");
        $dataReader=$command->query();

        return $dataReader;
    }
    
    public function getNurisPendientesOficialesDigitales($id_usuario){

        $command=Yii::$app->db->createCommand("
        	SELECT * FROM pendientes_oficiales_digitales($id_usuario)
        ");
        $dataReader=$command->query();

        return $dataReader;
    }
    
    public static function getPendientes($id_usuario){

        $command=Yii::$app->db->createCommand("
                
                SELECT
				codigo as nuri,
				COALESCE(NULLIF(s.fecha_derivacion::DATE,'1000-01-01'),null) as f_derivacion,
				COALESCE(NULLIF(s.hora_derivacion::TIME,'00:00:00'),null) as h_derivacion,
				COALESCE(NULLIF(s.fecha_recepcion::DATE,'1001-01-01'),null) as f_recepcion,
				COALESCE(NULLIF(s.hora_recepcion::TIME,'00:00:01'),null) as h_recepcion,
				(CASE WHEN oficial=1 THEN   'ORIGINAL' 
                                                     ELSE   'COPIA' 
                                    END ) as tipo_documento,
				COALESCE(NULLIF((select d. referencia from hojas_ruta h, documentos d where h.nur=s.codigo and h.nro=0 and h.fk_documento=d.id_documento  order by h.id_hoja_ruta desc limit 1 ),''),'S/N') as referencia
                FROM seguimientos s
                WHERE s.activo=1 AND fk_estado in (1,2) AND derivado_a=$id_usuario ORDER BY s.fecha_derivacion DESC LIMIT 8

        ");
        $dataReader=$command->query();

        return $dataReader;
    }
    
    public static function getNorecibidos($id_usuario){

        $command=Yii::$app->db->createCommand("
                
                SELECT
				codigo as nuri,
				COALESCE(NULLIF(s.fecha_derivacion::DATE,'1000-01-01'),null) as f_derivacion,
				COALESCE(NULLIF(s.hora_derivacion::TIME,'00:00:00'),null) as h_derivacion,
				COALESCE(NULLIF(s.fecha_recepcion::DATE,'1001-01-01'),null) as f_recepcion,
				COALESCE(NULLIF(s.hora_recepcion::TIME,'00:00:01'),null) as h_recepcion,
				(CASE WHEN oficial=1 THEN   'ORIGINAL' 
                                                     ELSE   'COPIA' 
                                    END ) as tipo_documento,
				COALESCE(NULLIF((select d. referencia from hojas_ruta h, documentos d where h.nur=s.codigo and h.nro=0 and h.fk_documento=d.id_documento  order by h.id_hoja_ruta desc limit 1 ),''),'S/N') as referencia
                FROM seguimientos s
                WHERE s.activo=1 AND s.confirmado=1 AND fk_estado=3 AND derivado_a=$id_usuario ORDER BY s.fecha_derivacion DESC LIMIT 8

        ");
        $dataReader=$command->query();

        return $dataReader;
    }
    
    public static function getcountnorecibidos($id_usuario){
        
        $row=Yii::$app->db->createCommand("
                        SELECT COUNT(*) total 
                        FROM seguimientos
                        WHERE derivado_a=$id_usuario AND confirmado=1 AND activo=1 AND fk_estado=3 ")->query()->read();
        return $row['total'];
    }
    
    public static function getcountpendientes($id_usuario){
        
        $row=Yii::$app->db->createCommand("
                        SELECT COUNT(*) total 
                        FROM seguimientos
                        WHERE derivado_a=$id_usuario AND confirmado=1 AND activo=1 AND fk_estado in (1,2) ")->query()->read();
        return $row['total'];
    }
    
    public static function getDerivadosNoRecibidos($id_usuario){

        $command=Yii::$app->db->createCommand("
        	SELECT * FROM derivados_no_recibidos($id_usuario)
        ");
        $dataReader=$command->query();

        return $dataReader;
    }

    public function getDerivadosSinConfirmar($id_usuario){

        $command=Yii::$app->db->createCommand("
            SELECT * FROM derivados_sin_confirmar($id_usuario)
        ");
        $dataReader=$command->query();

        return $dataReader;
    }


    public function getDerivadosNoRecibidosgeneral($id_usuario, $id_seguimiento){

        $row=Yii::$app->db->createCommand(" SELECT * FROM derivados_no_recibidos_general ($id_usuario, $id_seguimiento) ")->query()->read();
        return $row;
    }
    
    public function diferencia_entre_fechas($fecha_inicial){

        $fecha_final=date('Y-m-d');

        $dias = (strtotime($fecha_inicial)-strtotime($fecha_final))/86400;
        $dias = abs($dias); $dias = floor($dias);
        return $dias;
    }
    public static function getNoRecibidosUsuarioArea($id_area){

        $command=Yii::$app->db->createCommand("
        	SELECT * FROM no_recibidos_area($id_area)
        ");
        $dataReader=$command->query();

        return $dataReader;
    }


    public function getResumenpendientes($id_area){

        $command=Yii::$app->db->createCommand("
            SELECT * FROM resumenpendientes WHERE id_area=$id_area
        ");
        $dataReader=$command->query();

        return $dataReader;
    }

    public function getResumenpendientespersonal($id_usuario){

        $command=Yii::$app->db->createCommand("
            SELECT * FROM resumenpendientes WHERE id_usuario=$id_usuario
        ");
        $dataReader=$command->query();

        return $dataReader;
    }
    
    public function getArchivoarea($id_area){

        $command=Yii::$app->db->createCommand("
            SELECT * FROM reporte_archivo_area WHERE fk_area=$id_area
        ");
        $dataReader=$command->query();

        return $dataReader;
    }
    
    
    
    public function getNurisPendientesOficialesDigitalesArea($id_area){

        $command=Yii::$app->db->createCommand("
        	SELECT * FROM pendientes_oficiales_digitales_area($id_area)
        ");
        $dataReader=$command->query();

        return $dataReader;
    }
    
    public function getDerivadosNoRecibidosArea($id_area){

        $command=Yii::$app->db->createCommand("
        	SELECT * FROM derivados_no_recibidos_area($id_area)
        ");
        $dataReader=$command->query();

        return $dataReader;
    }
    
    
    public function getderivacionbloque(){

        $usuario=Yii::$app->user->identity->id_usuario;    
        $command=Yii::$app->db->createCommand("
        	SELECT d.id_derivacion_temporal, d.fk_seguimiento, d.nuri, 

    		(CASE WHEN s.oficial=1 THEN
    				'ORIGINAL'
    			ELSE
    				'COPIA'	
    			END	
    		) as tipo

			   FROM derivaciontemporal d, seguimientos s
			   WHERE d.fk_usuario=$usuario AND d.fk_seguimiento=s.id_seguimiento ORDER BY d.id_derivacion_temporal ASC
        ");
        $dataReader=$command->query();

        return $dataReader;
    }
    
    
    
    public function getrecepcionbloque(){

        $usuario=Yii::$app->user->identity->id_usuario;    
        $command=Yii::$app->db->createCommand("
        	SELECT d.id_recepcion_temporal, d.fk_seguimiento, d.nuri, 

    		(CASE WHEN s.oficial=1 THEN
    				'ORIGINAL'
    			ELSE
    				'COPIA'	
    			END	
    		) as tipo

			   FROM recepciontemporal d, seguimientos s
			   WHERE d.fk_usuario=$usuario AND d.fk_seguimiento=s.id_seguimiento ORDER BY d.id_recepcion_temporal ASC
        ");
        $dataReader=$command->query();

        return $dataReader;
    }
    
    
    
    
    public static function getFechaBloqueo(){
        
        $usuario=Yii::$app->user->identity->id_usuario;

	// este procedimiento se utilizara para obtener la fecha mas antigua de derivacion del remitente 
	// se le sumara dos dias y si es menor a la fecha actual bloquera el sistema
        
        $row=Yii::$app->db->createCommand("
                        SELECT MIN(fecha_derivacion) fecha_menor 
                        FROM seguimientos
                        WHERE derivado_a=$usuario 
                            AND confirmado=1 AND activo=1 AND fk_estado=3
		")->query()->read();
        
		
			
			// CODIGO PARA AÑADIR 7 DIAS HABILES A LA FECHA DE REGISTRO

			$numero_dias=2; // contador para dias habiles
			//$fecha_noti='2021-06-30'; 
			$fecha_noti=$row['fecha_menor']; 


			//Arreglo con todos los feriados 
			$feriados = array( '2022-06-21', '2022-07-16', '2022-08-06', '2022-11-02', '2022-12-25', '2022-01-01', '2022-05-01', ); 
			//Timestamp De Fecha De Comienzo 
			$comienzo = strtotime($fecha_noti); 
			//Inicializo la Fecha Final 
			$fecha_venci_noti = $comienzo; 


			//Inicializo El Contador 
			$i = 0; 
			while ($i < $numero_dias) {  // este es el contador de dias habiles

			//Le Sumo un Dia a La Fecha Final (86400 Segundos) 
				$fecha_venci_noti += 86400; 
				//Inicializo a FALSE La Variable Para Saber Si Es Feriado 
				$es_feriado = FALSE; 
				//Recorro Todos Los Feriados 
				foreach ($feriados as $key => $feriado) { 
				//Verifico Si La Fecha Final Actual Es Feriado O No 
					if (date("Y-m-d", $fecha_venci_noti) === date("Y-m-d", strtotime($feriado))) { 
					//En Caso de Ser feriado Cambio Mi variable A TRUE 
						$es_feriado = TRUE; 
					} 
				} 
						//Verifico Que No Sea Un Sabado, Domingo O Feriado 
				if (!(date("w", $fecha_venci_noti) == 6 || date("w", $fecha_venci_noti) == 0 || $es_feriado)) { //En Caso De No Ser Sabado, Domingo O Feriado Aumentamos Nuestro contador 
							$i++; 
				} 

			} 

			// FIN CODIGO PARA AÑADIR DIAS HABLIES
			$plazo_fin=date("Y-m-d", $fecha_venci_noti);	

			return $plazo_fin;

    }
    
    
    
    public static function getFechapendientesadiciondias(){
        
        $usuario=Yii::$app->user->identity->id_usuario;

	// este procedimiento se utilizara para obtener la fecha mas antigua de derivacion del remitente 
	// se le sumara dos dias y si es menor a la fecha actual bloquera el sistema
        
        $row=Yii::$app->db->createCommand("
                        SELECT MIN(fecha_recepcion) fecha_menor 
                        FROM seguimientos
                        WHERE derivado_a=$usuario 
                        AND confirmado=1 AND activo=1 AND fk_estado in (1,2)
		")->query()->read();
        
		
			
			// CODIGO PARA AÑADIR 7 DIAS HABILES A LA FECHA DE REGISTRO

			$numero_dias=5; // contador para dias habiles
			//$fecha_noti='2021-06-30'; 
			$fecha_noti=$row['fecha_menor']; 


			//Arreglo con todos los feriados 
			$feriados = array( '2022-06-21', '2022-07-16', '2022-08-06', '2022-11-02', '2022-12-25', '2022-01-01', '2022-05-01', ); 
			//Timestamp De Fecha De Comienzo 
			$comienzo = strtotime($fecha_noti); 
			//Inicializo la Fecha Final 
			$fecha_venci_noti = $comienzo; 


			//Inicializo El Contador 
			$i = 0; 
			while ($i < $numero_dias) {  // este es el contador de dias habiles

			//Le Sumo un Dia a La Fecha Final (86400 Segundos) 
				$fecha_venci_noti += 86400; 
				//Inicializo a FALSE La Variable Para Saber Si Es Feriado 
				$es_feriado = FALSE; 
				//Recorro Todos Los Feriados 
				foreach ($feriados as $key => $feriado) { 
				//Verifico Si La Fecha Final Actual Es Feriado O No 
					if (date("Y-m-d", $fecha_venci_noti) === date("Y-m-d", strtotime($feriado))) { 
					//En Caso de Ser feriado Cambio Mi variable A TRUE 
						$es_feriado = TRUE; 
					} 
				} 
						//Verifico Que No Sea Un Sabado, Domingo O Feriado 
				if (!(date("w", $fecha_venci_noti) == 6 || date("w", $fecha_venci_noti) == 0 || $es_feriado)) { //En Caso De No Ser Sabado, Domingo O Feriado Aumentamos Nuestro contador 
							$i++; 
				} 

			} 

			// FIN CODIGO PARA AÑADIR DIAS HABLIES
			$plazo_fin=date("Y-m-d", $fecha_venci_noti);	

			return $plazo_fin;

    }
    
    
    public function getDiasHabiles($fechainicio, $fechafin, $diasferiados = array()) {
        // Convirtiendo en timestamp las fechas
        $fechainicio = strtotime($fechainicio);
        $fechafin = strtotime($fechafin);
       
        // Incremento en 1 dia
        $diainc = 24*60*60;
       
        // Arreglo de dias habiles, inicianlizacion
        $diashabiles = array();
       
        // Se recorre desde la fecha de inicio a la fecha fin, incrementando en 1 dia
        for ($midia = $fechainicio; $midia <= $fechafin; $midia += $diainc) {
                // Si el dia indicado, no es sabado o domingo es habil
                if (!in_array(date('N', $midia), array(6,7))) { // DOC: http://www.php.net/manual/es/function.date.php
                        // Si no es un dia feriado entonces es habil
                        if (!in_array(date('Y-m-d', $midia), $diasferiados)) {
                                array_push($diashabiles, date('Y-m-d', $midia));
                        }
                }
        }
       
        return $diashabiles;
   }
    
    
    static function restarDiasfecha($startdate,$buisnessdays,$holidays=[],$dateformat='Y-m-d'){
        $i=0;
        $dayx = strtotime($startdate);
        
        while($i < $buisnessdays){
           $day = date('N',$dayx);
           $date = date('Y-m-d',$dayx);

           if($day<6 && !in_array($date,$holidays))
           $i++;

           $dayx = strtotime($date . ' -1 day');
        }
        return date($dateformat,$dayx);
    }


    static function bloqueonorecibidos($fecha){

        $remitente=Yii::$app->user->identity->id_usuario;

        $row=Yii::$app->db->createCommand("
                        SELECT count(*) as total
                        FROM seguimientos
                        WHERE derivado_por=$remitente 
                        AND confirmado=1 AND activo=1 AND fk_estado=3 AND fecha_derivacion<='$fecha'
        ")->query()->read();

        return $row['total'];

    }
    
    
    public static function countTotalQueDebenLlegar(){

        return Seguimientos::find()->where(['derivado_a'=>Yii::$app->user->identity->id_usuario,
            'activo'=>1,
            'confirmado'=>1,
            'fk_estado'=>3, ])
            ->andWhere(['<', 'fecha_derivacion', Seguimientos::restarDiasfecha(date('Y-m-d'),2)])->count();
    }
    
    public function recibirbloque(){

        $usuario=Yii::$app->user->identity->id_usuario;    
        $command=Yii::$app->db->createCommand("
                           SELECT * 
        		   FROM recepciontemporal
			   WHERE fk_usuario=$usuario ORDER BY id_recepcion_temporal ASC
        ");
        $dataReader=$command->query();

        return $dataReader;
    }
    
    public function derivarbloque(){

        $usuario=Yii::$app->user->identity->id_usuario;    
        $command=Yii::$app->db->createCommand("
                           SELECT * 
        		   FROM derivaciontemporal
			   WHERE fk_usuario=$usuario ORDER BY id_derivacion_temporal ASC
        ");
        $dataReader=$command->query();

        return $dataReader;
    }

    
    public function dataproviderdestinobloque(){
        
        $usuario=Yii::$app->user->identity->id_usuario;    

        $totalCount = Yii::$app->db
            ->createCommand('SELECT COUNT(*) FROM derivaciontemporal WHERE fk_usuario=:fk_usuario', [':fk_usuario' => $usuario])
            ->queryScalar();

        $dataProvider = new SqlDataProvider([
            'sql' => 'SELECT * FROM derivaciontemporal d, seguimientos s WHERE d.fk_seguimiento=s.padre AND d.fk_usuario=:fk_usuario AND s.activo=1 AND s.fk_estado=3 AND s.confirmado=0',
            
            'params' => [':fk_usuario' => $usuario],
            'totalCount' => $totalCount,
            //'sort' =>false, to remove the table header sorting
            'sort' => [
                'attributes' => [
                    'title' => [
                        'asc' => ['title' => SORT_ASC],
                        'desc' => ['title' => SORT_DESC],
                        'default' => SORT_DESC,
                        'label' => 'Post Title',
                    ],
                    'author' => [
                        'asc' => ['author' => SORT_ASC],
                        'desc' => ['author' => SORT_DESC],
                        'default' => SORT_DESC,
                        'label' => 'Name',
                    ],
                                'created_on'
                ],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $dataProvider;

        
    }// end function
    
    public function countderivarbloque(){
       
       $usuario=Yii::$app->user->identity->id_usuario;
       $row=Yii::$app->db->createCommand("SELECT count(*) total 
                                          FROM derivaciontemporal d, seguimientos s 
                                          WHERE d.fk_seguimiento=s.padre AND d.fk_usuario=$usuario AND s.activo=1 AND s.fk_estado=3 AND s.confirmado=0
		")->query()->read();

       return $row['total'];
    }
    
    public function countderivartemp(){
       
       $usuario=Yii::$app->user->identity->id_usuario;
       $row=Yii::$app->db->createCommand("SELECT count(*) total 
                                          FROM derivaciontemporal  
                                          WHERE fk_usuario=$usuario
		")->query()->read();

       return $row['total'];
    }
    
    
    public static function pendientesusuariosmessage(){

        $usuario=Yii::$app->user->identity->id_usuario;    
        $command=Yii::$app->db->createCommand("
                           SELECT s.codigo nuri, 
                            COALESCE(NULLIF((select concat(u.nombre,' - ',u.cargo) from usuarios  u where s.derivado_por=u.id_usuario  ),''),'S/N') nombre_remitente,
                            (CASE
                                WHEN s.oficial=1 THEN
                                    'ORIGINAL'                   
                                ELSE
                                    ' COPIA'
                             END)  tipo_tramite,
                             
                            s.fecha_recepcion, s.hora_recepcion, s.proveido

                            FROM seguimientos s
                            WHERE s.activo=1 AND s.fk_estado in (1,2) AND s.derivado_a=$usuario ORDER BY s.fecha_recepcion ASC LIMIT 10
        ");
        $dataReader=$command->query();

        return $dataReader;
    }

    public function verificarOriginalCopia($id_seguimiento){
        
       $seguimientos = Seguimientos::findOne($id_seguimiento); 
        
        if($seguimientos->oficial==1){

            $count = Seguimientos::find()->where([
                        'codigo'=>$seguimientos->codigo,
                         'activo'=>1,
                         'fk_estado'=>3,
                         'confirmado'=>0,
                         'oficial'=>1,
                         'derivado_por'=>Yii::$app->user->identity->id_usuario,
                     ])->count();

            if($count==1){
                return 1;
            }
            else{
                return 0;
            }

        }
        else{
                if($seguimientos->oficial==0){
                    return 1;
                }    
        }    
       
    }


    public static function totalquedebenllegar($id_usuario){

        $row=Yii::$app->db->createCommand("SELECT * 
                                          FROM totalquedebenllegar($id_usuario)  
        ")->query()->read();

       return $row['total'];
    }

    public static function getPendientesAreaSAC(){
        
        $id_area=Yii::$app->user->identity->fk_area;
        
        if($id_area==1){

            $dataReader=Yii::$app->db->createCommand("SELECT * FROM resumenpendientesgeneral")->query();            
        }
        else{
            $dataReader=Yii::$app->db->createCommand("SELECT * FROM resumenpendientesgeneral WHERE dependencia=$id_area")->query();    
        }

        return $dataReader;
    }

    public static function getpendientespersonal($id_area){
        
        $dataReader=Yii::$app->db->createCommand("SELECT * FROM resumenpendientes WHERE id_area=$id_area")->query();
        
        return $dataReader;
    }


    public function getnamearea($id_area){

        $model = Areas::findOne($id_area);
        return $model->area;
    }

    

//########################################################################################
//MENSAJES 
    public function mensajeMismaAccion(){
        echo Growl::widget([
            'type' => Growl::TYPE_WARNING,
            'title' => '&nbsp; <b>Alerta</b>',
            //'icon' => '/images/kartik.png',
            'icon' => 'glyphicon glyphicon-alert',
            'iconOptions' => ['class'=>'img-circle pull-left'],
            'body' => 'El campo/columna <b>Accion/Tipo Proceso</b> debe ser igual en todas las derivaciones, no puede confirmar y finalizar la derivacion si no realiza la modificacion correspondiente',
            'showSeparator' => true,

            //'delay' => 7500,
            'pluginOptions' => [
                //'icon_type'=>'image',
                'showProgressbar' => true,
                'timer'=>13000,
                'mouse_over'=>'pause',
                'placement' => [
                    'from' => 'top',
                    'align' => 'right',
                ],
            ]
        ]);
    }
    
    public function mensajeCantidadLetras($nuri){
        echo Growl::widget([
            'type' => Growl::TYPE_DANGER,
            'title' => '&nbsp; <b>Alerta</b>',
            //'icon' => '/images/kartik.png',
            'icon' => 'glyphicon glyphicon-alert',
            'iconOptions' => ['class'=>'img-circle pull-left'],
            'body' => 'Para confirmar el envio del tramite es necesario que el contenido de toda la documentaci&oacute;n asociada al <b>NUR/NURI: '.$nuri.'</b> este completa',
            'showSeparator' => true,

            //'delay' => 7500,
            'pluginOptions' => [
                //'icon_type'=>'image',
                'showProgressbar' => true,
                'timer'=>2500,
                'mouse_over'=>'pause',
                'placement' => [
                    'from' => 'top',
                    'align' => 'right',
                ],
            ]
        ]);
    }
    
    public function mensajeNoSePuedeConfirmar($nuri){
        echo Growl::widget([
            'type' => Growl::TYPE_DANGER,
            'title' => '&nbsp; <b>Alerta</b>',
            //'icon' => '/images/kartik.png',
            'icon' => 'glyphicon glyphicon-alert',
            'iconOptions' => ['class'=>'img-circle pull-left'],
            'body' => 'Para confirmar el envio del <b>NUR/NURI: '.$nuri.'</b> es necesario el registro <b>UN</b> solo <b>ORIGINAL</b>',
            'showSeparator' => true,

            //'delay' => 7500,
            'pluginOptions' => [
                //'icon_type'=>'image',
                'showProgressbar' => true,
                'timer'=>2500,
                'mouse_over'=>'pause',
                'placement' => [
                    'from' => 'top',
                    'align' => 'right',
                ],
            ]
        ]);
    }
    
 

    
    
//########################################################################################        
} // FIN CLASS
