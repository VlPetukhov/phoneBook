<?php
/**
 * ajaxSearch view for PhoneController
 *
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $searchModel app\models\PhoneNumber
 */
use app\models\PhoneNumber;
?>
    <div class="row">
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'header' => 'Number',
                    'value' => function( PhoneNumber $model, $key, $index){ return PhoneNumber::format($model->number); }
                ],
                [
                    'header' => 'Surname, Name',
                    'value' => function( PhoneNumber $model, $key, $index){ return "{$model->surname} {$model->name}"; }
                ],
                [
                    'header' => 'Address',
                    'value' => function( PhoneNumber $model, $key, $index){ return $model->address; }
                ],
                [
                    'header' => 'Description',
                    'value' => function( PhoneNumber $model, $key, $index){ return $model->description; }
                ],
            ]
        ])?>
    </div>