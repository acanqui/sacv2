<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Usuarios;
use app\models\Hojasruta;
use app\models\Ventanilla;
use app\models\Seguimientos;
use app\models\Documentos;
use app\models\ReporteCompletoSearch;
use app\models\ReporteSemestralNurSearch;
use app\models\ReporteSemestralNuriSearch;
use kartik\mpdf\Pdf;
use yii\helpers\Html;

use yii\web\HttpException;

use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class ReporteController extends Controller
{
    /**
     * Lists all Seguimientos models.
     * @return mixed
     */

    public function actionReportecompleto($id)
    {
        return $this->render('reportecompleto', [
            'id' => $id,
        ]);
    }

    public function actionReportesemestralnur()
    {
        if (Yii::$app->user->identity->id_usuario != 110) {
            throw new \yii\web\HttpException(419, 'No autorizado');
        }

        /*$searchModel = new ReporteSemestralNurSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('reportesemestralnur', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/

        // Lista de usuarios "ventanilla-"
        $usuarios = Usuarios::find()
            ->where(['like', 'usuario', 'ventanilla'])
            ->orderBy('usuario')
            ->all();

        return $this->render('reportesemestralnur', [
            'usuarios' => $usuarios,
        ]);
    }

    public function actionReportesemestralnuri()
    {
        if (Yii::$app->user->identity->id_usuario != 110) {
            throw new \yii\web\HttpException(419, 'No autorizado');
        }

        /*$searchModel = new ReporteSemestralNuriSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 10;*/

        // Lista de usuarios "ventanilla-"
        $usuarios = Usuarios::find()
            ->where(['not like', 'usuario', 'ventanilla'])
            ->andWhere(['activo' => 1])
            ->orderBy('nombre')
            ->all();
       
        return $this->render('reportesemestralnuri', [
            /*'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,*/
             'usuarios' => $usuarios,
        ]);
    }

    public function actionPdfcompleto()
    {
        $searchModel = new ReporteCompletoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $content = $this->renderPartial('completo_pdf', [
        'dataProvider' => $dataProvider,
        ]);

        $pdf = new \Mpdf\Mpdf();
        $pdf->WriteHTML($content);
        $pdf->Output('reporte_completo.pdf', \Mpdf\Output\Destination::INLINE);
        exit;
    }

    public function actionPdfsemestral()
    {
        // 1. Usar el mismo modelo de búsqueda para aplicar los filtros recibidos
        $searchModel = new ReporteSemestralNurSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // 🔹 Deshabilitar paginación para obtener todos los registros
        $dataProvider->pagination = false;

        // 🔹 Forzar orden descendente por fecha_registro
        $dataProvider->query->orderBy(['fecha_registro' => SORT_DESC]);

        // 2. Renderizar la vista parcial (solo el contenido que irá al PDF)
        $content = $this->renderPartial('semestral_pdf', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        // 3. Configurar el PDF
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE,
            'format' => Pdf::FORMAT_LETTER,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_DOWNLOAD, // puedes usar Pdf::DEST_BROWSER si quieres mostrarlo
            'filename' => 'reporte_semestral.pdf',
            'marginLeft' => 10,
            'marginRight' => 10,
            'marginTop' => 25,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => 'table { font-size: 10pt; border-collapse: collapse; width: 100%; } 
                        th, td { border: 0.5px solid #555; padding: 4px; text-align: left; } 
                        th { background: #f0f0f0; }',
            'options' => ['title' => 'Reporte Semestral'],
            'methods' => [
                'SetHeader' => ['<table width="100%">
                    <tr>
                        <td width="33%"><img src="./images/logo_gnv.png" style="width:150px; height:50px;"></td>
                        <td width="33%" align="center"><b>Reporte Semestral</b></td>
                        <td width="33%" align="right">Fecha: ' . date('d/m/Y') . '</td>
                    </tr>
                </table>'],
                'SetFooter' => ['<table width="100%" style="border-top: 1px solid #000;">
                    <tr>
                        <td width="50%">Sistema SAC</td>
                        <td align="right">{PAGENO}/{nbpg}</td>
                    </tr>
                </table>'],
            ]
        ]);

        // 4. Renderizar el PDF
        return $pdf->render();
    }

    public function actionExcelsemestral()
    {
        $searchModel = new ReporteSemestralNurSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // Deshabilitar paginación y ordenar
        $dataProvider->pagination = false;
        $dataProvider->query->orderBy(['fecha_registro' => SORT_DESC]);

        $models = $dataProvider->getModels();

        // Cabeceras con UTF-8
        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        header("Content-Disposition: attachment;filename=\"reporte_semestral.xls\"");
        header("Cache-Control: max-age=0");

        // BOM UTF-8
        echo "\xEF\xBB\xBF";

        // Renderizar vista
        return $this->renderPartial('semestral_excel', [
            'models' => $models,
        ]);
    }

    //recursos reporte NURI
    public function actionPdfsemestralnuri()
    {
        // 1. Usar el mismo modelo de búsqueda para aplicar los filtros recibidos
        $searchModel = new ReporteSemestralNuriSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // 🔹 Deshabilitar paginación para obtener todos los registros
        $dataProvider->pagination = false;

        // 🔹 Forzar orden descendente por fecha_registro
        $dataProvider->query->orderBy(['fecha_registro' => SORT_DESC]);

        // 2. Renderizar la vista parcial (solo el contenido que irá al PDF)
        $content = $this->renderPartial('semestral_pdf_nuri', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        // 3. Configurar el PDF
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE,
            'format' => Pdf::FORMAT_LETTER,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_DOWNLOAD, // puedes usar Pdf::DEST_BROWSER si quieres mostrarlo
            'filename' => 'reporte_nuri.pdf',
            'marginLeft' => 10,
            'marginRight' => 10,
            'marginTop' => 25,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => 'table { font-size: 10pt; border-collapse: collapse; width: 100%; } 
                        th, td { border: 0.5px solid #555; padding: 4px; text-align: left; } 
                        th { background: #f0f0f0; }',
            'options' => ['title' => 'Reporte NURI'],
            'methods' => [
                'SetHeader' => ['<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;">
                    <tr>
                        <td width="33%"><img src="./images/logo_gnv.png" style="width:200px; height:60px;"></td>
                        <td width="33%" align="center"></td>
                        <td width="33%" align="right" style="font-style: italic;" valign="middle">Entidad Ejecutora de Conversión a Gas Natural Vehícular<br>Fecha: ' . date('d/m/Y') . '</td>
                    </tr>
                </table>'],
                'SetFooter' => ['<table width="100%" style="border-top: 1px solid; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;">
                    <tr>
                        <td width="50%" style="font-style: italic;">Sistema de Administración de Correspondencia</td>
                        <td>{PAGENO}/{nbpg}</td>
                        <td width="50%" style="text-align: right; font-style: italic;  ">S.A.C.</td>
                    </tr>
                </table>'],
            ]
        ]);

        // 4. Renderizar el PDF
        return $pdf->render();
    }

    public function actionExcelsemestralnuri()
    {
        $searchModel = new ReporteSemestralNuriSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // Deshabilitar paginación y ordenar
        $dataProvider->pagination = false;
        $dataProvider->query->orderBy(['fecha_registro' => SORT_DESC]);

        $models = $dataProvider->getModels();

        // Cabeceras con UTF-8
        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        header("Content-Disposition: attachment;filename=\"reporte_semestral_nuri.xls\"");
        header("Cache-Control: max-age=0");

        // BOM UTF-8
        echo "\xEF\xBB\xBF";

        // Renderizar vista
        return $this->renderPartial('semestral_excel_nuri', [
            'models' => $models,
        ]);
    }

    // Acción para generar REPORTES NUR
    public function actionGenerarReporte($id_usuario = null, $fecha_inicio = null, $fecha_fin = null) {
        if (Yii::$app->request->get('submit') === 'pdf') {
            return $this->redirect([
                'reporte/generar-pdf',
                'id_usuario' => $id_usuario,
                'fecha_inicio' => $fecha_inicio,
                'fecha_fin' => $fecha_fin,
            ]);
        }

        if (Yii::$app->request->get('submit') === 'excel') {
            return $this->redirect([
                'reporte/generar-excel',
                'id_usuario' => $id_usuario,
                'fecha_inicio' => $fecha_inicio,
                'fecha_fin' => $fecha_fin,
            ]);
        }
    }

    //REPORTES NUR PDF
    /*public function actionGenerarPdf($id_usuario, $fecha_inicio = null, $fecha_fin = null) {
        if (Yii::$app->user->identity->id_usuario != 110) {
            throw new \yii\web\HttpException(419, 'No autorizado');
        }

        // Validar parámetros obligatorios
        if (empty($fecha_inicio) || empty($fecha_fin)) {
            Yii::$app->session->setFlash('error', 'Debe seleccionar Fecha Inicio, Fecha Fin.');
            return $this->redirect(['reportesemestralnur']);
        }

        // nombres de tabla
        $hojaTable = Hojasruta::tableName();

        // Subquery para contar cuántas veces aparece cada nur
        $subQueryCount = (new \yii\db\Query())
            ->select(['nur', 'total' => new \yii\db\Expression('COUNT(*)')])
            ->from($hojaTable)
            ->groupBy('nur');

        // Query principal con alias y relaciones
        $query = Hojasruta::find()
            ->alias('h')
            ->where([
                'h.fk_usuario' => $id_usuario,
                'h.activo' => 1
            ])
            ->andWhere(['not like', 'h.nur', 'I/%', false]) // excluir los que empiezan con I/
            ->leftJoin(['c' => $subQueryCount], 'c.nur = h.nur')
            ->with(['documento', 'seguimiento']); // eager load

        // filtros de fechas
        if ($fecha_inicio) {
            $query->andWhere(['>=', 'h.fecha_registro', $fecha_inicio]);
        }
        if ($fecha_fin) {
            $query->andWhere(['<=', 'h.fecha_registro', $fecha_fin]);
        }

        // lógica: incluir si nur es único, o si se repite pero su codigo != S/C ni S/N
        $query->andWhere([
            'or',
            ['c.total' => 1],
            ['not in', 'h.codigo', ['S/C', 'S/N', 'SC', 'SN']]
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query->orderBy(['h.nur' => SORT_DESC]),
            'pagination' => false
        ]);

        // Renderizar la vista parcial
        $content = $this->renderPartial('semestral_pdf', [
            'dataProvider' => $dataProvider,
            'busca_usuario' => $id_usuario,
        ]);

        // Configuración del PDF
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE,
            'format' => Pdf::FORMAT_LETTER,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_DOWNLOAD,
            'filename' => 'reporte_nur.pdf',
            'marginLeft' => 10,
            'marginRight' => 10,
            'marginTop' => 25,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '
            table { font-size: 10pt; border-collapse: collapse; width: 100%;} 
            th { background: #f0f0f0; }
            .reporte-tabla {font-size: 10px; border-collapse: collapse; width: 100%;}
            .reporte-tabla th, .reporte-tabla td {border: 1px solid gray; padding: 5px; text-align: left;}
        ',
            'options' => ['title' => 'Reporte NUR'],
            'methods' => [
                'SetHeader' => ['<table width="100%">
                <tr>
                    <td width="33%"><img src="./images/logo_gnv.png" style="width:200px; height:60px;"></td>
                    <td width="33%" align="center"></td>
                    <td width="33%" align="right" style="font-style: italic;" valign="middle">
                        Entidad Ejecutora de Conversión a Gas Natural Vehícular<br>Fecha: ' . date('d/m/Y') . '
                    </td>
                </tr>
            </table>'],
                'SetFooter' => ['<table width="100%" style="border-top: 1px solid; font-size: 9pt;">
                <tr>
                    <td width="33%" align="left" style="font-style: italic;">Sistema de Administración de Correspondencia</td>
                    <td width="33%" align="center">{PAGENO}/{nbpg}</td>
                    <td width="33%" align="right" style="font-style: italic;">S.A.C.</td>
                </tr>
            </table>'],
            ]
        ]);

        return $pdf->render();
    }*/

    /*public function actionGenerarPdf($id_usuario = null, $fecha_inicio = null, $fecha_fin = null)
    {
        if (Yii::$app->user->identity->id_usuario != 110) {
            throw new \yii\web\HttpException(419, 'No autorizado');
        }

        if (empty($fecha_inicio) || empty($fecha_fin)) {
            Yii::$app->session->setFlash('error', 'Debe seleccionar Fecha Inicio, Fecha Fin.');
            return $this->redirect(['reportesemestralnur']);
        }

        $usuario = Usuarios::findOne($id_usuario);
        $hojaTable = Hojasruta::tableName();

        // 1. Extraer gestión y obtener sigla dinámica (igual que en Excel)
        $gestion = date('Y', strtotime($fecha_inicio));
        $ventanilla = Ventanilla::find()
            ->select(['sigla'])
            ->where([
                'fk_usuario' => $id_usuario,
                'gestion'    => $gestion,
                'activo'     => 1
            ])
            ->one();

        $siglaPattern = $ventanilla ? $ventanilla->sigla . '/' . $gestion . '%' : null;

        // 2. Subquery para conteo de registros por NUR
        $subQueryCount = (new \yii\db\Query())
            ->select(['nur', 'total' => new \yii\db\Expression('COUNT(*)')])
            ->from($hojaTable)
            ->groupBy('nur');

        // 3. Query principal con DISTINCT ON
        $query = Hojasruta::find()
            ->alias('h')
            ->select(new \yii\db\Expression('DISTINCT ON (h.nur) h.*')) // Evita duplicados en PDF
            ->innerJoin(['c' => $subQueryCount], 'c.nur = h.nur')
            ->leftJoin('public.seguimientos s', 's.codigo = h.nur') // Join para poder ordenar por derivación
            ->where(['h.activo' => 1]);

        // Filtro dinámico por Sigla
        if ($siglaPattern) {
            $query->andWhere(['like', 'h.nur', $siglaPattern, false]);
        }

        $query->andWhere(['not like', 'h.nur', 'I/%', false]);

        // Rango de fechas
        $query->andWhere(['>=', 'h.fecha_registro', $fecha_inicio])
            ->andWhere(['<=', 'h.fecha_registro', $fecha_fin]);

        // Lógica de CITEs
        $query->andWhere([
            'or',
            ['c.total' => 1],
            [
                'and',
                ['not in', 'h.codigo', ['S/C', 'S/N', 'SC', 'SN']],
                ['not', ['h.codigo' => null]]
            ]
        ]);

        // 4. DataProvider con ordenamiento obligatorio para DISTINCT ON
        $dataProvider = new ActiveDataProvider([
            'query' => $query->orderBy([
                'h.nur' => SORT_DESC,
                's.fecha_derivacion' => SORT_DESC
            ]),
            'pagination' => false,
        ]);

        // 5. Preparar nombre de archivo dinámico
        $nombreUsuario = $usuario ? $usuario->nombre : 'desconocido';
        $nombreUsuarioClean = str_replace([' ', '.', ','], '_', $nombreUsuario);
        $filename = "REPORTE_NUR_{$nombreUsuarioClean}.pdf";

        $content = $this->renderPartial('semestral_pdf', [
            'dataProvider' => $dataProvider,
            'busca_usuario' => $id_usuario,
            'ventanilla' => $ventanilla,
        ]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE,
            'format' => Pdf::FORMAT_LETTER,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_DOWNLOAD,
            'filename' => $filename,
            'marginLeft' => 10,
            'marginRight' => 10,
            'marginTop' => 25,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '
            table { font-size: 10pt; border-collapse: collapse; width: 100%;} 
            th { background: #f0f0f0; }
            .reporte-tabla {font-size: 10px; border-collapse: collapse; width: 100%;}
            .reporte-tabla th, .reporte-tabla td {border: 1px solid gray; padding: 5px; text-align: left;}
        ',
            'options' => ['title' => 'Reporte NUR'],
            'methods' => [
                'SetHeader' => ['<table width="100%">
                <tr>
                    <td width="33%"><img src="./images/encabezado_presidencia_estado.png" style="width:200px; height:60px;"></td>
                    <td width="33%" align="center"></td>
                    <td width="33%" align="right" style="font-style: italic;" valign="middle">
                        Entidad Ejecutora de Conversión a Gas Natural Vehícular<br>Fecha: ' . date('d/m/Y') . '
                    </td>
                </tr>
            </table>'],
                'SetFooter' => ['<table width="100%" style="border-top: 1px solid; font-size: 9pt;">
                <tr>
                    <td width="33%" align="left" style="font-style: italic;">Sistema de Administración de Correspondencia</td>
                    <td width="33%" align="center">{PAGENO}/{nbpg}</td>
                    <td width="33%" align="right" style="font-style: italic;">S.A.C.</td>
                </tr>
            </table>'],
            ]
        ]);

        return $pdf->render();
    }*/

    public function actionGenerarPdf($id_usuario = null, $fecha_inicio = null, $fecha_fin = null)
    {
        if (Yii::$app->user->identity->id_usuario != 110) {
            throw new \yii\web\HttpException(419, 'No autorizado');
        }

        if (empty($fecha_inicio) || empty($fecha_fin)) {
            Yii::$app->session->setFlash('error', 'Debe seleccionar Fecha Inicio, Fecha Fin.');
            return $this->redirect(['reportesemestralnur']);
        }

        // --- OPTIMIZACIÓN DE MOTOR PCRE Y MEMORIA PARA mPDF ---
        ini_set("pcre.backtrack_limit", "5000000");
        ini_set("memory_limit", "512M"); // mPDF suele requerir más RAM con tablas largas
        set_time_limit(180); // Evita el Fatal Error por timeout (3 minutos de tolerancia)

        $usuario = Usuarios::findOne($id_usuario);

        // 1. OBTENCIÓN DINÁMICA DE LA GESTIÓN SEGÚN LA FECHA SELECCIONADA
        $gestion = date('Y', strtotime($fecha_inicio));

        // 2. Obtener la sigla del usuario para la gestión dinámica (Igual que en Excel)
        $ventanillaUsuario = Ventanilla::find()
            ->select(['sigla'])
            ->where([
                'fk_usuario' => $id_usuario,
                'gestion'    => $gestion,
                'activo'     => 1
            ])
            ->one();

        $sigla = $ventanillaUsuario ? $ventanillaUsuario->sigla : null;

        // 3. QUERY PRINCIPAL OPTIMIZADO (Sincronizado al 100% con el Excel)
        // Se elimina la subquery count y el patrón LIKE de texto antiguo
        $query = Hojasruta::find()
            ->alias('h')
            ->select(new \yii\db\Expression('DISTINCT ON (h.nur) h.*')) // Evita filas duplicadas en el PDF
            ->innerJoin('public.ventanilla v', 'v.fk_usuario = h.fk_usuario') // Garantiza jalar datos de los colegas
            ->leftJoin('public.seguimientos s', 's.codigo = h.nur') // Join para ordenar por la última derivación
            ->where(['h.activo' => 1]);

        // Filtro de Oficina Relacional (Trae lo tuyo y lo de tu misma sigla)
        $query->andWhere([
            'or',
            ['h.fk_usuario' => $id_usuario],
            ['v.sigla' => $sigla]
        ]);

        // Exclusiones estándar (Trámites internos)
        $query->andWhere(['not like', 'h.nur', 'I/%', false]);

        // Rango de fechas dinámico
        $query->andWhere(['>=', 'h.fecha_registro', $fecha_inicio])
            ->andWhere(['<=', 'h.fecha_registro', $fecha_fin]);

        // Eager loading indispensable para que el DataProvider no ralentice mPDF con queries N+1
        $query->with(['documento', 'seguimiento']);

        // 4. DataProvider con ordenamiento obligatorio para el funcionamiento de DISTINCT ON
        $dataProvider = new ActiveDataProvider([
            'query' => $query->orderBy([
                'h.nur' => SORT_DESC,
                's.fecha_derivacion' => SORT_DESC // Se queda con el movimiento más reciente del NUR
            ]),
            'pagination' => false,
        ]);

        // 5. Preparar nombre de archivo dinámico
        $nombreUsuario = $usuario ? $usuario->nombre : 'desconocido';
        $nombreUsuarioClean = str_replace([' ', '.', ','], '_', $nombreUsuario);
        $filename = "REPORTE_NUR_{$nombreUsuarioClean}.pdf";

        // Pasamos el objeto $ventanillaUsuario para no romper compatibilidad si la vista 'semestral_pdf' lo usa
        $content = $this->renderPartial('semestral_pdf', [
            'dataProvider' => $dataProvider,
            'busca_usuario' => $id_usuario,
            'ventanilla' => $ventanillaUsuario,
        ]);

        // 6. Generación del documento PDF mediante mPDF
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE,
            'format' => Pdf::FORMAT_LETTER,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_DOWNLOAD,
            'filename' => $filename,
            'marginLeft' => 10,
            'marginRight' => 10,
            'marginTop' => 25,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '
            table { font-size: 10pt; border-collapse: collapse; width: 100%;} 
            th { background: #f0f0f0; }
            .reporte-tabla {font-size: 10px; border-collapse: collapse; width: 100%;}
            .reporte-tabla th, .reporte-tabla td {border: 1px solid gray; padding: 5px; text-align: left;}
        ',
            'options' => ['title' => 'Reporte NUR'],
            'methods' => [
                'SetHeader' => ['<table width="100%">
            <tr>
                <td width="33%"><img src="./images/encabezado_presidencia_estado.png" style="width:200px; height:60px;"></td>
                <td width="33%" align="center"></td>
                <td width="33%" align="right" style="font-style: italic;" valign="middle">
                    Entidad Ejecutora de Conversión a Gas Natural Vehícular<br>Fecha: ' . date('d/m/Y') . '
                </td>
            </tr>
        </table>'],
                'SetFooter' => ['<table width="100%" style="border-top: 1px solid; font-size: 9pt;">
            <tr>
                <td width="33%" align="left" style="font-style: italic;">Sistema de Administración de Correspondencia</td>
                <td width="33%" align="center">{PAGENO}/{nbpg}</td>
                <td width="33%" align="right" style="font-style: italic;">S.A.C.</td>
            </tr>
        </table>'],
            ]
        ]);

        return $pdf->render();
    }

    //REPORTES NUR EXCEL
    /*public function actionGenerarExcel($id_usuario = null, $fecha_inicio = null, $fecha_fin = null) {
        if (Yii::$app->user->identity->id_usuario != 110) {
            throw new \yii\web\HttpException(419, 'No autorizado');
        }

        // Validar parámetros obligatorios
        if (empty($fecha_inicio) || empty($fecha_fin)) {
            Yii::$app->session->setFlash('error', 'Debe llenar los campos Fecha Inicio, Fecha Fin.');
            return $this->redirect(['reportesemestralnur']);
        }

        // Usuario
        $usuario = Usuarios::findOne($id_usuario);

        // nombres de tabla (usa tableName() para evitar errores)
        $hojaTable = Hojasruta::tableName(); // normalmente "hojas_ruta"

        //-------------------------
       //Subquery: contar registros por NUR
       //(por defecto cuenta en toda la tabla; más abajo te muestro
        //cómo contar solo dentro del mismo fk_usuario si lo necesitas)
       //------------------------- 
        $subQueryCount = (new \yii\db\Query())
            ->select(['nur', 'total' => new \yii\db\Expression('COUNT(*)')])
            ->from($hojaTable)
            ->groupBy('nur');

        // 1. Primero obtenemos la sigla de la ventanilla del usuario consultado
        $ventanillaUsuario = Ventanilla::find()
            ->select(['sigla'])
            ->where(['fk_usuario' => $id_usuario, 'gestion' => 2026, 'activo' => 1])
            ->one();

        $sigla = $ventanillaUsuario ? $ventanillaUsuario->sigla : null;

        // 2. Query principal con la lógica de sigla extendida
        $query = Hojasruta::find()
            ->alias('h')
            ->innerJoin('public.ventanilla v', 'v.fk_usuario = h.fk_usuario') // Unimos con ventanilla
            ->where(['h.activo' => 1])
            ->andWhere([
                'or',
                ['h.fk_usuario' => $id_usuario], // Registros directos del usuario
                ['v.sigla' => $sigla] // Registros de otros usuarios con la misma sigla
            ])
            ->andWhere(['not like', 'h.nur', 'I/%', false])
            ->leftJoin(['c' => $subQueryCount], 'c.nur = h.nur')
            ->with(['documento', 'seguimiento']);

        // fechas
        if ($fecha_inicio) {
            $query->andWhere(['>=', 'h.fecha_registro', $fecha_inicio]);
        }
        if ($fecha_fin) {
            $query->andWhere(['<=', 'h.fecha_registro', $fecha_fin]);
        }

        // Lógica de inclusión:
        // - incluir fila si c.total = 1  (nur único)
        // - o incluir fila si c.total > 1 pero su codigo NO ES 'S/C' ni 'S/N'
        $query->andWhere([
            'or',
            ['c.total' => 1],
            ['not in', 'h.codigo', ['S/C', 'S/N', 'SC', 'SN']]
        ]);

        // orden y ejecución
        $registros = $query->orderBy(['h.nur' => SORT_DESC])->all();

        // Cabeceras con UTF-8
        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        header("Content-Disposition: attachment;filename=\"reporte_nur.xls\"");
        header("Cache-Control: max-age=0");

        ini_set("pcre.backtrack_limit", "5000000");

        // BOM UTF-8
        echo "\xEF\xBB\xBF";

        // ---------------- Tabla de datos ----------------
        echo "<table border='1' cellspacing='0' cellpadding='4'>";

        // ----------------- Cabecera logo ----------------
        $logoUrl = \yii\helpers\Url::to('@web/images/logo_gnv.png', true);

        echo "<tr>
                <td colspan='3' width='33%' align='left' style='vertical-align:middle;'>
                    <img src='{$logoUrl}'
                        width='230' height='70'
                        style=\"display:block; mso-width-source:userset; mso-height-source:userset;\">
                </td>
                <td colspan='1' width='33%' align='center'></td>
                <td colspan='2' width='33%' align='right' style='font-style: italic; vertical-align:middle;'>
                    Entidad Ejecutora de Conversión a Gas Natural Vehícular<br>
                    Fecha: " . date('d/m/Y') . "
                </td>
            </tr>
        ";

        // ---------------- Titulo -------------------------
        echo "<tr>
                <td style='text-align: center; background-color: #D8D8D8; padding: 7px;' colspan='6'>
                    <b><u>REPORTE NUR</u></b>
                </td>
            </tr>
        ";

        // ---------------- Datos del usuario ---------------
        echo "<tr>
                <th width='15%' align='right'>Nombre: </th>
                <td colspan='5'>" . ($usuario ? Html::encode($usuario->nombre) : 'No encontrado') . "</td>
            </tr>
            <tr>
                <th width='15%' align='right'>&Aacute;rea/Unidad: </th>
                <td colspan='5'>" . ($usuario && $usuario->fkArea ? Html::encode($usuario->fkArea->area) : 'No encontrado') . "</td>
            </tr>
        ";
        // ---------------- Contenido ---------------
        echo "<tr>
                <th style='background-color:#f2f2f2; font-weight:bold;'>#</th>
                <th style='background-color:#f2f2f2; font-weight:bold;'>Nur</th>
                <th style='background-color:#f2f2f2; font-weight:bold;'>CITE</th>
                <th style='background-color:#f2f2f2; font-weight:bold;'>Referencia</th>
                <th style='background-color:#f2f2f2; font-weight:bold;'>Fecha de generación del NUR</th>
                <th style='background-color:#f2f2f2; font-weight:bold;'>Fecha Derivación del NUR</th>
            </tr>
        ";

        $i = 1;
        foreach ($registros as $r) {
            echo "<tr>";
            echo "<td>" . $i++ . "</td>";
            echo "<td>" . Html::encode($r->nur) . "</td>";
            echo "<td>" . Html::encode($r->codigo) . "</td>";
            echo "<td>" . (
                $r->documento && $r->documento->referencia !== null && strtolower(trim($r->documento->referencia)) !== 'null'
                ? Html::encode($r->documento->referencia)
                : 'Sin referencia'
            ) . "</td>";
            echo "<td>" . Yii::$app->formatter->asDate($r->fecha_registro, 'php:Y-m-d') . "</td>";
            echo "<td>" . ($r->seguimiento
                ? Yii::$app->formatter->asDate($r->seguimiento->fecha_derivacion, 'php:Y-m-d')
                : 'No disponible') . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        exit;
    }*/

    /*public function actionGenerarExcel($id_usuario = null, $fecha_inicio = null, $fecha_fin = null)
    {
        if (Yii::$app->user->identity->id_usuario != 110) {
            throw new \yii\web\HttpException(419, 'No autorizado');
        }

        if (empty($fecha_inicio) || empty($fecha_fin)) {
            Yii::$app->session->setFlash('error', 'Debe llenar los campos Fecha Inicio, Fecha Fin.');
            return $this->redirect(['reportesemestralnur']);
        }

        $usuario = Usuarios::findOne($id_usuario);
        $hojaTable = Hojasruta::tableName();

        // 0. Subquery para conteo de duplicados (Lógica de negocio)
        $subQueryCount = (new \yii\db\Query())
            ->select(['nur', 'total' => new \yii\db\Expression('COUNT(*)')])
            ->from($hojaTable)
            ->groupBy('nur');

        // 1. Extraer el año de la fecha_inicio
        // Asumiendo que $fecha_inicio viene en formato 'YYYY-MM-DD'
        $gestion = date('Y', strtotime($fecha_inicio));

        // 2. Obtener Sigla del usuario consultado usando la gestión dinámica
        $ventanilla = Ventanilla::find()
            ->select(['sigla'])
            ->where([
                'fk_usuario' => $id_usuario,
                'gestion'    => $gestion, // <--- Ahora es dinámico
                'activo'     => 1
            ])
            ->one();

        // 3. Construir el patrón del NUR con el año extraído
        $siglaPattern = $ventanilla ? $ventanilla->sigla . '/' . $gestion . '%' : null;

        // 3. Query principal con DISTINCT ON y Joins corregidos
        $query = Hojasruta::find()
            ->alias('h')
            ->select(new \yii\db\Expression('DISTINCT ON (h.nur) h.*')) // Evita duplicados por NUR
            ->innerJoin(['c' => $subQueryCount], 'c.nur = h.nur')
            ->leftJoin('public.documentos d', 'd.id_documento = h.fk_documento')
            ->leftJoin('public.seguimientos s', 's.codigo = h.nur') // Ajustar nombre de columna si es necesario
            ->where(['h.activo' => 1]);

        // Filtro por Sigla del NUR (Independiente del ID de usuario para no perder correlativos)
        if ($siglaPattern && !$ventanilla->sigla = 'X') {
            $query->andWhere(['like', 'h.nur', $siglaPattern, false]);
        }

        // Exclusiones estándar
        $query->andWhere(['not like', 'h.nur', 'I/%', false]);

        // Rango de fechas
        $query->andWhere(['>=', 'h.fecha_registro', $fecha_inicio])
            ->andWhere(['<=', 'h.fecha_registro', $fecha_fin]);

        // Lógica de CITEs (incluir únicos o con CITE válido)
        $query->andWhere([
            'or',
            ['c.total' => 1],
            [
                'and',
                ['not in', 'h.codigo', ['S/C', 'S/N', 'SC', 'SN']],
                ['not', ['h.codigo' => null]]
            ]
        ]);

        // Importante: El ORDER BY debe empezar con el campo del DISTINCT ON
        // Luego ordenamos por fecha de derivación DESC para que el DISTINCT se quede con el último movimiento
        $registros = $query->orderBy([
            'h.nur' => SORT_DESC,
            's.fecha_derivacion' => SORT_DESC
        ])
            ->with(['documento', 'seguimiento']) // Eager loading para el bucle
            ->all();

        // --- GENERACIÓN DE EXCEL (Mantienes tu lógica de cabeceras) ---
        $nombreUsuario = $usuario ? $usuario->nombre : 'desconocido';
        // Limpieza básica de caracteres
        $nombreUsuarioClean = str_replace([' ', '.', ','], '_', $nombreUsuario);

        // Cabeceras
        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        header("Content-Disposition: attachment;filename=\"REPORTE_NUR_{$nombreUsuarioClean}.xls\"");
        header("Cache-Control: max-age=0");
        echo "\xEF\xBB\xBF"; // BOM UTF-8

        echo "<table border='1' cellspacing='0' cellpadding='4'>";

        // ---------------- Tabla de datos ----------------
        echo "<table border='1' cellspacing='0' cellpadding='4'>";

        // ----------------- Cabecera logo ----------------
        $logoUrl = \yii\helpers\Url::to('@web/images/encabezado_presidencia_estado.png', true);

        echo "<tr>
                <td colspan='3' width='33%' align='left' style='vertical-align:middle;'>
                    <img src='{$logoUrl}'
                        width='230' height='70'
                        style=\"display:block; mso-width-source:userset; mso-height-source:userset;\">
                </td>
                <td colspan='1' width='33%' align='center'></td>
                <td colspan='3' width='33%' align='right' style='font-style: italic; vertical-align:middle;'>
                    Entidad Ejecutora de Conversión a Gas Natural Vehícular<br>
                    Fecha: " . date('d/m/Y') . "
                </td>
            </tr>
        ";

        // ---------------- Titulo -------------------------
        echo "<tr>
                <td style='text-align: center; background-color: #D8D8D8; padding: 7px;' colspan='6'>
                    <b><u>REPORTE NUR</u></b>
                </td>
            </tr>
        ";

        // ---------------- Datos del usuario ---------------
        echo "<tr>
                <th width='15%' align='right'>Nombre: </th>
                <td colspan='5'>" . ($usuario ? Html::encode($usuario->nombre) : 'No encontrado') . "</td>
            </tr>
            <tr>
                <th width='15%' align='right'>&Aacute;rea/Unidad: </th>
                <td colspan='5'>" . ($usuario && $usuario->fkArea ? Html::encode($usuario->fkArea->area) : 'No encontrado') . "</td>
            </tr>
            <tr>
                <th align='right'>Sigla: </th>
                <td colspan='5'>" . ($ventanilla ? $ventanilla->sigla : 'N/A') . "</td>
            </tr>
        ";

        // Encabezados de tabla
        echo "<tr>
            <th style='background-color:#f2f2f2;'>#</th>
            <th style='background-color:#f2f2f2;'>Nur</th>
            <th style='background-color:#f2f2f2;'>CITE</th>
            <th style='background-color:#f2f2f2;'>Referencia</th>
            <th style='background-color:#f2f2f2;'>Fecha Registro</th>
            <th style='background-color:#f2f2f2;'>Última Derivación</th>
            <th style='background-color:#f2f2f2;'>Estado</th>
          </tr>";

        $i = 1;
        foreach ($registros as $r) {
            echo "<tr>";
            echo "<td>" . $i++ . "</td>";
            echo "<td>" . Html::encode($r->nur) . "</td>";
            echo "<td>" . Html::encode($r->codigo) . "</td>";
            echo "<td>" . ($r->documento ? Html::encode($r->documento->referencia) : 'Sin referencia') . "</td>";
            echo "<td>" . Yii::$app->formatter->asDate($r->fecha_registro, 'php:d/m/Y') . "</td>";
            echo "<td>" . ($r->seguimiento ? Yii::$app->formatter->asDate($r->seguimiento->fecha_derivacion, 'php:d/m/Y') : 'No disponible') . "</td>";
            echo "<td>" . Html::encode($r->seguimiento->fkEstado->estado) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        exit;
    }*/

    //modificado reporte excel nur
    /*public function actionGenerarExcel($id_usuario = null, $fecha_inicio = null, $fecha_fin = null)
    {
        if (Yii::$app->user->identity->id_usuario != 110) {
            throw new \yii\web\HttpException(419, 'No autorizado');
        }

        // Validar parámetros obligatorios
        if (empty($fecha_inicio) || empty($fecha_fin)) {
            Yii::$app->session->setFlash('error', 'Debe llenar los campos Fecha Inicio, Fecha Fin.');
            return $this->redirect(['reportesemestralnur']);
        }

        $usuario = Usuarios::findOne($id_usuario);

        // 1. OBTENCIÓN DINÁMICA DE LA GESTIÓN SEGÚN LA FECHA SELECCIONADA
        $gestion = date('Y', strtotime($fecha_inicio));

        // 2. Obtener la sigla del usuario para la gestión dinámica
        $ventanillaUsuario = Ventanilla::find()
            ->select(['sigla'])
            ->where([
                'fk_usuario' => $id_usuario,
                'gestion'    => $gestion,
                'activo'     => 1
            ])
            ->one();

        $sigla = $ventanillaUsuario ? $ventanillaUsuario->sigla : null;

        // 3. QUERY PRINCIPAL OPTIMIZADO
        // Eliminamos la subquery pesada de conteo. Ahora el control de unicidad recae 100% en DISTINCT ON.
        $query = Hojasruta::find()
            ->alias('h')
            ->select(new \yii\db\Expression('DISTINCT ON (h.nur) h.*'))
            ->innerJoin('public.ventanilla v', 'v.fk_usuario = h.fk_usuario')
            ->leftJoin('public.seguimientos s', 's.codigo = h.nur')
            ->where(['h.activo' => 1]);

        // Filtro de Oficina Relacional (Trae lo tuyo y lo de tu misma sigla)
        $query->andWhere([
            'or',
            ['h.fk_usuario' => $id_usuario],
            ['v.sigla' => $sigla]
        ]);

        // Exclusiones estándar (Trámites internos)
        $query->andWhere(['not like', 'h.nur', 'I/%', false]);

        // Filtro de fechas dinámico
        $query->andWhere(['>=', 'h.fecha_registro', $fecha_inicio])
            ->andWhere(['<=', 'h.fecha_registro', $fecha_fin]);

        // ORDENAMIENTO CRÍTICO: 
        // h.nur DESC agrupa los duplicados.
        // s.fecha_derivacion DESC asegura que el "primer" registro que elija DISTINCT ON sea el más nuevo.
        $registros = $query->orderBy([
            'h.nur' => SORT_DESC,
            's.fecha_derivacion' => SORT_DESC
        ])
            ->with(['documento', 'seguimiento'])
            ->all();

        // --- GENERACIÓN DE EXCEL ---
        $nombreUsuario = $usuario ? $usuario->nombre : 'desconocido';
        // Limpieza básica de caracteres
        $nombreUsuarioClean = str_replace([' ', '.', ','], '_', $nombreUsuario);
	
	// 1. MEMORIA: TOTALMENTE NECESARIO
ini_set("memory_limit", "1024M"); // O mínimo "512M"

// 2. TIEMPO DE EJECUCIÓN: TOTALMENTE NECESARIO
set_time_limit(300);
	
        // Cabeceras
        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        header("Content-Disposition: attachment;filename=\"REPORTE_NUR_{$nombreUsuarioClean}.xls\"");
        header("Cache-Control: max-age=0");

        //aumentar el tiempo de espera
        ini_set("pcre.backtrack_limit", "5000000");

        echo "\xEF\xBB\xBF"; // BOM UTF-8

        // ---------------- Tabla de datos ----------------
        echo "<table border='1' cellspacing='0' cellpadding='4'>";

        // ----------------- Cabecera logo ----------------
        $logoUrl = \yii\helpers\Url::to('@web/images/encabezado_presidencia_estado.png', true);

        echo "<tr>
                <td colspan='3' width='33%' align='left' style='vertical-align:middle;'>
                    <img src='{$logoUrl}'
                        width='240' height='80'
                        style=\"display:block; mso-width-source:userset; mso-height-source:userset;\">
                </td>
                <td colspan='1' width='33%' align='center'></td>
                <td colspan='3' width='33%' align='right' style='font-style: italic; vertical-align:middle;'>
                    Entidad Ejecutora de Conversión a Gas Natural Vehícular<br>
                    Fecha: " . date('d/m/Y') . "
                </td>
            </tr>
        ";

        // ---------------- Titulo -------------------------
        echo "<tr>
                <td style='text-align: center; background-color: #D8D8D8; padding: 7px;' colspan='7'>
                    <b><u>REPORTE NUR</u></b>
                </td>
            </tr>
        ";

        // ---------------- Datos del usuario ---------------
        echo "<tr>
                <th width='15%' align='right'>Nombre: </th>
                <td colspan='6'>" . ($usuario ? Html::encode($usuario->nombre) : 'No encontrado') . "</td>
            </tr>
            <tr>
                <th width='15%' align='right'>&Aacute;rea/Unidad: </th>
                <td colspan='6'>" . ($usuario && $usuario->fkArea ? Html::encode($usuario->fkArea->area) : 'No encontrado') . "</td>
            </tr>
        ";

        // Encabezados de tabla
        echo "<tr>
            <th style='background-color:#f2f2f2;'>#</th>
            <th style='background-color:#f2f2f2;'>Nur</th>
            <th style='background-color:#f2f2f2;'>CITE</th>
            <th style='background-color:#f2f2f2;'>Referencia</th>
            <th style='background-color:#f2f2f2;'>Fecha Registro</th>
            <th style='background-color:#f2f2f2;'>Última Derivación</th>
            <th style='background-color:#f2f2f2;'>Estado</th>
        </tr>";

        $i = 1;
        foreach ($registros as $r) {
            echo "<tr>";
            echo "<td>" . $i++ . "</td>";
            echo "<td>" . Html::encode($r->nur) . "</td>";
            echo "<td>" . Html::encode($r->codigo) . "</td>";
            echo "<td>" . ($r->documento && $r->documento->referencia !== null && strtolower(trim($r->documento->referencia)) !== 'null'
                ? Html::encode($r->documento->referencia)
                : 'Sin referencia'
            ) . "</td>";
            echo "<td>" . Yii::$app->formatter->asDate($r->fecha_registro, 'php:d/m/Y') . "</td>";
            echo "<td>" . ($r->seguimiento
                ? Yii::$app->formatter->asDate($r->seguimiento->fecha_derivacion, 'php:d/m/Y')
                : 'No disponible') . "</td>";
            echo "<td>" . ($r->seguimiento->fkEstado->estado
		? Html::encode($r->seguimiento->fkEstado->estado)
		: 'Sin estado'
		) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        exit;
    }*/

    //modificado
 public function actionGenerarExcel($id_usuario = null, $fecha_inicio = null, $fecha_fin = null)
{
    // Aumentar límites de RAM y tiempo de ejecución para reportes masivos
    ini_set("memory_limit", "512M");
    set_time_limit(180);

    if (Yii::$app->user->identity->id_usuario != 110) {
        throw new HttpException(419, 'No autorizado');
    }

    // Validar parámetros obligatorios
    if (empty($fecha_inicio) || empty($fecha_fin)) {
        Yii::$app->session->setFlash('error', 'Debe llenar los campos Fecha Inicio, Fecha Fin.');
        return $this->redirect(['reportesemestralnur']);
    }

    $usuario = Usuarios::findOne($id_usuario);

    // 1. OBTENCIÓN DINÁMICA DE LA GESTIÓN SEGÚN LA FECHA SELECCIONADA
    $gestion = date('Y', strtotime($fecha_inicio));

    // 2. Obtener la sigla del usuario para la gestión dinámica
    $ventanillaUsuario = Ventanilla::find()
        ->select(['sigla'])
        ->where([
            'fk_usuario' => $id_usuario,
            'gestion'    => $gestion,
            'activo'     => 1
        ])
        ->one();

    $sigla = $ventanillaUsuario ? $ventanillaUsuario->sigla : null;

    // 3. QUERY PRINCIPAL OPTIMIZADO
    $query = Hojasruta::find()
        ->alias('h')
        ->select(new \yii\db\Expression('DISTINCT ON (h.nur) h.*'))
        ->innerJoin('public.ventanilla v', 'v.fk_usuario = h.fk_usuario')
        ->leftJoin('public.seguimientos s', 's.codigo = h.nur')
        ->where(['h.activo' => 1]);

    // Filtro de Oficina Relacional
    $query->andWhere([
        'or',
        ['h.fk_usuario' => $id_usuario],
        ['v.sigla' => $sigla]
    ]);

    // Exclusiones estándar (Trámites internos)
    $query->andWhere(['not like', 'h.nur', 'I/%', false]);

    // Filtro de fechas dinámico
    $query->andWhere(['>=', 'h.fecha_registro', $fecha_inicio])
        ->andWhere(['<=', 'h.fecha_registro', $fecha_fin]);

    // ORDENAMIENTO
    $registros = $query->orderBy([
        'h.nur' => SORT_DESC,
        's.fecha_derivacion' => SORT_DESC
    ])
        ->with(['documento', 'seguimiento', 'seguimiento.fkEstado']) // Carga ansiosa (Eager Loading) de fkEstado
        ->all();

    // --- GENERACIÓN DE EXCEL ---
    $nombreUsuario = $usuario ? $usuario->nombre : 'desconocido';
    $nombreUsuarioClean = str_replace([' ', '.', ','], '_', $nombreUsuario);

    // Limpiar búfer de salida para evitar interferencias
    if (ob_get_length()) {
        ob_end_clean();
    }

    // Cabeceras HTTP
    header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
    header("Content-Disposition: attachment;filename=\"REPORTE_NUR_{$nombreUsuarioClean}.xls\"");
    header("Cache-Control: max-age=0");

    echo "\xEF\xBB\xBF"; // BOM UTF-8 para caracteres especiales y acentos

    // ---------------- Tabla de datos ----------------
    echo "<table border='1' cellspacing='0' cellpadding='4'>";

    // ----------------- Cabecera logo ----------------
    $logoUrl = \yii\helpers\Url::to('@web/images/encabezado_presidencia_estado.png', true);

    echo "<tr>
            <td colspan='3' width='33%' align='left' style='vertical-align:middle;'>
                <img src='{$logoUrl}' width='240' height='80' style=\"display:block;\">
            </td>
            <td colspan='1' width='33%' align='center'></td>
            <td colspan='3' width='33%' align='right' style='font-style: italic; vertical-align:middle;'>
                Entidad Ejecutora de Conversión a Gas Natural Vehicular<br>
                Fecha: " . date('d/m/Y') . "
            </td>
        </tr>";

    // ---------------- Título -------------------------
    echo "<tr>
            <td style='text-align: center; background-color: #D8D8D8; padding: 7px;' colspan='7'>
                <b><u>REPORTE NUR</u></b>
            </td>
        </tr>";

    // ---------------- Datos del usuario ---------------
    echo "<tr>
            <th width='15%' align='right'>Nombre: </th>
            <td colspan='6'>" . ($usuario ? Html::encode($usuario->nombre) : 'No encontrado') . "</td>
        </tr>
        <tr>
            <th width='15%' align='right'>Área/Unidad: </th>
            <td colspan='6'>" . ($usuario && $usuario->fkArea ? Html::encode($usuario->fkArea->area) : 'No encontrado') . "</td>
        </tr>";

    // Encabezados de tabla
    echo "<tr>
        <th style='background-color:#f2f2f2;'>#</th>
        <th style='background-color:#f2f2f2;'>Nur</th>
        <th style='background-color:#f2f2f2;'>CITE</th>
        <th style='background-color:#f2f2f2;'>Referencia</th>
        <th style='background-color:#f2f2f2;'>Fecha Registro</th>
        <th style='background-color:#f2f2f2;'>Última Derivación</th>
        <th style='background-color:#f2f2f2;'>Estado</th>
    </tr>";

    $i = 1;
    foreach ($registros as $r) {
        // Evaluación segura de la referencia
        $referencia = ($r->documento && $r->documento->referencia !== null && strtolower(trim($r->documento->referencia)) !== 'null')
            ? Html::encode($r->documento->referencia)
            : 'Sin referencia';

        // Evaluación segura de la fecha de derivación
        $fechaDerivacion = ($r->seguimiento && $r->seguimiento->fecha_derivacion)
            ? Yii::$app->formatter->asDate($r->seguimiento->fecha_derivacion, 'php:d/m/Y')
            : 'No disponible';

        // Evaluación segura del estado (evita romperse si seguimiento o fkEstado son nulos)
        $estado = ($r->seguimiento && $r->seguimiento->fkEstado && $r->seguimiento->fkEstado->estado)
            ? Html::encode($r->seguimiento->fkEstado->estado)
            : 'Sin estado';

        echo "<tr>";
        echo "<td>" . $i++ . "</td>";
        echo "<td>" . Html::encode($r->nur) . "</td>";
        echo "<td>" . Html::encode($r->codigo) . "</td>";
        echo "<td>" . $referencia . "</td>";
        echo "<td>" . ($r->fecha_registro ? Yii::$app->formatter->asDate($r->fecha_registro, 'php:d/m/Y') : '') . "</td>";
        echo "<td>" . $fechaDerivacion . "</td>";
        echo "<td>" . $estado . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    Yii::$app->end(); // Terminar el flujo de Yii limpia y ordenadamente
}

    // Acción para generar REPORTES NURIS
    public function actionGenerarReporteNuri($id_usuario = null, $fecha_inicio = null, $fecha_fin = null) {
        if (Yii::$app->request->get('submit') === 'pdf') {
            return $this->redirect([
                'reporte/generar-pdf-nuri',
                'id_usuario' => $id_usuario,
                'fecha_inicio' => $fecha_inicio,
                'fecha_fin' => $fecha_fin,
            ]);
        }

        if (Yii::$app->request->get('submit') === 'excel') {
            return $this->redirect([
                'reporte/generar-excel-nuri',
                'id_usuario' => $id_usuario,
                'fecha_inicio' => $fecha_inicio,
                'fecha_fin' => $fecha_fin,
            ]);
        }
    }

    //REPORTES NURIS PDF
    public function actionGenerarPdfNuri($id_usuario, $fecha_inicio = null, $fecha_fin = null) {
        if (Yii::$app->user->identity->id_usuario != 110) {
            throw new \yii\web\HttpException(419, 'No autorizado');
        }

        // Validar que los parámetros no estén vacíos
        if (empty($fecha_inicio) || empty($fecha_fin)) {
            Yii::$app->session->setFlash('error', 'Debe seleccionar Fecha Inicio, Fecha Fin y Gestión.');
            return $this->redirect(['reportesemestralnuri']); // o la ruta de tu vista principal
        }

        // nombres de tabla
        $hojaTable = Hojasruta::tableName();

        // Subquery para contar cuántas veces aparece cada nur
        $subQueryCount = (new \yii\db\Query())
            ->select(['nur', 'total' => new \yii\db\Expression('COUNT(*)')])
            ->from($hojaTable)
            ->groupBy('nur');

        // Query principal con alias y relaciones
        $query = Hojasruta::find()
            ->alias('h')
            ->where([
                'h.fk_usuario' => $id_usuario,
                'h.activo' => 1
            ])
            ->andWhere(['like', 'h.nur', 'I/%', false]) // excluir los que empiezan con I/
            ->leftJoin(['c' => $subQueryCount], 'c.nur = h.nur')
            ->with(['documento', 'seguimiento']); // eager load

        // filtros de fechas
        if ($fecha_inicio) {
            $query->andWhere(['>=', 'h.fecha_registro', $fecha_inicio]);
        }
        if ($fecha_fin) {
            $query->andWhere(['<=', 'h.fecha_registro', $fecha_fin]);
        }

        // lógica: incluir si nur es único, o si se repite pero su codigo != S/C ni S/N
        $query->andWhere([
            'or',
            ['c.total' => 1],
            ['not in', 'h.codigo', ['S/C', 'S/N', 'SC', 'SN']]
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query->orderBy(['h.nur' => SORT_DESC]),
            'pagination' => false
        ]);

        // Renderizar la vista parcial
        $content = $this->renderPartial('semestral_pdf_nuri', [
            'dataProvider' => $dataProvider,
            'busca_usuario' => $id_usuario,
        ]);

        // 3. Configurar el PDF
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE,
            'format' => Pdf::FORMAT_LETTER,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_DOWNLOAD, // puedes usar Pdf::DEST_BROWSER si quieres mostrarlo
            'filename' => 'reporte_nuri.pdf',
            'marginLeft' => 10,
            'marginRight' => 10,
            'marginTop' => 25,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => 'table { font-size: 10pt; border-collapse: collapse; width: 100%;} 
                            th { background: #f0f0f0; }
                            .reporte-tabla {font-size: 10px; border-collapse: collapse; width: 100%;}
                            .reporte-tabla th, .reporte-tabla td {border: 1px solid gray; padding: 5px; text-align: left;}',
            'options' => ['title' => 'Reporte NURI'],
            'methods' => [
                'SetHeader' => ['<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;">
                    <tr>
                        <td width="33%"><img src="./images/encabezado_presidencia_estado.png" style="width:200px; height:60px;"></td>
                        <td width="33%" align="center"></td>
                        <td width="33%" align="right" style="font-style: italic;" valign="middle">Entidad Ejecutora de Conversión a Gas Natural Vehícular<br>Fecha: ' . date('d/m/Y') . '</td>
                    </tr>
                </table>'],
                'SetFooter' => ['<table width="100%" style="border-top: 1px solid; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;">
                    <tr>
                        <td width="33%" align="left" style="font-style: italic;">Sistema de Administración de Correspondencia</td>
                        <td width="33%" align="center">{PAGENO}/{nbpg}</td>
                        <td width="33%" align="right" style="text-align: right; font-style: italic;  ">S.A.C.</td>
                    </tr>
                </table>'],
            ]

        ]);

        // 4. Renderizar el PDF
        return $pdf->render();
    }

    // REPORTES NURIS EXCEL
    public function actionGenerarExcelNuri($id_usuario = null, $fecha_inicio = null, $fecha_fin = null) {
        if (Yii::$app->user->identity->id_usuario != 110) {
            throw new \yii\web\HttpException(419, 'No autorizado');
        }

        // Validar parámetros obligatorios
        if (empty($fecha_inicio) || empty($fecha_fin)) {
            Yii::$app->session->setFlash('error', 'Debe llenar los campos Fecha Inicio, Fecha Fin.');
            return $this->redirect(['reportesemestralnuri']);
        }

        // Usuario
        $usuario = Usuarios::findOne($id_usuario);

        // nombres de tabla (usa tableName() para evitar errores)
        $hojaTable = Hojasruta::tableName(); // normalmente "hojas_ruta"

        /* -------------------------
       Subquery: contar registros por NUR
       (por defecto cuenta en toda la tabla; más abajo te muestro
        cómo contar solo dentro del mismo fk_usuario si lo necesitas)
       ------------------------- */
        $subQueryCount = (new \yii\db\Query())
            ->select(['nur', 'total' => new \yii\db\Expression('COUNT(*)')])
            ->from($hojaTable)
            ->groupBy('nur');

        // Query principal: alias 'h'
        $query = Hojasruta::find()
            ->alias('h')
            ->where([
                'h.fk_usuario' => $id_usuario,
                'h.activo' => 1,   // lo pones junto aquí
            ])
            // si quieres *incluir* nur que empiezan con I/ usa 'like'
            // si quieres *excluir* los que empiezan con I/ usa 'not like'
            ->andWhere(['like', 'h.nur', 'I/%', false])
            ->leftJoin(['c' => $subQueryCount], 'c.nur = h.nur')
            ->with(['documento', 'seguimiento']); // evita N+1

        // fechas
        if ($fecha_inicio) {
            $query->andWhere(['>=', 'h.fecha_registro', $fecha_inicio]);
        }
        if ($fecha_fin) {
            $query->andWhere(['<=', 'h.fecha_registro', $fecha_fin]);
        }

        // Lógica de inclusión:
        // - incluir fila si c.total = 1  (nur único)
        // - o incluir fila si c.total > 1 pero su codigo NO ES 'S/C' ni 'S/N'
        $query->andWhere([
            'or',
            ['c.total' => 1],
            ['not in', 'h.codigo', ['S/C', 'S/N', 'SC', 'SN']]
        ]);

        // orden y ejecución
        $registros = $query->orderBy(['h.nur' => SORT_DESC])->all();

        // Cabeceras con UTF-8
        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        header("Content-Disposition: attachment;filename=\"reporte_nuri.xls\"");
        header("Cache-Control: max-age=0");

        ini_set("pcre.backtrack_limit", "5000000");

        // BOM UTF-8
        echo "\xEF\xBB\xBF";

        // ---------------- Tabla de datos ----------------
        echo "<table border='1' cellspacing='0' cellpadding='4'>";

        // ----------------- Cabecera logo ----------------
        $logoUrl = \yii\helpers\Url::to('@web/images/encabezado_presidencia_estado.png', true);

        echo "<tr>
                <td colspan='3' width='33%' align='left' style='vertical-align:middle;'>
                    <img src='{$logoUrl}'
                        width='230' height='70'
                        style=\"display:block; mso-width-source:userset; mso-height-source:userset;\">
                </td>
                <td colspan='1' width='33%' align='center'></td>
                <td colspan='3' width='33%' align='right' style='font-style: italic; vertical-align:middle;'>
                    Entidad Ejecutora de Conversión a Gas Natural Vehícular<br>
                    Fecha: " . date('d/m/Y') . "
                </td>
            </tr>
        ";

        // ---------------- Titulo -------------------------
        echo "<tr>
                <td style='text-align: center; background-color: #D8D8D8; padding: 7px;' colspan='7'>
                    <b><u>REPORTE NURI</u></b>
                </td>
            </tr>
        ";

        // ---------------- Datos del usuario ---------------
        echo "<tr>
                <th width='15%' align='right'>Nombre: </th>
                <td colspan='6'>" . ($usuario ? Html::encode($usuario->nombre) : 'No encontrado') . "</td>
            </tr>
            <tr>
                <th width='15%' align='right'>&Aacute;rea/Unidad: </th>
                <td colspan='6'>" . ($usuario && $usuario->fkArea ? Html::encode($usuario->fkArea->area) : 'No encontrado') . "</td>
            </tr>
        ";
        // ---------------- Contenido ---------------
        echo "<tr>
                <th style='background-color:#f2f2f2; font-weight:bold;'>#</th>
                <th style='background-color:#f2f2f2; font-weight:bold;'>NURI</th>
                <th style='background-color:#f2f2f2; font-weight:bold;'>CITE</th>
                <th style='background-color:#f2f2f2; font-weight:bold;'>Referencia</th>
                <th style='background-color:#f2f2f2; font-weight:bold;'>Fecha de generación del NURI</th>
                <th style='background-color:#f2f2f2; font-weight:bold;'>Fecha Derivación del NURI</th>
                <th style='background-color:#f2f2f2; font-weight:bold;'>Estado</th>
            </tr>
        ";

        $i = 1;
        foreach ($registros as $r) {
            echo "<tr>";
            echo "<td>" . $i++ . "</td>";
            echo "<td>" . Html::encode($r->nur) . "</td>";
            echo "<td>" . Html::encode($r->codigo) . "</td>";
            echo "<td>" . (
                $r->documento && $r->documento->referencia !== null && strtolower(trim($r->documento->referencia)) !== 'null'
                ? Html::encode($r->documento->referencia)
                : 'Sin referencia'
            ) . "</td>";
            echo "<td>" . Yii::$app->formatter->asDate($r->fecha_registro, 'php:Y-m-d') . "</td>";
            echo "<td>" . ($r->seguimiento
                ? Yii::$app->formatter->asDate($r->seguimiento->fecha_derivacion, 'php:Y-m-d')
                : 'No disponible') . "</td>";
            echo "<td>" . Html::encode($r->seguimiento->fkEstado->estado) . "</td>";
            echo "</tr>";
        }

        echo "</table>";

        exit;
    }


    //Acción para generar REPORTE GENERAL
    public function actionGenerarReporteGeneral($fecha_inicio_general = null, $fecha_fin_general = null) {
        if (Yii::$app->request->get('submit') === 'pdf') {
            return $this->redirect([
                'reporte/generar-pdf-general',
                'fecha_inicio_general' => $fecha_inicio_general,
                'fecha_fin_general' => $fecha_fin_general,
            ]);
        }

        if (Yii::$app->request->get('submit') === 'excel') {
            return $this->redirect([
                'reporte/generar-excel-general',
                'fecha_inicio_general' => $fecha_inicio_general,
                'fecha_fin_general' => $fecha_fin_general,
            ]);
        }
    }

    ////REPORTES GENERAL PDF
    public function actionGenerarPdfGeneral($fecha_inicio_general = null, $fecha_fin_general = null) {
        if (Yii::$app->user->identity->id_usuario != 110) {
            throw new \yii\web\HttpException(419, 'No autorizado');
        }

        // Validar que los parámetros no estén vacíos
        if (empty($fecha_inicio_general) || empty($fecha_fin_general)) {
            Yii::$app->session->setFlash('error', 'Debe seleccionar Fecha Inicio, Fecha Fin.');
            return $this->redirect(['reportesemestralnuri']); // o la ruta de tu vista principal
        }

        // nombres de tabla
        $hojaTable = Hojasruta::tableName();

        // Subquery para contar cuántas veces aparece cada nur
        $subQueryCount = (new \yii\db\Query())
            ->select(['nur', 'total' => new \yii\db\Expression('COUNT(*)')])
            ->from($hojaTable)
            ->groupBy('nur');

        // Query principal con alias y relaciones
        $query = Hojasruta::find()
            ->alias('h')
            ->where([
                'h.activo' => 1
            ])
            ->leftJoin(['c' => $subQueryCount], 'c.nur = h.nur')
            ->with(['documento', 'seguimiento']); // eager load

        // filtros de fechas
        if ($fecha_inicio_general) {
            $query->andWhere(['>=', 'h.fecha_registro', $fecha_inicio_general]);
        }
        if ($fecha_fin_general) {
            $query->andWhere(['<=', 'h.fecha_registro', $fecha_fin_general]);
        }

        // lógica: incluir si nur es único, o si se repite pero su codigo != S/C ni S/N
        $query->andWhere([
            'or',
            ['c.total' => 1],
            ['not in', 'h.codigo', ['S/C', 'S/N', 'SC', 'SN']]
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query->orderBy(['h.nur' => SORT_DESC]),
            'pagination' => false
        ]);

        // 2. Renderizar la vista parcial (solo el contenido que irá al PDF)
        $content = $this->renderPartial('semestral_pdf_general', [
            'dataProvider' => $dataProvider,
        ]);

        // 3. Configurar el PDF
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE,
            'format' => Pdf::FORMAT_LETTER,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_DOWNLOAD, // puedes usar Pdf::DEST_BROWSER si quieres mostrarlo
            'filename' => 'reporte_general_nur_nuri.pdf',
            'marginLeft' => 10,
            'marginRight' => 10,
            'marginTop' => 25,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => 'table { font-size: 10pt; border-collapse: collapse; width: 100%;} 
                            th { background: #f0f0f0; }
                            .reporte-tabla {font-size: 10px; border-collapse: collapse; width: 100%;}
                            .reporte-tabla th, .reporte-tabla td {border: 1px solid gray; padding: 5px; text-align: left;}',
            'options' => ['title' => 'Reporte General NUR/NURI'],
            'methods' => [
                'SetHeader' => ['<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;">
                    <tr>
                        <td width="33%"><img src="./images/encabezado_presidencia_estado.png" style="width:200px; height:60px;"></td>
                        <td width="33%" align="center"></td>
                        <td width="33%" align="right" style="font-style: italic;" valign="middle">Entidad Ejecutora de Conversión a Gas Natural Vehícular<br>Fecha: ' . date('d/m/Y') . '</td>
                    </tr>
                </table>'],
                'SetFooter' => ['<table width="100%" style="border-top: 1px solid; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000000; font-weight:bold;">
                    <tr>
                        <td width="33%" align="left" style="font-style: italic;">Sistema de Administración de Correspondencia</td>
                        <td width="33%" align="center">{PAGENO}/{nbpg}</td>
                        <td width="33%" align="right" style="text-align: right; font-style: italic;  ">S.A.C.</td>
                    </tr>
                </table>'],
            ]

        ]);

        // 4. Renderizar el PDF
        return $pdf->render();
    }

    ////REPORTES GENERAL EXCEL
    public function actionGenerarExcelGeneral($fecha_inicio_general = null, $fecha_fin_general = null) {
        if (Yii::$app->user->identity->id_usuario != 110) {
            throw new \yii\web\HttpException(419, 'No autorizado');
        }

        // Validar parámetros obligatorios
        if (empty($fecha_inicio_general) || empty($fecha_fin_general)) {
            Yii::$app->session->setFlash('error', 'Debe llenar los campos Fecha Inicio, Fecha Fin.');
            return $this->redirect(['reportesemestralnuri']);
        }

        // nombres de tabla (usa tableName() para evitar errores)
        $hojaTable = Hojasruta::tableName(); // normalmente "hojas_ruta"

        /* -------------------------
       Subquery: contar registros por NUR
       (por defecto cuenta en toda la tabla; más abajo te muestro
        cómo contar solo dentro del mismo fk_usuario si lo necesitas)
       ------------------------- */
        $subQueryCount = (new \yii\db\Query())
            ->select(['nur', 'total' => new \yii\db\Expression('COUNT(*)')])
            ->from($hojaTable)
            ->groupBy('nur');

        // Query principal: alias 'h'
        $query = Hojasruta::find()
            ->alias('h')
            ->where([
                'h.activo' => 1,   // lo pones junto aquí
            ])
            // si quieres *incluir* nur que empiezan con I/ usa 'like'
            // si quieres *excluir* los que empiezan con I/ usa 'not like'
            //->andWhere(['like', 'h.nur', 'I/%', false])
            ->leftJoin(['c' => $subQueryCount], 'c.nur = h.nur')
            ->with(['documento', 'seguimiento']); // evita N+1

        // fechas
        if ($fecha_inicio_general) {
            $query->andWhere(['>=', 'h.fecha_registro', $fecha_inicio_general]);
        }
        if ($fecha_fin_general) {
            $query->andWhere(['<=', 'h.fecha_registro', $fecha_fin_general]);
        }

        // Lógica de inclusión:
        // - incluir fila si c.total = 1  (nur único)
        // - o incluir fila si c.total > 1 pero su codigo NO ES 'S/C' ni 'S/N'
        $query->andWhere([
            'or',
            ['c.total' => 1],
            ['not in', 'h.codigo', ['S/C', 'S/N', 'SC', 'SN']]
        ]);

        // orden y ejecución
        $registros = $query->orderBy(['h.nur' => SORT_DESC])->all();

        // Cabeceras con UTF-8
        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        header("Content-Disposition: attachment;filename=\"reporte_general.xls\"");
        header("Cache-Control: max-age=0");

        ini_set("pcre.backtrack_limit", "5000000");

        // BOM UTF-8
        echo "\xEF\xBB\xBF";


        // ---------------- Tabla de datos ----------------
        echo "<table border='1' cellspacing='0' cellpadding='4'>";

        // ----------------- Cabecera logo ----------------
        $logoUrl = \yii\helpers\Url::to('@web/images/encabezado_presidencia_estado.png', true);

        echo "<tr>
                <td colspan='3' width='33%' align='left' style='vertical-align:middle;'>
                    <img src='{$logoUrl}'
                        width='230' height='70'
                        style=\"display:block; mso-width-source:userset; mso-height-source:userset;\">
                </td>
                <td colspan='3' width='33%' align='center'></td>
                <td colspan='2' width='33%' align='right' style='font-style: italic; vertical-align:middle;'>
                    Entidad Ejecutora de Conversión a Gas Natural Vehícular<br>
                    Fecha: " . date('d/m/Y') . "
                </td>
            </tr>
        ";

        // ---------------- Titulo -------------------------
        echo "<tr>
                <td style='text-align: center; background-color: #D8D8D8; padding: 7px;' colspan='8'>
                    <b><u>REPORTE GENERAL NUR/NURIS</u></b>
                </td>
            </tr>
        ";

        echo "<tr>
                <th style='background-color:#f2f2f2; font-weight:bold;'>#</th>
                <th style='background-color:#f2f2f2; font-weight:bold;'>NUR/NURI</th>
                <th style='background-color:#f2f2f2; font-weight:bold;'>CITE</th>
                <th style='background-color:#f2f2f2; font-weight:bold;'>Referencia</th>
                <th style='background-color:#f2f2f2; font-weight:bold;'>Fecha de generación del NUR/NURI</th>
                <th style='background-color:#f2f2f2; font-weight:bold;'>Fecha Derivación del NUR/NURI</th>
                <th style='background-color:#f2f2f2; font-weight:bold;'>Nombre1</th>
                <th style='background-color:#f2f2f2; font-weight:bold;'>&Aacute;rea/Unidad</th>
            </tr>
        ";

        $i = 1;
        foreach ($registros as $r) {
            // Usuario
            $usuario = Usuarios::findOne($r->fk_usuario);

            // ---------------- Contenido ---------------
            echo "<tr>";
            echo "<td>" . $i++ . "</td>";
            echo "<td>" . Html::encode($r->nur) . "</td>";
            echo "<td>" . Html::encode($r->codigo) . "</td>";
            echo "<td>" . (
                $r->documento && $r->documento->referencia !== null && strtolower(trim($r->documento->referencia)) !== 'null'
                ? Html::encode($r->documento->referencia)
                : 'Sin referencia'
            ) . "</td>";
            echo "<td>" . Yii::$app->formatter->asDate($r->fecha_registro, 'php:Y-m-d') . "</td>";
            echo "<td>" . ($r->seguimiento
                ? Yii::$app->formatter->asDate($r->seguimiento->fecha_derivacion, 'php:Y-m-d')
                : 'No disponible') . "</td>";
            echo "<td>"  . ($usuario ? Html::encode($usuario->nombre) : 'No encontrado') . "</td>";
            echo "<td>" . ($usuario && $usuario->fkArea ? Html::encode($usuario->fkArea->area) : 'No encontrado') . "</td>";
            echo "</tr>";
        }

        echo "</table>";

        exit;
    }

    // Acción para generar el Excel
    /*public function actionGenerarExcel($id_usuario, $fecha_inicio = null, $fecha_fin = null)
    {
        if (Yii::$app->user->identity->id_usuario != 110) {
            throw new \yii\web\HttpException(419, 'No autorizado');
        }

        // Validar que los parámetros no estén vacíos
        if (empty($fecha_inicio) || empty($fecha_fin) || empty($gestion)) {
            Yii::$app->session->setFlash('error', 'Debe seleccionar Fecha Inicio, Fecha Fin y Gestión.');
            return $this->redirect(['reportesemestralnur']); // o la ruta de tu vista principal
        }

        $query = Hojasruta::find()->where(['fk_usuario' => $id_usuario]);

        if ($fecha_inicio) {
            $query->andWhere(['>=', 'fecha_registro', $fecha_inicio]);
        }
        if ($fecha_fin) {
            $query->andWhere(['<=', 'fecha_registro', $fecha_fin]);
        }
        //if ($gestion) {
           // $query->andWhere(['gestion' => $gestion]);
        }//

        $registros = $query->orderBy(['fecha_registro' => SORT_DESC])->all();

        // Cabeceras con UTF-8
        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        header("Content-Disposition: attachment;filename=\"reporte_semestral_nuri.xls\"");
        header("Cache-Control: max-age=0");

        // BOM UTF-8
        echo "\xEF\xBB\xBF";

        echo "<table border='1'>";
        echo "<tr>
            <th>NUR</th>
            <th>Código</th>
            <th>Fecha Registro</th>
            <th>Gestión</th>
            <th>Usuario</th>
          </tr>";

        foreach ($registros as $r) {
            $usuarioNombre = $r->fkUsuario ? $r->fkUsuario->nombre : 'No asignado';
            echo "<tr>
                <td>{$r->nur}</td>
                <td>{$r->codigo}</td>
                <td>{$r->fecha_registro}</td>
                <td>{$r->gestion}</td>
                <td>{$usuarioNombre}</td>
              </tr>";
        }
        echo "</table>";
        exit;
    }*/
}
