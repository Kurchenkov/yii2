<?php

namespace app\controllers;

use app\components\TestService;
use app\models\Product;
use yii\base\BaseObject;
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
            'name' => 'my best',
            'category' => 'job',
            'price' => 123,
        ]);

        return $this->render('index', [
            'data' => 'Данные',
            'product' => $product,
            'service' => $service,
        ]);
    }
}