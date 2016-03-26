<?php
/**
 * User Create/Update Form
 *
 * @var $this yii\web\View
 * @var $model app\models\User
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$isNew = 'create' === $model->scenario;

?>
<h1><?= Html::encode($this->title); ?></h1>
<p><a href="<?= Url::to(['user/index']);?>" class="btn btn-primary">Return to user list</a></p>
<div class="row">
    <?php $form = ActiveForm::begin();?>
    <?= $form->field($model, 'email');?>
    <?= $form->field($model, 'name');?>
    <?= $form->field($model, 'password')->passwordInput();?>
    <?= $form->field($model, 'password_repeat')->passwordInput();?>
    <div class="form-group">
        <?= Html::submitButton( $isNew ? 'Save':'Update', ['class' => 'btn btn-primary', 'name' => 'signup-button'])?>
    </div>
    <?php $form->end();?>
</div>