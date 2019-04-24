<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\Task;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * home work
     */
    public function actionTest()
    {
        // создадим запись в таблице user
        $user = new User();
        $user->username = 'Nikolay';
        $user->password_hash = 'password-9';
        $user->creator_id = '9';
        $user->created_at = time();
        _log($user->save());


        // создадим три связаные (с записью в user) запиcи в task, используя метод link()
        $task_1 = new Task();
        $task_1->title = 'new_task_1';
        $task_1->description = 'work_1';
        $task_1->created_at = time();
        $task_1->link(Task::RELATION_CREATOR, $user);
        $task_2 = new Task();
        $task_2->title = 'new_task_2';
        $task_2->description = 'work_2';
        $task_2->created_at = time();
        $task_2->link(Task::RELATION_CREATOR, $user);
        $task_3 = new Task();
        $task_3->title = 'new_task_3';
        $task_3->description = 'work_3';
        $task_3->created_at = time();
        $task_3->link(Task::RELATION_CREATOR, $user);


        // прочитаем из базы все записи из User, применив жадную подгрузку связанных данных из Task,
        // с запросами без JOIN.
        $models = Task::find()->with(Task::RELATION_CREATOR)->asArray()->all();
        _log($models);


        // прочитаем из базы все записи из User, применив жадную подгрузку связанных данных из Task,
        // с запросом содержащим JOIN.
        $models = Task::find()->joinWith(Task::RELATION_CREATOR)->asArray()->all();
        _log($models);

        // проверить - добавить с помощью релейшена getAccessedUsers связь между записями в Task и User (метод link())
        // и получить из модели задачи список пользователей которым она доступна.
        $user = User::findOne(4);
        $task = Task::findOne(3);
        $task->link(Task::RELATION_ACCESSED_USERS, $user);
        _log($task->getAccessedUsers()->all());


        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('test', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
