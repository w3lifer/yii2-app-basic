<?php

namespace app\controllers;

use app\base\BaseController;
use app\forms\ContactForm;
use Yii;

/**
 * Main controller.
 */
class MainController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if (
            $model->load(Yii::$app->request->post()) &&
            $model->contact(Yii::$app->params['supportEmail'])
        ) {
            Yii::$app->session->setFlash('flash-contact-form-submitted');
            return $this->refresh();
        }
        return $this->render('contact', compact('model'));
    }
}
