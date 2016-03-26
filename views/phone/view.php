<?php
/**
 * View for PhoneController
 * @var $this yii\web\View
 * @var $model app\models\PhoneNumber
 */
use app\models\PhoneNumber;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = 'Phone details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <h1><?= Html::encode($this->title); ?></h1>
    <p><a href="<?= Url::to(['phone/update', 'id' => $model->id ]);?>" class="btn btn-primary">Edit phone number</a></p>
    <div class="row">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'label' => $model->getAttributeLabel('number'),
                    'value' => PhoneNumber::format($model->number),
                ],
                'address',
                'description',
            ]
        ])?>
        <p><a href="<?= Url::to(['phone/index']);?>" class="btn btn-primary">Return to phone numbers list</a></p>
    </div>
</div>