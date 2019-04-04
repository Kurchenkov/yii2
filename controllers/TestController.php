<?php

namespace app\controllers;

use app\models\Product;
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
        /* возвращаем из метода текст
        return 'Hi, my name is Andrey Kurchenkov. I\'am a yii2 programmer.';
        */

        /* возвращаем из метода результат выполнения renderContent()
        return $this->renderContent('Yii2 is a well-known framework in Russia and old Soviet republics.');
        */
        
        /* рендерим вьюху
         return $this->render('index');
        */

        $product = new Product();
        $product->id=1;
        $product->name='First';
        $product->category='auto';
        $product->price=111;
        return $this->render('index', [
            'data' => 'Данные',
            'product' => $product,
        ]);
        
    }
}