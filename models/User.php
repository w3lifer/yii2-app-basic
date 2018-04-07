<?php

namespace app\models;

use app\base\BaseActiveRecord;
use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * User model.
 *
 * @property int    $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property string $password_reset_token
 * @property bool   $status
 * @property string $created_at
 * @property string $updated_at
 */
class User extends BaseActiveRecord implements IdentityInterface
{
    const STATUS_ACTIVE = 1;

    const STATUS_INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /*
     * -------------------------------------------------------------------------
     * yii\web\IdentityInterface
     * -------------------------------------------------------------------------
     */

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne([
            'id' => $id,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException(
            'User::findIdentityByAccessToken() method is not implemented.'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /*
     * -------------------------------------------------------------------------
     * User logic methods
     * -------------------------------------------------------------------------
     */

    /**
     * Finds user by username.
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne([
            'username' => $username,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by password reset token.
     * @param string $passwordResetToken
     * @return static|null
     */
    public static function findByPasswordResetToken($passwordResetToken)
    {
        if (!static::isPasswordResetTokenValid($passwordResetToken)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $passwordResetToken,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid.
     * @param string $passwordResetToken
     * @return bool
     */
    public static function isPasswordResetTokenValid($passwordResetToken)
    {
        if (empty($passwordResetToken)) {
            return false;
        }
        $timestamp =
            (int) substr(
                $passwordResetToken,
                strrpos($passwordResetToken, '_') + 1
            );
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * Validates password.
     * @param string $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return
            Yii::$app->security->validatePassword(
                $password,
                $this->password_hash
            );
    }

    /**
     * Generates password hash from password and sets it to the model.
     * @param string $password
     * @throws \yii\base\Exception
     */
    public function setPassword($password)
    {
        $this->password_hash =
            Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "Remember me" auth key and sets it to the model.
     */
    public function generateAuthKey()
    {
        $this->auth_key =
            Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token and sets it to the model.
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token =
            Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token.
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
