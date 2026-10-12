<?php

namespace app\models;
use app\models\Hojasruta;
use app\models\TipoDocumento;
use app\models\Areas;
use app\models\Motivos;
use app\models\Usuarios;
use app\models\Ventanilla;
use app\models\Informacionsuic;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use Yii;

/**
 * This is the model class for table "documentos".
 *
 * @property int $id_documento
 * @property string $codigo
 * @property string|null $destinatario_titulo
 * @property string|null $destinatario_nombres
 * @property string|null $destinatario_cargo
 * @property string|null $destinatario_institucion
 * @property string|null $remitente_nombres
 * @property string|null $remitente_cargo
 * @property string|null $remitente_institucion
 * @property string $referencia
 * @property string $contenido
 * @property string $fecha
 * @property string $hora
 * @property string|null $adjuntos
 * @property string|null $copias
 * @property string|null $via_nombres
 * @property string|null $via_cargo
 * @property string|null $nro_hojas
 * @property int $gestion
 * @property string $fecha_registro
 * @property string $hora_registro
 * @property int $fk_usuario
 * @property int $fk_tipo_documento
 * @property int $fk_estado_documento
 * @property int $fk_area
 * @property int $fk_documento
 * @property string|null $ruta_documento
 * @property int $activo
 * @property int|null $usuario_destino
 * @property int|null $grupo_destino
 * @property string|null $nombre_grupo
 * @property int|null $fk_motivo
 * @property int|null $observado
 * @property string|null $enlace_nube
 * @property int|null $fk_regional_suic
 * @property int|null $fk_taller_suic
 * @property int|null $fk_orden_pago_suic
 * @property int|null $carpeta_pago
 *
 * @property Areas $fkArea
 * @property EstadoDocumento $fkEstadoDocumento
 * @property TipoDocumento $fkTipoDocumento
 * @property Usuarios $fkUsuario
 */
class Documentos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    
    public $archivo;
    
    
    public static function tableName()
    {
        return 'documentos';
    }

    /**
     * {@inheritdoc}
     */
        public function rules()
    {
        return [
            ['destinatario_nombres','required','message'=>'El Nombre de Destino no puede quedar vacío '],
            
            ['destinatario_nombres','required','message'=>'El Nombre de Destino no puede quedar vacío '],
            ['remitente_nombres','required','message'=>'El Nombre de Remitente no puede quedar vacío '],
            ['remitente_cargo','required','message'=>'El Cargo de Remitente no puede quedar vacío '],
            ['referencia','required','message'=>'La Referencia no puede quedar vacío '],
            ['contenido','required','message'=>'El Contenido del documento no puede quedar vacío '],
            ['fk_estado_documento','required','message'=>'El Estado de Documento no puede quedar vacío '],
            ['fk_motivo','required','message'=>'El Motivo no puede quedar vacío, por favor seleccione una opción '],
            
            
            [['archivo'], 'file', 'extensions'=>'pdf'],
            
            
            [['codigo', 'referencia', 'contenido', 'fecha', 'hora', 'gestion', 'fecha_registro', 'hora_registro', 'fk_usuario', 'fk_tipo_documento', 'fk_estado_documento', 'fk_area'], 'required'],
            [['referencia', 'contenido'], 'string'],
            [['fecha', 'hora', 'fecha_registro', 'hora_registro'], 'safe'],
            [['gestion', 'fk_usuario', 'fk_tipo_documento', 'fk_estado_documento', 'fk_area', 'fk_documento', 'activo', 'usuario_destino', 'grupo_destino', 'fk_motivo', 'observado', 'fk_regional_suic', 'fk_taller_suic', 'fk_orden_pago_suic', 'carpeta_pago'], 'default', 'value' => null],
            [['gestion', 'fk_usuario', 'fk_tipo_documento', 'fk_estado_documento', 'fk_area', 'fk_documento', 'activo', 'usuario_destino', 'grupo_destino', 'fk_motivo', 'observado', 'fk_regional_suic', 'fk_taller_suic', 'fk_orden_pago_suic', 'carpeta_pago'], 'integer'],
            [['codigo', 'destinatario_cargo', 'destinatario_institucion', 'remitente_nombres', 'remitente_cargo', 'remitente_institucion', 'adjuntos', 'via_nombres', 'via_cargo', 'nro_hojas', 'enlace_nube'], 'string', 'max' => 500],
            [['destinatario_titulo', 'destinatario_nombres'], 'string', 'max' => 2000],
            [['copias'], 'string', 'max' => 300],
            [['ruta_documento'], 'string', 'max' => 600],
            [['nombre_grupo'], 'string', 'max' => 255],
            [['fk_area'], 'exist', 'skipOnError' => true, 'targetClass' => Areas::className(), 'targetAttribute' => ['fk_area' => 'id_area']],
            [['fk_estado_documento'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoDocumento::className(), 'targetAttribute' => ['fk_estado_documento' => 'id_estado_documento']],
            [['fk_tipo_documento'], 'exist', 'skipOnError' => true, 'targetClass' => TipoDocumento::className(), 'targetAttribute' => ['fk_tipo_documento' => 'id_tipo_documento']],
            [['fk_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['fk_usuario' => 'id_usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_documento' => 'Id Documento',
            'codigo' => 'CITE',
            'destinatario_titulo' => 'Titulo',
            'destinatario_nombres' => 'Nombre destino',
            'destinatario_cargo' => 'Cargo destino',
            'destinatario_institucion' => 'Institución destino',
            'remitente_nombres' => 'Nombre remitente',
            'remitente_cargo' => 'Cargo remitente',
            'remitente_institucion' => 'Institución remitente',
            'referencia' => 'Referencia',
            'contenido' => 'Contenido documento',
            'fecha' => 'Fecha',
            'hora' => 'Hora',
            'adjuntos' => 'Adjuntos',
            'copias' => 'Copias',
            'via_nombres' => 'Nombre vía ',
            'via_cargo' => 'Cargo vía',
            'nro_hojas' => 'Nro Hojas',
            'gestion' => 'Gestion',
            'fecha_registro' => 'Fecha Registro',
            'hora_registro' => 'Hora Registro',
            'fk_usuario' => 'Fk Usuario',
            'fk_tipo_documento' => 'Fk Tipo Documento',
            'fk_estado_documento' => 'Estado de documento',
            'fk_area' => 'Fk Area',
            'fk_documento' => 'Fk Documento',
            'ruta_documento' => 'Ruta Documento',
            'activo' => 'Activo',
            'usuario_destino' => 'Usuario Destino',
            'grupo_destino' => 'Grupo Destino',
            'nombre_grupo' => 'Nombre Grupo',
            'fk_motivo' => 'Fk Motivo',
            'observado' => 'Observado',
            'enlace_nube' => 'Enlace Nube',
            'fk_regional_suic' => 'Fk Regional Suic',
            'fk_taller_suic' => 'Fk Taller Suic',
            'fk_orden_pago_suic' => 'Fk Orden Pago Suic',
            'carpeta_pago' => 'Carpeta Pago',
        ];
    }

    /**
     * Gets query for [[FkArea]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkArea()
    {
        return $this->hasOne(Areas::className(), ['id_area' => 'fk_area']);
    }

    /**
     * Gets query for [[FkEstadoDocumento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkEstadoDocumento()
    {
        return $this->hasOne(EstadoDocumento::className(), ['id_estado_documento' => 'fk_estado_documento']);
    }

    /**
     * Gets query for [[FkTipoDocumento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkTipoDocumento()
    {
        return $this->hasOne(TipoDocumento::className(), ['id_tipo_documento' => 'fk_tipo_documento']);
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
    
    
    public static function getObtenerNuri($id_documento){

	$connection= Yii::$app->db;

            $count = Hojasruta::find()->where([
		        'fk_documento'=> $id_documento,
                        'activo'=>1 ])->count();    

            if ($count>0) {

                            $row=$connection->createCommand("SELECT nur, oficial
                                                                       FROM hojas_ruta
                                                                       WHERE fk_documento=$id_documento
                                                                       AND activo=1

                                                                       ")->query()->read();

                            if ($row['oficial']==1) {

                            return "<i  class='fa fa-thumbs-o-up' style='font-size: 18px; color: #37484F;'></i> <i> Original</i><br>".$row['nur'];
                            }
                            else{
                                    return "<i>Copia</i><br>".$row['nur'];
                            }
            }
            else{
                    return "<b style='color:#37484F;'>Sin NUR/NURI</b>";
            }

    }// fin function


    public static function verificarasigandonuri($id_documento){

    $connection= Yii::$app->db;

            $count = Hojasruta::find()->where([
                'fk_documento'=> $id_documento,
                        'activo'=>1 ])->count();    

            if ($count>0) {
                    return true;                            
            }
            else{
                    return false;
            }

    }// fin function
    
    
    public static function getRowExplode($string,$delimiter){

	$row=explode($delimiter,$string);
	return $row;
    }
    
    public function getNameMonth($num){

		$meses=array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');

		return $meses[$num-1];
    }
    
    public static function getCodigo($gestion,$area,$tipo,$regional){


		// revisar codigo si no esta registrado el sistema deberia registrarlo
	 	$connection= Yii::$app->db;

        /*añadido */
        if ($area == 12) {
            $areaQuery = 1;
        } else {
            $areaQuery = $area;
        }
        /*fin añadido */

	 	$row=$connection->createCommand("SELECT correlativo
			 				   FROM correlativos
			 				   WHERE gestion=$gestion
			 				   AND fk_area=$areaQuery /*modificado*/
			 				   AND fk_regional=$regional
			 				   AND fk_tipo_documento=$tipo
			 				   AND activo=1
			 				   ")->query()->read();

	 	$correlativo=$row['correlativo'];
	 	$correlativo++;

	 	if (strlen($correlativo)==1) { $numero="000".$correlativo;	}
	 	if (strlen($correlativo)==2) { $numero="00".$correlativo;	}
	 	if (strlen($correlativo)==3) { $numero="0".$correlativo;	}
	 	if (strlen($correlativo)==4) { $numero=$correlativo;	    }

	 	$tipoDoc=TipoDocumento::findOne($tipo);
	 	// codigo para obtener la sigla del area
		$areas=Areas::findOne($areaQuery); //MODIFICADO
                //Agrupaciones::findOne
                        
		$codigo=$tipoDoc->sigla."/".$areas->cite."/".$gestion."-".$numero;

		// codigo para actualizar la tabla correlativos
		$connection->createCommand("UPDATE correlativos SET correlativo=$correlativo WHERE gestion=$gestion AND fk_area=$areaQuery AND fk_regional=$regional AND fk_tipo_documento=$tipo AND activo=1")->execute();

		return $codigo;

    }

    public function getNuri($gestion,$tipo){

	 	$connection= Yii::$app->db;

	 	$row=$connection->createCommand("SELECT correlativo
			 				   FROM correlativos
			 				   WHERE gestion='$gestion'
			 				   AND fk_tipo_documento='$tipo'
			 				   AND activo=1
			 				   ")->query()->read();

	 	$correlativo=$row['correlativo'];
	 	$correlativo++;

	 	if (strlen($correlativo)==1) { $numero="0000".$correlativo;	}
	 	if (strlen($correlativo)==2) { $numero="000".$correlativo;	}
	 	if (strlen($correlativo)==3) { $numero="00".$correlativo;	}
	 	if (strlen($correlativo)==4) { $numero="0".$correlativo;	}
	 	if (strlen($correlativo)==5) { $numero=$correlativo;	}

	 	$tipoDoc=TipoDocumento::findOne($tipo);
	 	// codigo para obtener la sigla del area
		$codigo=$tipoDoc->sigla."/".$gestion."-".$numero;

		// codigo para actualizar la tabla correlativos
		$connection->createCommand("UPDATE correlativos SET correlativo=$correlativo WHERE gestion=$gestion AND fk_tipo_documento=$tipo AND activo=1")->execute();

		return $codigo;

    }
    
    
    public static function getDocumentosporTipo(){
        
        $usuario=Yii::$app->user->identity->id_usuario;
        $gestion=date('Y');
        //$gestion=2021;

        $dataReader=Yii::$app->db->createCommand("SELECT * FROM documentos_tipo($usuario, $gestion)")->query();
        
        $array=array();
        $i=0;
        foreach ($dataReader as $row){ 
                        
            $total=$row['total_documentos'];
            $array[$i][0]=$row['tipo_documento'];
            $array[$i][1]=$row['porcentaje'];
            $i++;
        }
       return $array; 
    }
    
    public static function getNameTipoDocumento($id){

        $model = Tipodocumento::findOne($id);
	return $model->tipo_documento;
    }
    
    public function getNameRemitente(){

        if (Yii::$app->user->identity->fk_nivel==3 OR Yii::$app->user->identity->fk_nivel==1) {
            $id_usuario=Yii::$app->user->identity->id_usuario;
            
            $connection= Yii::$app->db;
            $row=$connection->createCommand("SELECT nombre, cargo
                			   FROM alias WHERE fk_usuario=$id_usuario AND activo=1")->query()->read();
            $nombre=ucwords(strtolower($row['nombre']));
            //$remitente_cargo=$row['cargo'];
	}
	else{
            $nombre=ucwords(strtolower(Yii::$app->user->identity->nombre));
            //$remitente_cargo=$remitente->cargo;
	}
        return $nombre;
    }
    
    public function getCargoRemitente(){

        if (Yii::$app->user->identity->fk_nivel==3 OR Yii::$app->user->identity->fk_nivel==1) {
            $id_usuario=Yii::$app->user->identity->id_usuario;
            
            $connection= Yii::$app->db;
            $row=$connection->createCommand("SELECT nombre, cargo
                			   FROM alias WHERE fk_usuario=$id_usuario AND activo=1")->query()->read();
            //$nombre=ucwords(strtolower($row['nombre']));
            $cargo=$row['cargo'];
	}
	else{
            //$nombre=ucwords(strtolower(Yii::$app->user->identity->nombre));
            $cargo=Yii::$app->user->identity->cargo;
	}
        return $cargo;
    }
    
    public static function getNuriAsignado($id_documento){
        
        $count = Hojasruta::find()->where([
		            'fk_documento'=>$id_documento,
		            'activo'=>1, ])->count();
        
        
        if($count>0){
            $model = Documentos::findOne($id_documento);
            $row=Yii::$app->db->createCommand("SELECT nur 
                                             FROM hojas_ruta 
                                             WHERE fk_documento=$model->id_documento 
                                               AND codigo='$model->codigo' 
                                                AND activo=1")->query()->read();
            return $row['nur'];
        }
        else{
            return "";
        }
       
        
        
    }
    
    public static function getCountChar($id_documento){
        
        $row=Yii::$app->db->createCommand("SELECT char_length(contenido) total_caracteres
                                         FROM documentos 
                                         WHERE id_documento=$id_documento 
                                        ")->query()->read();
        return $row['total_caracteres'];
        
        
    }
    
    public static function verificarAsignacionNURI($id_documento){
        
        $row=Yii::$app->db->createCommand("SELECT count(*) total
                                         FROM hojas_ruta 
                                         WHERE fk_documento=$id_documento 
                                            AND activo=1 
                                        ")->query()->read();
        return $row['total'];
        
        
    }
    
    
    public function countInformecartaexterna($nuri){
        
        $row=Yii::$app->db->createCommand("SELECT count(*) total
                                         FROM hojas_ruta h, documentos d 
                                         WHERE h.fk_documento=d.id_documento
                                         AND h.nur='$nuri' AND h.activo=1 AND h.nro=0 AND d.activo=1 AND d.fk_tipo_documento=1
                                        ")->query()->read();
        return $row['total'];  
    }
    
    public function getInformecartaexterna($nuri){
        
        $row=Yii::$app->db->createCommand("SELECT d.codigo 
                                         FROM hojas_ruta h, documentos d 
                                         WHERE h.fk_documento=d.id_documento
                                         AND h.nur='$nuri' AND h.activo=1 AND h.nro=0 AND d.activo=1 AND d.fk_tipo_documento=1 
                                         ORDER BY id_documento ASC LIMIT 1
                                        ")->query()->read();
        return $row['codigo'];  
    }
    
    public function getIdInformecartaexterna($nuri){
        
        $row=Yii::$app->db->createCommand("SELECT d.id_documento 
                                         FROM hojas_ruta h, documentos d 
                                         WHERE h.fk_documento=d.id_documento
                                         AND h.nur='$nuri' AND h.activo=1 AND h.nro=0 AND d.activo=1 AND d.fk_tipo_documento=1 
                                         ORDER BY id_documento ASC LIMIT 1
                                        ")->query()->read();
        return $row['id_documento'];  
    }
    
    
    public function verificarOrdenpago($nuri){
        
        $row=Yii::$app->db->createCommand("SELECT count(*) as total 
                                         FROM informacionsuic 
                                         WHERE nuri='$nuri' AND activo=1
                                        ")->query()->read();
        return $row['total'];  
    }
    
    
    public function cambiarfecha($vfecha)
    {
        $fch=explode("/",$vfecha);
        $tfecha=$fch[2]."-".$fch[1]."-".$fch[0];
        return $tfecha;
    }
    
    
    public function getHojasRuta($id_documento){
        
        $row=Yii::$app->db->createCommand("SELECT *
                                         FROM hojas_ruta 
                                         WHERE fk_documento=$id_documento 
                                            AND activo=1 AND nro=0
                                        ")->query()->read();
        return $row;  
    }
    
    public function getCountNurinuevo($nuri){
        
        $count = Seguimientos::find()->where([
		        'codigo'=> $nuri,
		        'oficial'=> 1,
                        'activo'=>1 ])->count(); 
        return $count;
    }
    
    public static function getdocumentoestado($estado){
        
        $count = Documentos::find()->where([
		        'gestion'=> date('Y'),
		        'fk_usuario'=> Yii::$app->user->identity->id_usuario,
		        'fk_estado_documento'=> $estado,
                        'activo'=>1 ])->count(); 
        return $count;
    }
    
    
    public function verificarDocumentoExterno($nuri){
        
        $row=Yii::$app->db->createCommand("SELECT count(*) as total
                                         FROM hojas_ruta h, documentos d 
                                         WHERE nur='$nuri' AND h.activo=1 AND d.activo=1
                                           AND h.fk_documento=d.id_documento AND d.fk_tipo_documento=7 
                                         
                                        ")->query()->read();
        return $row['total'];
        
    }
    
    public function getVisibleNuri($tipo_documento){
        
        if($tipo_documento==4){
            return false;
        }
        else{
            return true;
        }
    }
    
    public static function getDetalleSeguimiento($nuri){

        $row=Yii::$app->db->createCommand("SELECT proveido, derivado_a, fecha_derivacion, hora_derivacion
                                         FROM seguimientos 
                                         WHERE codigo='$nuri' AND activo=1 AND oficial!=0
                                         ORDER BY id_seguimiento ASC LIMIT 1    
                                        ")->query()->read();
        return $row;        
    }
    
    public static function getNameAreaDerivacion($id_usuario){

	 	$row=Yii::$app->db->createCommand("SELECT area
			 			   FROM usuarios u, areas a
			 			   WHERE u.id_usuario=$id_usuario
			 			   AND u.fk_area= a.id_area
     				   ")->query()->read();
	 	return $row['area'];
    }
    
    public static function getNameCopias($nuri){

	$dataReader=Yii::$app->db->createCommand("SELECT derivado_a
			 			FROM seguimientos
			 			WHERE codigo='$nuri' AND oficial=0 AND activo=1 ORDER BY id_seguimiento ASC ")->query();

		$copias='';
	 	foreach($dataReader as $row) {

                            
	 		$usuarios=Usuarios::findOne($row['derivado_a']);
	 		$area=$usuarios->fkArea->sigla;

	 		if ($copias=='') {
				$copias=$area;
	 		}
	 		else{
	 			$copias=$copias.','.$area;
	 		}

		}

	 	return '<b style="font-size:8px; font-weight: normal;">'.$copias.'</b>';
    }
    
    public static function getListTipoDocumento()
    {
        
        $sql="	SELECT id_tipo_documento, tipo_documento FROM tipo_documento WHERE id_tipo_documento in (1,2,3,4,5,8)";		
        //$result = Listaderivacion::findBySql($sql)->all();
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        //$listData = ArrayHelper::map($result, 'id_usuario_destino', 'nombre_destinatario');
        $listData = ArrayHelper::map($result, 'id_tipo_documento', 'tipo_documento');
        return $listData;
    }
    
    
    public static function getListEstadoDocumento()
    {
        
        $sql="	SELECT id_estado_documento, estado_documento FROM estado_documento WHERE id_estado_documento in (1,3,6)";		
        //$result = Listaderivacion::findBySql($sql)->all();
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        //$listData = ArrayHelper::map($result, 'id_usuario_destino', 'nombre_destinatario');
        $listData = ArrayHelper::map($result, 'id_estado_documento', 'estado_documento');
        return $listData;
    }
    
    public static function reporteCites($area, $gestion, $tipo_documento){

	$connection= Yii::$app->db;

        $command=$connection->createCommand("
            SELECT 
            COALESCE(NULLIF((select h.nur from hojas_ruta h where h.fk_documento=d.id_documento and h.activo=1 order by id_hoja_ruta asc limit 1 ),''),'S/N') as nuri,
            d.codigo cite,
            d.destinatario_titulo,
            d.destinatario_nombres,
            d.destinatario_cargo,
            d.via_nombres,
            d.via_cargo,
            d.referencia,
            d.fecha,
            d.adjuntos,
            d.copias,
            d.gestion,
            d.remitente_nombres,
            d.remitente_cargo,
            COALESCE(NULLIF((select a.area from areas a where a.id_area=d.fk_area ),''),'S/N') as area,
            COALESCE(NULLIF((select u.nombre from usuarios u where u.id_usuario=d.fk_usuario ),''),'S/N') as autor_nombre,
            COALESCE(NULLIF((select u.cargo from usuarios u where u.id_usuario=d.fk_usuario ),''),'S/N') as autor_cargo
            FROM documentos d
            WHERE d.activo=1 AND d.fk_area=$area AND d.gestion=$gestion AND d.fk_tipo_documento=$tipo_documento ORDER BY id_documento DESC

        ");
        $dataReader=$command->query();

        return $dataReader;

    }
    
    public function getListaderivacion(){
        
        $usuario=Yii::$app->user->identity->id_usuario;
        $area=Yii::$app->user->identity->fk_area;
        
        $command=Yii::$app->db->createCommand("SELECT *
                                                   FROM lista_derivacion l, usuarios u
                                                   WHERE l.activo=1 AND l.usuario_destino=u.id_usuario AND l.usuario_origen=$usuario ORDER BY l.id_lista_derivacion ASC 
                			   ");
        
        $dataReader=$command->query();
        return $dataReader;
          
    }
    
    public function insertNurHojaRuta($gestion, $id_documento, $cite){

		$hojasruta= new HojasRuta();
		$hojasruta->nur=Documentos::getNuriExterno($gestion);
		$hojasruta->codigo=$cite;
		$hojasruta->nro=0;
		$hojasruta->fecha=date('Y-m-d');
		$hojasruta->hora=date('H:i:s');
		$hojasruta->proceso=4;
		$hojasruta->fecha_registro=date('Y-m-d');
		$hojasruta->hora_registro=date('H:i:s');
		$hojasruta->fk_usuario=Yii::$app->user->identity->id_usuario;
		$hojasruta->gestion=$gestion;
		$hojasruta->fk_documento=$id_documento;
		$hojasruta->oficial=1;
		$hojasruta->activo=1;
		$hojasruta->save();
    }
    public function getNuriExterno($gestion){

	 	$connection= Yii::$app->db;
	 	$regional=Yii::$app->user->identity->fk_regional;
                
        /*$count = Ventanilla::find()->where([
                    'gestion' => $gestion,
                    'fk_regional' => $regional,
                    'activo' => 1])->count();
        if($count==0){*/
            $row=$connection->createCommand("SELECT id_ventanilla,correlativo,sigla
			 				   FROM ventanilla
			 				   WHERE gestion=$gestion
			 				   AND fk_regional =$regional
			 				   AND activo=1
			 				   ")->query()->read();
	 	$correlativo=$row['correlativo'];
	 	$id_ventanilla=$row['id_ventanilla'];
	 	$sigla=$row['sigla'];
	 	$correlativo++;

	 	if (strlen($correlativo)==1) { $numero="0000".$correlativo;	}
	 	if (strlen($correlativo)==2) { $numero="000".$correlativo;	}
	 	if (strlen($correlativo)==3) { $numero="00".$correlativo;	}
	 	if (strlen($correlativo)==4) { $numero="0".$correlativo;	}
	 	if (strlen($correlativo)==5) { $numero=$correlativo;	}

	 	//$tipoDoc=TipoDocumento::model()->findByPk($tipo);
	 	// codigo para obtener la sigla del area

	 	if ($regional==1) {
			$nuri=$gestion."-".$numero;
	 	}
	 	else{
			$nuri=$sigla."/".$gestion."-".$numero;
	 	}

	 	//echo "----> ".$id_ventanilla;

		// codigo para actualizar la tabla correlativos
		$connection->createCommand("UPDATE ventanilla SET correlativo=$correlativo WHERE id_ventanilla=$id_ventanilla AND activo=1")->execute();

		return $nuri;

    }
    
    public function getMotivo($id_motivo){
        
        $model = Motivos::findOne($id_motivo);
        
        return $model->motivo;
        
    }
    
    public function getidhojaruta($id_documento){
        
        $row=Yii::$app->db->createCommand("SELECT id_hoja_ruta
			 			   FROM hojas_ruta
			 			   WHERE fk_documento=$id_documento
			 			   AND activo=1
     				   ")->query()->read();
        
        return Hojasruta::findOne($row['id_hoja_ruta']);
        
    }
    
    public function getnumeronuri($id_documento){
        
        $row=Yii::$app->db->createCommand("SELECT nur
			 			   FROM hojas_ruta
			 			   WHERE fk_documento=$id_documento
			 			   AND activo=1
     				   ")->query()->read();
        
        return $row['nur'];
        
    }
    
    
    public function getMosca($id_usuario){
        
        $model = Motivos::findOne($id_motivo);
        
        $row=Yii::$app->db->createCommand("SELECT id_hoja_ruta
			 			   FROM hojas_ruta
			 			   WHERE fk_documento=$id_documento
			 			   AND activo=1
     				   ")->query()->read();
        
        return Hojasruta::findOne($row['id_hoja_ruta']);
        
    }
    
    public function getGestion(){

	$usuario=Yii::$app->user->identity->id_usuario;        

	$sql = "SELECT DISTINCT gestion FROM documentos";
  	$result = Yii::$app->db->createCommand($sql)->queryAll();

        return ArrayHelper::map($result,'gestion','gestion');
    }

    public function actualizarcitehojasruta($id_documento, $cite){
        
        $connection= Yii::$app->db;
        $regional=Yii::$app->user->identity->fk_regional;
        $connection->createCommand("UPDATE hojas_ruta SET codigo='$cite' WHERE fk_documento=$id_documento")->execute();
    }

    public static function countNURIsuic($nuri){

        $count = Informacionsuic::find()->where([
                                    'nuri'=> $nuri,
                                    'activo'=>1 ])->count();        

        return $count;


    } // fin function

    public function getDetalleTaller($nuri){

        $row=Yii::$app->db->createCommand("SELECT *
                                         FROM informacionsuic 
                                         WHERE nuri='$nuri' AND activo=1 ORDER BY id_informacion_suic ASC LIMIT 1    
                                        ")->query()->read();
        return $row;        
    }

    public static function mostrarhr($nuri){

        $count = Hojasruta::find()->where([
                                    'nur'=> $nuri,
                                    'nro'=> 0,
                                    'activo'=>1 ])->count();        

        if($count==1){
            
            $row=Yii::$app->db->createCommand("SELECT codigo FROM hojas_ruta WHERE nur='$nuri' AND activo=1  AND nro=0 ")->query()->read();
            return $row['codigo'];
        }
        else{
            
            $row2=Yii::$app->db->createCommand("SELECT codigo FROM hojas_ruta WHERE nur='$nuri' AND activo=1  AND nro=0 ORDER BY id_hoja_ruta DESC LIMIT 1 ")->query()->read();
            //return "<ul><li>".$row['codigo']."</li> <li>".$row2['codigo']."</li></ul>";
            return $row2['codigo']."</b>";
        }

    } // fin function


    public static function mostrarnuri($id_documento){

        $count = Hojasruta::find()->where([
                                    'fk_documento'=> $id_documento,
                                    'activo'=>1 ])->count();        

        if($count==1){
            
            $row=Yii::$app->db->createCommand("SELECT nur FROM hojas_ruta WHERE fk_documento=$id_documento AND activo=1 ")->query()->read();
            return "<br>NUR ".$row['nur'];
        }
        else{
            
            return "";
        }

    } // fin function
    
//#########################################################################
    // CONSULTA PARA INSERTAR DATOS EN LA BASE DE DATOS MONGODB
    public function consulta_documentos(){
        
        $command=Yii::$app->db->createCommand(" SELECT * FROM consulta_mongo order by id_documento");
        //$command=Yii::$app->db->createCommand(" SELECT * FROM documentos WHERE fk_usuario=3 and gestion=2022");
        
        $dataReader=$command->query();
        return $dataReader;
        
    }
    
    
    
        
} //FIN CLASS
