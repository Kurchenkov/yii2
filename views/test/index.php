<?php 
/* @var $this yii\web\View */
/* @var $data string */
/* @var $product app\models\Product */
/* @var $service app\controllers\TestController */

use yii\web\View;


?>
<h1>Test</h1>
<?= \yii\widgets\DetailView::widget(['model' => $product]) ?>
    <p><i>This is the result of the component</i></p>
<?= $service ?>