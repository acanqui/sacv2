<?php

use yii\helpers\Html;
use app\models\Seguimientos;
/* @var $this yii\web\View */
/* @var $model app\models\Seguimientos */

$this->title = 'Create Seguimientos';
$this->params['breadcrumbs'][] = ['label' => 'Seguimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//echo $valor;
//echo "<br>";

$array = explode(",", $valor);

/*
echo "<br>".$array[0]; // piece1
echo "<br>".$array[1];
echo "<br><br><br> numero ".count($array);
*/

if($checkbox=="SI"){
    $background="background:white;";
    $color="color: white;";        
}
else{
    $background="";
    $color="";
}

?>

<table align="center" class="tabla_agrupacion" width="100%" cellspacing="0" cellpadding="6" >
    <thead>
	<tr style="font-size: 10px; background-color: #E1E1E1; padding:6px; <?=$background?>">
            <th align="center" style="font-size: 10px; <?=$color?>">N.</th>
            <th align="center" style="font-size: 10px; <?=$color?>">NUR/NURI</th>
            <th align="center" style="font-size: 10px; <?=$color?>">REFERENCIA | PROVE&Iacute;DO</th>
            <th align="center" style="font-size: 10px; <?=$color?>">PROCEDENCIA | REMITENTE</th>
            <th align="center" style="font-size: 10px; <?=$color?>">DERIVADO A</th>
            <th align="center" style="font-size: 10px; <?=$color?>">FECHA/HORA DERIVACI&Oacute;N</th>
            <th align="center" style="font-size: 10px;">SELLO RECEPCI&Oacute;N UNIDAD/&Aacute;REA</th>  
            <th align="center" style="font-size: 10px;">V°B° RESPONSABLE RECEPCI&Oacute;N</th>  	
	</tr>
    </thead>
 <tbody>
<?php
/*for($i=0; $i<count($array); $i=$i+2){
    //echo "<br>".$i;
    //echo "<br> -->".$array[$i];
    //echo "<br> -->".$array[$i];
    
}*/

//foreach($array as $val){
$j=0;
for($i=0; $i<count($array); $i++){
$j++;    
   //if($array[$i]>10){
    
    if(($i+1)<count($array)){
        if($array[$i+1]>10){   
       
            $model = Seguimientos::findOne($array[$i+1]);
            $fila=Seguimientos::getObtenerReferenciaRemitente($model->codigo);
            //echo "<br>".$array[$i];
            ?>

                <tr style="font-size: 9px; ">
                    <td style="font-size: 10px; border-right: solid 1px lightgrey; border-bottom: 0.05em solid #1C1C1C;"><?=$j?></td>
                        <td align="center" style="font-size: 10px; border-bottom: 0.05em solid #1C1C1C;">
                            <?php if ($model->oficial==1) { 	 
                                    $tipo_documento='ORIGINAL';
                            ?>
                            <img src="./images/manito.jpg" width="20px" height="20px" ><br>
                            <?php } 
                            else{ $tipo_documento='COPIA'; }
                            ?>
                                    <i style="font-size: 7px; font-weight: bold; text-align: center;" ><?=$tipo_documento?></i><br>
                                    <?=$model->codigo?>
                        </td>
                        <td style="font-size: 9px; border-bottom: 0.05em solid #1C1C1C;">
                          <?=$fila['referencia']?><br>		
                          <b>PROVE&Iacute;DO: </b><?=$model->proveido?>
                        </td>

                        <td style="font-size: 9px; border-bottom: 0.05em solid #1C1C1C;">
                          <?=$fila['remitente_nombres']?><br>		
                          <b><i><?=$fila['remitente_cargo']?></i></b>
                        </td>
                        <td style="font-size: 9px; border-bottom: 0.05em solid #1C1C1C;" align="left"><?=$model->derivadoA->fkArea->sigla?>: <?=$model->derivadoA->nombre?></td>
                        <td style="font-size: 9px; border-bottom: 0.05em solid #1C1C1C;" align="center"><?=date("d/m/Y", strtotime($model->fecha_derivacion))."<br> ".$model->hora_derivacion?></td>
                        <td style="width:20%; border-bottom: 0.05em solid #1C1C1C;">
                            <br><br><br><br><br><br>
                        </td>
                        <td style="width:10%; border-bottom: 0.05em solid #1C1C1C;"><br><br><br><br><br><br><br></td>
                </tr>
            <?php
            $i++;
        } //end if  
       else{
           
           ?>

           <tr  style="font-size: 9px; border: .3px solid #1C1C1C; border: solid 0px white;">
               <td align="center" style="font-size: 10px;"></td>
               <td style="font-size: 9px;"></td>
               <td style="font-size: 9px;"></td>
               <td style="font-size: 9px;"></td>
               <td style="font-size: 9px;" align="left"></td>
               <td style="font-size: 9px;" align="center"></td>
               <td style="width:20%;"><br><br><br><br><br><br></td>
               
           </tr>

        <?php      
           
           
       } 
    } // end if
    
   
    
} // end for
?>
    </tbody>
</table>