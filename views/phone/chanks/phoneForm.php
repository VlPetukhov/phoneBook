<?php
/**
 * Phone Create/Update Form
 *
 * @var $this yii\web\View
 * @var $model app\models\PhoneNumber
 */
use app\models\PhoneNumber;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$isNew = 'create' === $model->scenario;

?>
<h1><?= Html::encode($this->title); ?></h1>
<p><a href="<?= Url::to(['phone/index']);?>" class="btn btn-primary">Return to phone numbers list</a></p>
<div class="row">
    <?php $form = ActiveForm::begin();?>
    <?= $form->field(
        $model,
        'number',
        [
            'inputOptions' => [
                'class' => 'form-control',
                'value' => PhoneNumber::format($model->number),
            ]
        ]
    );?>
    <?= $form->field($model, 'surname');?>
    <?= $form->field($model, 'name');?>
    <?= $form->field($model, 'address');?>
    <?= $form->field($model, 'description')->textarea();?>
    <div class="form-group">
        <?= Html::submitButton( $isNew ? 'Save':'Update', ['class' => 'btn btn-primary', 'name' => 'signup-button'])?>
    </div>
    <?php $form->end();?>
</div>