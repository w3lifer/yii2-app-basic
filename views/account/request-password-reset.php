<?php

/**
 * @var $this  \yii\web\View
 * @var $model \app\forms\RequestPasswordResetForm
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Request password reset');

?>

<div class="row">
    <div class="col-lg-12">
        <h1><?= $this->title ?></h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <?php $form = ActiveForm::begin([
            'id' => 'request-password-reset-form',
        ]) ?>
            <?=
                $form
                    ->field($model, 'email')
                    ->textInput(['autofocus' => true])
            ?>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Request')) ?>
            </div>
        <?php ActiveForm::end() ?>
    </div>
</div>
