<?php

/**
 * @var $this  \yii\web\View
 * @var $model \app\forms\PasswordResetForm
 * @var $form  \yii\widgets\ActiveForm
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Reset password');

?>

<div class="row">
    <div class="col-lg-12">
        <h1><?= $this->title ?></h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <?php $form = ActiveForm::begin([
            'id' => 'reset-password-form',
        ]) ?>
            <?=
                $form
                    ->field($model, 'password')
                    ->passwordInput(['autofocus' => true])
            ?>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save')) ?>
            </div>
        <?php ActiveForm::end() ?>
    </div>
</div>
