<?php
/**
 * Index view for UserController
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $searchModel app\models\User
 */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Users list';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <h1><?= Html::encode($this->title); ?></h1>
    <?php if (1 == Yii::$app->user->getId()): ?>
    <p><a href="<?= Url::to(['user/create']);?>" class="btn btn-primary">Create new user</a></p>
    <?php endif; ?>
    <div class="row">
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id',
                'name',
                'email',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'visibleButtons' => [
                        'update' => function ($model, $key, $index){ return 1 == Yii::$app->user->getId(); },
                        'delete' => function ($model, $key, $index){ return (1 != $model->id) && 1 == Yii::$app->user->getId(); },
                    ],
                ]
            ]
        ])?>
    </div>
</div>