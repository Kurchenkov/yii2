<?php

namespace app\controllers;

use yii\web\Controller;

class MyController extends Controller
{
    /**
     * Displey my page.
     * 
     * @return string
     */
    public function actionStart()
    {
        return $this->render('index');
    }
}