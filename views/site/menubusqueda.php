<?php
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use miloschuman\highcharts\Highcharts;
/* @var $this yii\web\View */

use app\models\Seguimientos;

use kartik\tabs\TabsX;
use yii\helpers\Url;

$this->title = '';
?>
<?php //echo "--------> ".Yii::$app->request->baseUrl ?>

<!--<link href="<?php //= Yii::$app->request->baseUrl ?>/css/estilos.css" rel="stylesheet" type="text/css">-->
<style>

.a-box {
  display: inline-block;
  width: 100px;
  text-align: center;
  
}


.inner-skew {    
    display: inline-block;
    border-radius: 5px;
    overflow: hidden;
    padding: 0px;
    /*transform: skew(0deg, 13deg);*/
    /*font-size: 0px;*/
    margin: 10px 1px 0px 0px;
    background: #ECF0F5;
    color:#222D32;
    
    /*height: 250px;
    width: 200px;*/
}

.img-container {
    
    height: 150px;
    /*width: 200px;*/
    overflow: hidden;
    border-radius: 0px 0px 20px 20px;
    display: inline-block;
    /*border: solid #BFBFC1 1px;*/
    
}

.img-container img {
    transform: skew(0deg, -13deg);
    height: 250px;
    margin: -35px 0px 0px -70px;
}



.text-container {
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
  padding: 30px 20px 20px 20px;
  border-radius: 20px;
  background: #fff;
  margin: -120px 0px 0px 0px;
  line-height: 19px;
  font-size: 14px;
  border: solid #BFBFC1 1px;
  box-shadow: 0px 10px 10px black;
  
}
.text-container:hover {
    box-shadow: 0px 10px 10px #37484F;
    background: #EDEDF0;
}



.text-container h3 {
  margin: 20px 0px 10px 0px;
  /*color: #04bcff;*/
  color: black;
  font-size: 15px;
}
        
</style>



<center>
    <span style="font-size: 16pt;"><b>
        <i class="glyphicon glyphicon-zoom-in" style="font-size:30pt;" ></i>    
            Opciones de B&uacute;squeda
    </b></span><br>
</center><br>    
 

<center>
    <a href="index.php?r=site/busquedageneral" style="text-decoration: none;"> 
    <div class="a-box" style="width: 130px;">
        <div class="img-container">
          <div class="img-inner">
            <div class="inner-skew">
                <span class="fa fa-search-plus" style="font-size:45pt;"></span>  
            </div>
          </div>
        </div>
        <div class="text-container" style="text-align: center;">
            
            <h3>B&uacute;squeda<br>Documentos</h3>
            
        </div>
    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </a>
    
    <!--
    <a href="index.php?r=seguimientos/pendientescopias" style="text-decoration: none;"> 
    <div class="a-box">
        <div class="img-container">
          <div class="img-inner">
            <div class="inner-skew">
                <span class="fa fa-file-text" style="font-size:45pt;"></span>  
            </div>
          </div>
        </div>
        <div class="text-container">
            <h3>B&uacute;squeda<br> Contenido</h3>
        </div>
    </div>
    </a> -->   
    
</center>

<br>
<hr style="width:80%; background:#70777A;">

<center>
    <a href="index.php?r=site/busquedasintesis" style="text-decoration: none;"> 
        <div class="a-box" style="width: 110px;">
            <div class="img-container">
              <div class="img-inner">
                <div class="inner-skew">
                    <span class="fa fa-file-text-o" style="font-size:45pt;"></span>  
                </div>
              </div>
            </div>
            <div class="text-container" style="text-align: center;">
                
                <h3><br>S&iacute;ntesis<br></h3>
                
            </div>
        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </a>

    <a href="index.php?r=site/busquedanameremitente" style="text-decoration: none;"> 
        <div class="a-box" style="width: 110px;">
            <div class="img-container">
              <div class="img-inner">
                <div class="inner-skew">
                    <span class="fa fa-user" style="font-size:45pt;"></span>  
                </div>
              </div>
            </div>
            <div class="text-container" style="text-align: center;">
                
                <h3>Nombre<br>Remitente</h3>
                
            </div>
        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </a>

    <a href="index.php?r=site/busquedacite" style="text-decoration: none;"> 
        <div class="a-box" style="width: 110px;">
            <div class="img-container">
              <div class="img-inner">
                <div class="inner-skew">
                    <span class="fa fa-sort-numeric-asc" style="font-size:45pt;"></span>  
                </div>
              </div>
            </div>
            <div class="text-container" style="text-align: center;">
                
                <h3><br><b>CITE</b><br></h3>
                
            </div>
        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </a>

    <a href="index.php?r=site/busquedareferencia" style="text-decoration: none;"> 
        <div class="a-box" style="width: 110px;">
            <div class="img-container">
              <div class="img-inner">
                <div class="inner-skew">
                    <span class="fa fa-align-center" style="font-size:45pt;"></span>  
                </div>
              </div>
            </div>
            <div class="text-container" style="text-align: center;">
                
                <h3><br>Referencia<br></h3>
                
            </div>
        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </a>

    <a href="index.php?r=site/busquedainstitucionremitente" style="text-decoration: none;"> 
        <div class="a-box" style="width: 110px;">
            <div class="img-container">
              <div class="img-inner">
                <div class="inner-skew">
                    <span class="fa fa-building-o" style="font-size:45pt;"></span>  
                </div>
              </div>
            </div>
            <div class="text-container" style="text-align: center;">
                
                <h3>Instituci&oacute;n<br>Remitente</h3>
                
            </div>
        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </a>

    
       
</center>
