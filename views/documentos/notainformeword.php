<?php

namespace app\models;

use app\models\Hojasruta;
use app\models\Documentos;

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use Yii;


$nombre_archivo = str_replace("_", "/", $documentos->codigo);
?>

<head>
    <script type="text/javascript" src="./js/jquery.js"></script>
    <script src="./js/FileSaver.js"></script>
    <script src="./js/jquery.wordexport.js"></script>
    <script>
        jQuery(document).ready(function($) {
            //$("#btnWordExport").click(function (event) {
            $("#page-content1").wordExport('<?= $nombre_archivo ?>');
            //});

            $("#btnWordExport").click(function(event) {
                $("#page-content1").wordExport('<?= $nombre_archivo ?>');
            });
        });
    </script>
</head>

<?php
switch ($documentos->fk_tipo_documento) {
    case 1:
        $tipo = 'INFORME';
        break;
    case 2:
        $tipo = 'NOTA INTERNA';
        break;
    case 3:
        $tipo = 'MEMORANDUM';
        break;
    case 4:
        $tipo = 'CARTA';
        break;
    case 5:
        $tipo = 'CIRCULAR';
        break;
}
//if ($id_hoja_ruta!=0) {
//$hojasruta=HojasRuta::model()->findByPk($id_hoja_ruta);
$hojasruta = Documentos::getidhojaruta($documentos->id_documento);
//}
?>

<!--#####################################################################-->

<!doctype html>
<html>

<body>
    <div class="headerContent no-print">
        <table class='no-print' style="width:60%">
            <tr>
                <td>
                    <input type="button" id="btnWordExport" value="Generar WORD" class='no-print btn btn-primary active'>
                    <?php
                    if ($documentos->fk_tipo_documento == 1) { ?>

                        <a class="btn btn-danger active" href="index.php?r=documentos/updateinforme&id=<?= $documentos->id_documento ?>" style="color: white;">Atras</a>

                    <?php
                    } else { ?>

                        <a class="btn btn-danger active" href="index.php?r=documentos/updatenotainterna&id=<?= $documentos->id_documento ?>" style="color: white;">Atras</a>


                    <?php }

                    ?>
                    <!--<a class="btn btn-danger active" href="index.php?r=documentos/updateinforme&id=<?= $documentos->id_documento ?>" style="color: white;">Atras</a>-->
                </td>
            </tr>
        </table>
        <br>
    </div>

    <!-- ------------ HTML Content With Header and Footer in document ------------- -->
    <!-- IMAGEN PARA MOSTRAR EN LA PAGINA WEB, LA PREVISUALIZACION-->
    <div style="background: white; border: solid 0.1em #474747; box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75); padding: 1cm 3cm; width:21.5cm; ">
        <div class="encabezado" style='clear:both;'>
            <img align="center" src='./images/encabezado_presidencia_estado.png' crossOrigin='Anonymous' style="width: 80%; height: auto; left:0;">
        </div>

        <!--<img align="center" src='./images/logo_gnv.png' crossOrigin='Anonymous' width="225px" height="80px" style="position:absolute; margin-left:0.1cm;">-->

        <div id="page-content1" style="background-image: url('./images/fondo_doc_presidencia.png'); background-size: contain; background-position: center; background-repeat: no-repeat">
            <html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns:m="http://schemas.microsoft.com/office/2004/12/omml" xmlns="http://www.w3.org/TR/REC-html40">

            <head>
                <meta http-equiv=Content-Type content="text/html; charset=utf-8">
                <title></title>
                <style>
                    v\:* {
                        behavior: url(#default#VML);
                    }

                    o\:* {
                        behavior: url(#default#VML);
                    }

                    w\:* {
                        behavior: url(#default#VML);
                    }

                    .shape {
                        behavior: url(#default#VML);
                    }
                </style>
                <style>
                    @page {
                        mso-page-orientation: portrait;
                        size: 21.59cm 27.94cm;
                        /* mso-page-orientation:portrait;
                            size: 29.7cm 21cm;*/
                        /* margin: arriba derecha abajo izquierda*/
                        /*   margin: 4cm 3cm 4cm 5cm;*/
                        margin: 2.5cm 3cm 2.5cm 3cm;
                        /* top right bottom left */
                        padding: 0;
                    }

                    @page Section1 {
                        mso-header-margin: .4in;
                        mso-footer-margin: 0cm;
                        mso-header: h1;
                        mso-footer: f1;
                        mso-paper-source: 0;
                    }

                    div.Section1 {
                        page: Section1;
                        margin: 0;
                    }

                    table#hrdftrtbl {
                        margin: 0in 0in 0in 900in;
                        width: 1px;
                        height: 1px;
                        overflow: none;
                    }

                    /*p.MsoFooter,
                    li.MsoFooter,
                    div.MsoFooter {
                        margin: 0in;
                        margin-bottom: 0pt;
                        mso-pagination: widow-orphan;
                        tab-stops: center 3.0in right 6.0in;
                        font-size: 12.0pt;
                    }*/

                    /* codigo para el contenido del documento*/
                    #printsplit1,
                    #page-content1 {
                        /* margin: arriba derecha abajo izquierda*/
                        /*margin: 1cm 1cm 3cm 0cm;*/
                        /* margenes para el contenido del documentos*/
                        font-family: Century Gothic;
                        /*border: 1px;*/
                        width: 100%;
                        font-size: 10.0pt;
                    }
                </style>
                <xml>
                    <w:WordDocument>
                        <w:View>.</w:View>
                        <w:Zoom>.</w:Zoom>
                        <w:DoNotOptimizeForBrowser />
                    </w:WordDocument>
                </xml>
            </head>

            <body>

                <div class="Section1" style="margin: 0; padding: 0;">
                    <p>
                        <!-----Export body ------>
                    <div id="printsplit1" style="padding: 0; margin: 0;">
                        <div id="perintbodyContent1" style="font-family:Century Gothic;" style="margin: 0; padding: 0;">
                            <center>
                                <b style="font-family:Arial; font-size:20.0pt;"><?= $tipo ?></b><br>
                                <b style="font-family:Arial; font-size:11.0pt;"><?= $documentos->codigo ?></b><br>
                                <b style="font-family:Arial; font-size:11.0pt;"><?php echo $hojasruta->nur; ?></b>
                            </center>
                            <br><br>
                            <span style="font-size: 11.0pt; font-family: Century Gothic;">
                                <b>A&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                            </span>
                            &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span style="font-size: 11.0pt; font-family: Century Gothic;">
                                <?= ucwords(strtolower($documentos->destinatario_nombres)); ?><br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <b><?= $documentos->destinatario_cargo; ?></b>
                            </span>

                            <?php
                            //echo '<p></p>';
                            if ($documentos->via_nombres != null or $documentos->via_nombres != "") {
                                echo "<p></p><br>";
                                $row_via = Documentos::getRowExplode($documentos->via_nombres, ';');
                                $row_cargo_via = Documentos::getRowExplode($documentos->via_cargo, ';');

                                for ($i = 0; $i < count($row_via); $i++) {
                            ?>
                                    <?php
                                    if ($i == 0) { ?>
                                        <span style="font-size: 11.0pt; font-family: Century Gothic;"><b>V&Iacute;A&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <?php
                                    } else { ?>
                                        <span style="font-size: 11.0pt; font-family: Century Gothic;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <?php
                                    }
                                    ?>
                                    <span style="font-size: 11.0pt; font-family: Century Gothic;">
                                        <?= ucwords(strtolower($row_via[$i])); ?><br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <b><?= $row_cargo_via[$i]; ?></b>
                                    </span>
                                    <p></p>

                            <?php
                                } //for($i=0; $i<count($row_via); $i++)
                            }
                            ?>

                            <p></p><br>
                            <span style="font-size: 11.0pt; font-family: Century Gothic;"><b>DE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span style="font-size: 11.0pt; font-family: Century Gothic;">
                                <?= ucwords(strtolower($documentos->remitente_nombres)); ?><br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <b><?= $documentos->remitente_cargo; ?></b>
                            </span>
                            <p></p><br>

                            <span style="font-size: 11.0pt; font-family: Century Gothic;">
                                <b>REF</b>&nbsp;&nbsp;&nbsp;&nbsp; </span>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;
                            <span style="font-size: 11.0pt; font-family: Century Gothic;">
                                <b style="text-transform: uppercase;">&nbsp;&nbsp;&nbsp;<?= $documentos->referencia; ?></b>
                            </span>
                            <p></p><br>

                            <span style="font-size: 11.0pt; font-family: Century Gothic;"><b>FECHA</b></span>
                            &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span style="font-size: 11.0pt; font-family: Century Gothic;">
                                <?php
                                $row_mes = Documentos::getRowExplode($documentos->fecha, '-');
                                $name_mes = Documentos::getNameMonth($row_mes[1]);
                                echo $documentos->fkUsuario->fkRegional->descripcion . ", " . $row_mes[2] . " de " . $name_mes . " de " . $row_mes[0];
                                ?>
                            </span>
                            <hr style="color: black;  height: 1.5pt;">

                            <!-- CODIGO PARA MOSTRAR EL CONTENIDO DEL DOCUMENTO-->
                            <span style="font-family: Century Gothic !important; font-size: 11.0pt; text-align: justify; ">
                                <?= $documentos->contenido; ?>
                            </span>

                            <!--<center>
                                <span style="font-size: 10.0pt; font-family: Bookman Old Style;" >
                                    <p><br></p><p></p><p></p><p></p>
                                    <?php //echo ucwords(strtolower($documentos->remitente_nombres)); 
                                    ?><p></p>
                                    <b><?php //echo $documentos->remitente_cargo;
                                        ?></b>
                                </span>
                            </center>-->

                            <p><br></p>

                            <span style="font-size: 6pt; font-family: Century Gothic;"><?= rtrim($documentos->fkUsuario->mosca) ?></span>

                            <?php
                            if (trim($documentos->copias) != "") {
                            ?>
                                <span style="font-size: 7pt; font-family: Century Gothic;">
                                    C.C.<?= trim($documentos->copias) ?>
                                </span>
                                <p></p>
                            <?php
                            } //if () 
                            ?>

                            <?php
                            if (trim($documentos->adjuntos) != "") {
                            ?>
                                <span style="font-size: 7pt; font-family: Century Gothic;">
                                    Adj.<?= trim($documentos->adjuntos) ?>
                                </span>
                            <?php
                            } //if () 
                            ?>
                        </div>
                    </div>

                    <!--nueva estructura contenido
                    <div id="page-content1">
                        Cabecera
                        <div class="header" style='clear:both;'>
                            <img src="./images/encabezado_presidencia_estado.png" alt="Cabecera" style="width: 70%; height: auto; left:0;">
                        </div>

                        Contenido
                        <div class="content">
                            <h1><?php //$tipo 
                                ?></h1>
                            <p>Este es un documento generado dinámicamente con Yii2 y exportado a Word.</p>
                        </div>

                        Pie de página 
                        <div class="footer">
                            <img id="img_footer" src="./images/pie_pagina_bicentenario_texto.png" alt="Pie de Página">
                        </div>
                    </div>-->

                    <!--fin nueva estructura contenido-->


                    <!-----End Export body ------>
                    </p>

                    <table id='hrdftrtbl' border='0' cellspacing='0' cellpadding='0'>
                        <tr>
                            <td>
                                <!-- HEADER-tags -->
                                <div style='mso-element:header;' id=h1>
                                    <p class=MsoHeader>
                                    <table border="0" cellpadding="0" cellspacing="0" style="margin-left: 0cm;">
                                        <tr>
                                            <td width="100%" align="left" style="position: absolute;">

                                                <img src='./images/encabezado_presidencia_estado.png' crossOrigin='Anonymous' width="408" height="104">

                                                <!--<img align="center" src='./images/logo_gnv.png' crossOrigin='Anonymous' width="355px" height="110px" style="position:absolute; margin-left:-2cm;">-->
                                            </td>

                                        </tr>
                                    </table>
                                    </p>
                                </div>
                                <!-- end HEADER-tags -->
                            </td>
                            <td>
                                <!-- FOOTER-tags -->
                                <div style='mso-element:footer' id=f1>
                                    <p class=MsoFooter>
                                    <table border="0" cellpadding="0" cellspacing="0" style="margin-left: 0cm; margin-bottom: 0.5cm; margin-top: 0cm;">
                                        <tr>
                                            <td width="100%" align="left" style="position: absolute;">

                                                <img src='./images/pie_pagina_presidencia_estado.png' crossOrigin='Anonymous' width="584" height="107">

                                            </td>

                                        </tr>
                                    </table>
                                    </p>
                                </div>
                                <!-- en FOOTER-tags -->

                                <!--<div style='mso-element:footer' id=f1 >
                                        <div style="margin-left: 0.1cm; width: 100%;" >
                                            <div style="font-size: 8px; width: 100%; color: black; background: white;">

                                                <hr style="color: black; height: 0.4pt;" >
                                                <center>
                                                    MINISTERIO DE HIDROCARBUROS Y ENERGIAS - ENTIDAD EJECUTORA DE CONVERSION A GAS NATURAL VEHICULAR<br>
                                                    CALLE CAMPOS Nº 233, ENTRE AV. ARCE Y AV. 6 DE AGOSTO Telf: 2146398<br>
                                                    www.hidrocarburos.gob.bo– www.eecgnv.gob.bo<br>
                                                </center>
                                                <img align="center" src='<?php //echo Yii::app()->request->baseUrl;
                                                                            ?>/images/pie_pagina_gnv.jpg' crossOrigin='Anonymous' style=" position:absolute;  margin-left:-3cm;">
                                            </div>
                                        </div>
                                    </div>

                                    <div style='mso-element:footer' id=ff1 style="color: white; background: white; ">
                                        <p class=MsoFooter>
                                            <span lang=EN-US style='mso-ansi-language:EN-US;'>
                                                <div></div><o:p></o:p>
                                            </span>
                                        </p>
                                    </div>
                                    
                                    <div style='mso-element:header' id=fh1>
                                        <p class=MsoHeader>
                                            <span lang=EN-US style='mso-ansi-language:EN-US'>&nbsp;<o:p></o:p></span>
                                        </p>
                                    </div>
                                    <div style='mso-element:footer' id=ff1>
                                        <p class=MsoFooter>
                                            <span lang=EN-US style='mso-ansi-language:EN-US'>&nbsp;<o:p></o:p></span>
                                        </p>
                                    </div>-->
                            </td>
                        </tr>
                    </table>
                </div>
            </body>

            </html>
        </div>

        <div class="pie_pagina" style='clear:both;'>
            <img align="center" src='./images/pie_pagina_presidencia_estado.png' crossOrigin='Anonymous' style="width: 100%; height: auto; left:0;">
        </div>

    </div>
</body>

</html>
