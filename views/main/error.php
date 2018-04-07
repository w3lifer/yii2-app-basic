<?php

/**
 * @var $this      \yii\web\View
 * @var $name      string
 * @var $message   string
 * @var $exception \yii\web\HttpException
 */

use yii\helpers\Html;

$this->title = $exception->statusCode;

?>

<div class="row">
    <div class="col-lg-12">
        <h1><?= $this->title ?></h1>
    </div>
</div>

<div class="alert alert-danger">
    <?= nl2br(Html::encode($message)) ?>
</div>
