<?php

namespace app\forms;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * Signup form.
 */
class SignupForm extends Model
{
    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            [
                'username',
                'unique',
                'targetClass' => 'app\models\User',
            ],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'string', 'max' => 255],
            ['email', 'email'],
            [
                'email',
                'unique',
                'targetClass' => 'app\models\User',
            ],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t(ROUTE, 'Username'),
            'email'    => Yii::t(ROUTE, 'Email'),
            'password' => Yii::t(ROUTE, 'Password'),
        ];
    }

    /**
     * Signs user up.
     * @return User|null The saved model or null if saving fails.
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }
}
