<?php
/**
 * Index view for PhoneController
 *
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $searchModel app\models\PhoneNumber
 */
use app\models\PhoneNumber;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Phone numbers list';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <h1><?= Html::encode($this->title); ?></h1>
    <p><a href="<?= Url::to(['phone/create']);?>" class="btn btn-primary">Create new phone number</a></p>
    <div class="row">
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id',
                [
                    'attribute' => 'number',
                    'value' => function( PhoneNumber $model, $key, $index){ return PhoneNumber::format($model->number); }
                ],
                'address',
                [
                    'class' => 'yii\grid\ActionColumn',
                ]
            ]
        ])?>
    </div>
</div>