<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lista_derivacion".
 *
 * @property int $id_lista_derivacion
 * @property int $activo
 * @property int $usuario_origen
 * @property int $usuario_destino
 *
 * @property Usuarios $usuarioOrigen
 * @property Usuarios $usuarioDestino
 */
class Listaderivacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lista_derivacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activo', 'usuario_origen', 'usuario_destino'], 'default', 'value' => null],
            [['activo', 'usuario_origen', 'usuario_destino'], 'integer'],
            [['usuario_origen', 'usuario_destino'], 'required'],
            [['usuario_origen'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuario_origen' => 'id_usuario']],
            [['usuario_destino'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuario_destino' => 'id_usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_lista_derivacion' => 'Id Lista Derivacion',
            'activo' => 'Activo',
            'usuario_origen' => 'Usuario Origen',
            'usuario_destino' => 'Usuario Destino',
        ];
    }

    /**
     * Gets query for [[UsuarioOrigen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioOrigen()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'usuario_origen']);
    }

    /**
     * Gets query for [[UsuarioDestino]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioDestino()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'usuario_destino']);
    }
    
    
    public function getNameDestino($id_usuario){
        $usuario=Yii::$app->user->identity->id_usuario;   
        
	$row=Yii::$app->db->createCommand("select 

                                    (CASE
					WHEN u.fk_nivel=1 THEN
                                            COALESCE(NULLIF((select a.nombre from alias a where a.fk_usuario=u.id_usuario AND a.activo=1 order by id_alias desc limit 1),''),'S/N')
                                        WHEN u.fk_nivel=3 THEN
                                            COALESCE(NULLIF((select a.nombre from alias a where a.fk_usuario=u.id_usuario AND a.activo=1 order by id_alias desc limit 1),''),'S/N')    
					ELSE
                                            u.nombre 
                                    END) nombre,
                                    u.cargo


                                 from usuarios u 
                                 where u.id_usuario=$id_usuario ")->query()->read();
        
        return $row['nombre']."<br> <b>(".$row['cargo'].")</b>";                         
        
    }
    
    
} //FIN CLASS
