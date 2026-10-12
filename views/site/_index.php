<?php 

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use miloschuman\highcharts\Highcharts;
/* @var $this yii\web\View */

use app\models\Seguimientos;

?>

<?php //=date('H:i:s');?>
<?= Seguimientos::countQueDebenLlegar(1,Yii::$app->user->identity->id_usuario)+Seguimientos::countQueDebenLlegar(0,Yii::$app->user->identity->id_usuario)?>