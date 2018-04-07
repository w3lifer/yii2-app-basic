<?php

/**
 * @var $this    \yii\web\View
 * @var $content string
 * @var $user    \app\models\User
 */

use app\assets\MainAsset;
use app\helpers\AssetHelper;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;

MainAsset::register($this);

$this->registerJsFile(AssetHelper::getPathToJsFileByRoute(ROUTE), [
    'depends' => [
        'app\assets\MainAsset',
    ],
]);

$user = Yii::$app->user->identity;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <title><?= Html::encode($this->title) ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="<?= ROUTE_AS_ID ?>">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [

            // About

            ['label' => Yii::t('main', 'About'), 'url' => ['main/about']],

            // Contact

            ['label' => Yii::t('main', 'Contact'), 'url' => ['main/contact']],

            // Login

            Yii::$app->user->isGuest
                ?
                    [
                        'label' => Yii::t('main', 'Login'),
                        'url' => ['account/login'],
                    ]
                :
                    [
                        'label' => $user->email,
                        'url' => ['account/index'],
                    ],

            // Signup

            Yii::$app->user->isGuest
                ?
                    [
                        'label' => Yii::t('main', 'Signup'),
                        'url' => ['account/signup'],
                    ]
                :
                    '<li>' .
                        Html::beginForm(['account/logout'], 'post', [
                            'id' => 'logout-form',
                        ]) .
                            Html::submitButton(
                                Yii::t('main', 'Logout'),
                                [
                                    'id' => 'logout-button',
                                    'class' => 'btn btn-link',
                                ]
                            ) .
                        Html::endForm() .
                    '</li>',
        ],
    ]);
    NavBar::end();
    ?>
    <div class="container">
        <?= $content ?>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
