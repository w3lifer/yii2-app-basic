<?php

namespace app\controllers;

use app\base\BaseController;
use app\forms\LoginForm;
use app\forms\PasswordResetForm;
use app\forms\RequestPasswordResetForm;
use app\forms\SignupForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;

/**
 * Account controller.
 */
class AccountController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => [
                            'signup',
                            'login',
                            'request-password-reset',
                            'reset-password',
                        ],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
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
     * Signs user up.
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->user->login($user)) {
                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('signup', compact('model'));
    }

    /**
     * Logs in a user.
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if (
            $model->load(Yii::$app->request->post()) &&
            $model->login()
        ) {
            return $this->goBack();
        }
        return $this->render('login', compact('model'));
    }

    /**
     * Requests password reset.
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new RequestPasswordResetForm();
        if (
            $model->load(Yii::$app->request->post()) &&
            $model->validate()
        ) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash(
                    'flash-success',
                    Yii::t('app', 'Check your email for further instructions.')
                );
                return $this->goHome();
            }
            Yii::$app->session->setFlash(
                'flash-error',
                Yii::t(
                    'app',
                    'Sorry, we are unable to reset password for the provided email address.'
                )
            );
        }
        return $this->render('request-password-reset', compact('model'));
    }

    /**
     * Resets password.
     * @param string $token
     * @return mixed
     * @throws \yii\web\BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new PasswordResetForm($token);
        } catch (InvalidArgumentException $exception) {
            throw new BadRequestHttpException($exception->getMessage());
        }
        if (
            $model->load(Yii::$app->request->post()) &&
            $model->validate() &&
            $model->resetPassword()
        ) {
            Yii::$app->session->setFlash(
                'flash-success',
                Yii::t('app', 'New password saved.')
            );
            return $this->goHome();
        }
        return $this->render('reset-password', compact('model'));
    }

    /**
     * Logs out the current user.
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
