<?php

namespace app\forms;

use app\models\User;
use Yii;
use yii\base\Model;

/**
 * Request password reset form.
 */
class RequestPasswordResetForm extends Model
{
    /**
     * @var string
     */
    public $email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            [
                'email',
                'exist',
                'targetClass' => 'app\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app', 'Email'),
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     * @return bool
     */
    public function sendEmail()
    {
        $user = User::findOne([
            'email' => $this->email,
            'status' => User::STATUS_ACTIVE,
        ]);
        if (!$user) {
            return false;
        }
        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }
        return
            Yii::$app
                ->mailer
                ->compose(
                    [
                        'html' => 'request-password-reset-html',
                        'text' => 'request-password-reset-text',
                    ],
                    compact('user')
                )
                ->setFrom([
                    Yii::$app->params['supportEmail'] =>
                        Yii::$app->name . ' - ' . Yii::t('app', 'Robot')
                ])
                ->setTo($this->email)
                ->setSubject(
                    Yii::t('app', 'Password reset for') . ' ' . Yii::$app->name
                )
                ->send();
    }
}
