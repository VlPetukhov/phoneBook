<?php
/**
 * View for UserController
 * @var $this yii\web\View
 * @var $model app\models\User
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = 'Users details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <h1><?= Html::encode($this->title); ?></h1>
    <?php if (1 == Yii::$app->user->getId()): ?>
    <p><a href="<?= Url::to(['user/update', 'id' => $model->id ]);?>" class="btn btn-primary">Edit user</a></p>
    <?php endif; ?>
    <div class="row">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                'email'
            ]
        ])?>
        <p><a href="<?= Url::to(['user/index']);?>" class="btn btn-primary">Return to user list</a></p>
    </div>
</div>