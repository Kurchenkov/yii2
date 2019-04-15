<?php

namespace app\controllers;

use app\components\TestService;
use app\models\Product;
use Codeception\Module\Queue;
use yii\base\BaseObject;
use yii\db\Query;
use yii\helpers\VarDumper;
use yii\web\Controller;


class TestController extends Controller
{
    /**
     * Displays test page.
     *
     * @return string
     * @param string $clearUserTable it's a command that remove all rows into 'user' table.
     * @param string $dataUserInsert it's a command that insert into 'user' table new rows.
     * @param string $firstRowInUser it's a command that select first row from 'user' table.
     * @param string $rowsInUserExcludingOne it's a command that select rows from 'user' table from 2 to last.
     * @param string $rowsInUser it's a command that count rows into 'user' table.
     */
    public function actionIndex()
    {
        $cleanUserTable = \Yii::$app->db->createCommand('TRUNCATE TABLE user')->execute();
        _log($cleanUserTable);

        $dataUserInsert = \Yii::$app->db->createCommand()->batchInsert('user', ['username', 'password_hash', 'creator_id', 'created_at'],
        [
            ['Andrew', 'password-000', 000, time()],
            ['Semen', 'password-111', 111, time()],
            ['Ivan', 'password-222', 222, time()],
            ['Boris', 'password-333', 333, time()],
        ])->execute();
        _log($dataUserInsert);


        $queryFirstRow = new Query();
        $firstRowInUser = $queryFirstRow->from('user')
            ->where(['id' => 1])
            ->all();
        _log($firstRowInUser);

        $queryRowsFrom2ToLast = new Query();
        $rowsInUserExcludingOne = $queryRowsFrom2ToLast->from('user')
            ->where(['>','id',1])
            ->orderBy(['username' => SORT_ASC])
            ->all();
        _log($rowsInUserExcludingOne);


        $queryCount = new Query();
        $rowsInUser = $queryCount->from('user')->count();
        _log($rowsInUser);


        $service = \Yii::$app->test->run();
        $product = new Product([
            'id' => 1,
            'name' => '   my favorate   ',
            'category' => 'car',
            'price' => '100',
           'created_at' => time(),
        ]);
        return $this->render('index', [
            'data' => 'Данные',
            'product' => $product,
            'service' => $service,
        ]);
    }
}
