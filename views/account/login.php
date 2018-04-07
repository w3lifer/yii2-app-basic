<?php

/**
 * @var $this  \yii\web\View
 * @var $model \app\forms\LoginForm
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Login');

?>

<div class="row">
    <div class="col-lg-12">
        <h1><?= $this->title ?></h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'validateOnBlur' => false,
        ]) ?>
            <?=
                $form
                    ->field($model, 'username')
                    ->textInput(['autofocus' => true])
            ?>
            <?=
                $form
                    ->field($model, 'password')
                    ->passwordInput()
            ?>
            <?=
                $form
                    ->field($model, 'rememberMe')
                    ->checkbox()
            ?>
            <div class="form-group">
                <?=
                    Html::a(
                        Yii::t('app', 'Forgot password?'),
                        ['account/request-password-reset']
                    )
                ?>
            </div>
            <div class="form-group">
                <?= Html::submitButton($this->title) ?>
            </div>
        <?php ActiveForm::end() ?>
    </div>
</div>
