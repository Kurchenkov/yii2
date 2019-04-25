<?php

namespace app\controllers;

use app\components\TestService;
use app\models\Product;
use app\models\Task;
use Codeception\Module\Queue;
use yii\base\BaseObject;
use yii\db\Query;
use yii\helpers\VarDumper;
use yii\web\Controller;


class   TestController extends Controller
{
    /**
     * Displays test page.
     *
     * @return string
     */
    public function actionIndex()
    {
        $product = new Product([
            'id' => 1,
            'name' => '   my favorate   ',
            'category' => 'car',
            'price' => '100',
            'created_at' => time(),
        ]);

//        $task = new Task();
//        $task->title = 'task_test';
//        $task->description = 'study behavior';
//        $task->creator_id = 1;
//        $task->save();
//
//        _end($task);



        return $this->render('index', [
            'product' => $product,
            'service' => \Yii::$app->test->run(),
        ]);
    }

    /**
     * @throws \yii\db\Exception
     */
    public function actionInsert()
    {
        // добавляем записи в таблицу user
        \Yii::$app->db->createCommand('TRUNCATE TABLE user')->execute();
        \Yii::$app->db->createCommand()->insert('user', ['username' => 'Andrew', 'password_hash' => 'password-0', 'creator_id' => 0, 'created_at' => time()])->execute();
        \Yii::$app->db->createCommand()->insert('user', ['username' => 'Semen', 'password_hash' => 'password-1', 'creator_id' => 1, 'created_at' => time()])->execute();
        \Yii::$app->db->createCommand()->insert('user', ['username' => 'Boris', 'password_hash' => 'password-2', 'creator_id' => 2, 'created_at' => time()])->execute();
        \Yii::$app->db->createCommand()->insert('user', ['username' => 'Ivan', 'password_hash' => 'password-3', 'creator_id' => 3, 'created_at' => time()])->execute();

        // добавляем записи в таблицу task
        \Yii::$app->db->createCommand('TRUNCATE TABLE task')->execute();
        \Yii::$app->db->createCommand()->batchInsert('task',
            ['title', 'description', 'creator_id','created_at'],
            [
                ['task1', 'wake up', 1, time()],
                ['task2', 'to wash', 2, time()],
                ['task3', 'have breakfast', 3, time()]
            ]
        )->execute();
    }

    /**
     * @param string $firstRowInUser it's a command that select first row from 'user' table.
     * @param string $rowsInUserExcludingOne it's a command that select rows from 'user' table from 2 to last.
     * @param string $rowsInUser it's a command that count rows into 'user' table.
     * @param string $rowsTaskAndUser it's a command that select all rows into 'task' table and 'user' where task.created_id = user.id.
     */
    public function actionSelect()
    {
        $firstRowInUser = (new Query())->from('user')->where(['id' => 1])->all();
        _log($firstRowInUser);

        $rowsInUserExcludingOne = (new Query())->from('user')->where(['>','id',1])->orderBy(['username' => SORT_ASC])->all();
        _log($rowsInUserExcludingOne);

        $rowsInUser = (new Query())->from('user')->count();
        _log($rowsInUser);

        $rowsTaskAndUser = (new Query())->from(['t' => 'task'])->innerJoin(['u' => 'user'], 'u.id = t.creator_id' )->all();
        _end($rowsTaskAndUser);
    }
}

