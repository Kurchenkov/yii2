<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accessed tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'label' => 'Title',
                'value' => function(\app\models\Task $model){
                    return Html::a($model->title, ['view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
            'description:ntext',
            [
                'label' => 'Username',
                'value' => function(\app\models\Task $model){
                    return Html::a($model->creator->username, ['user/view', 'id' => $model->creator_id]);
                },
                'format' => 'raw',
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]); ?>

    <?php Pjax::end(); ?>


</div>
