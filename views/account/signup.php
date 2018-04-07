<?php

/**
 * @var $this  \yii\web\View
 * @var $model \app\forms\SignupForm
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Signup');

?>

<div class="row">
    <div class="col-lg-12">
        <h1><?= $this->title ?></h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <?php $form = ActiveForm::begin([
            'id' => 'signup-form',
            'validateOnBlur' => false,
        ]) ?>
            <?=
                $form
                    ->field($model, 'username')
                    ->textInput(['autofocus' => true])
            ?>
            <?=
                $form
                    ->field($model, 'email')
            ?>
            <?=
                $form
                    ->field($model, 'password')
                    ->passwordInput()
            ?>
            <div class="form-group">
                <?= Html::submitButton($this->title) ?>
            </div>
        <?php ActiveForm::end() ?>
    </div>
</div>
