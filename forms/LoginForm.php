<?php

namespace app\forms;

use app\models\User;
use Yii;
use yii\base\Model;

/**
 * Login form.
 *
 * @property \app\models\User|null $user Read-only property.
 */
class LoginForm extends Model
{
    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;

    /**
     * @var bool
     */
    public $rememberMe = true;

    /**
     * @var \app\models\User|null
     */
    private $_user;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            // Username

            ['username', 'required'],

            // Password

            ['password', 'required'],
            ['password', 'validatePassword'],

            // Remember me

            ['rememberMe', 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username'   => Yii::t('app', 'Username'),
            'password'   => Yii::t('app', 'Password'),
            'rememberMe' => Yii::t('app', 'Remember me'),
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     * @param string $attribute
     */
    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError(
                    $attribute,
                    Yii::t('app', 'Incorrect username or password.')
                );
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool
     */
    public function login()
    {
        if ($this->validate()) {
            return
                Yii::$app->user->login(
                    $this->getUser(),
                    $this->rememberMe ? 3600 * 24 * 30 : 0
                );
        }
        return false;
    }

    /**
     * Finds user by username.
     * @return \app\models\User|null
     */
    public function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }
        return $this->_user;
    }
}
