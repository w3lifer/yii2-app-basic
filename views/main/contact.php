<?php

/**
 * @var $this  \yii\web\View
 * @var $model \app\forms\ContactForm
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Contact');

?>

<div class="row">
    <div class="col-lg-12">
        <h1><?= $this->title ?></h1>
    </div>
</div>

<?php if (Yii::$app->session->hasFlash('flash-contact-form-submitted')) : ?>
    <div class="alert alert-success">
        <?= Yii::t(
            'app',
            'Thank you for contacting us. We will respond to you as soon as possible.'
        ) ?>
    </div>
<?php else : ?>
    <div class="row">
        <div class="col-lg-4">
            <?php $form = ActiveForm::begin([
                'id' => 'contact-form',
            ]) ?>
                <?=
                    $form
                        ->field($model, 'name')
                        ->textInput(['autofocus' => true])
                ?>
                <?=
                    $form
                        ->field($model, 'email')
                ?>
                <?=
                    $form
                        ->field($model, 'subject')
                ?>
                <?=
                    $form
                        ->field($model, 'body')
                        ->textarea(['rows' => 6])
                ?>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Submit')) ?>
                </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
<?php endif ?>
