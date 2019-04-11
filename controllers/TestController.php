<?php

namespace app\controllers;

use app\components\TestService;
use app\models\Product;
use yii\base\BaseObject;
use yii\helpers\VarDumper;
use yii\web\Controller;


class TestController extends Controller
{
    /**
     * Displays test page.
     *
     * @return string
     */
    public function actionIndex()
    {
        $service = \Yii::$app->test->run();

        $product = new Product([
            'id' => 1,
            'name' => '   my favorate   ',
            'category' => 'car',
            'price' => '100',
            'created_at' => time(),
        ]);

        //return VarDumper::dumpAsString($product->attributes(),4,true);
        //return VarDumper::dumpAsString($product->validate());
        $product->validate();
        return VarDumper::dumpAsString($product->safeAttributes(),4,true);

        return $this->render('index', [
            'data' => 'Данные',
            'product' => $product,
            'service' => $service,
        ]);
    }
}