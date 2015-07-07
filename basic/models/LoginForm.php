<?php

namespace app\models;

use Yii;
use app\models\helpers\Password;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public $login;
    public $password;
    public $rememberMe = false;

    private $_user;

    public function rules()
    {
        return [
            'requiredFields' => [
                ['login', 'password'],
                'required'
            ],
            'loginTrim' => [
                'login',
                'trim'
            ],
            'passwordValidate' => [
                'password',
                'validatePassword'
            ],
            'confirmationValidate' => [
                'login',
                'validateConfirmation'
            ],
            'rememberMe' => [
                'rememberMe', 'boolean'
            ],
        ];
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'login' => 'Email',
            'password' => 'Password',
            'rememberMe' => 'Remember me next time',
        ];
    }

    public function validatePassword()
    {
        if ($this->_user === null || !Password::validate($this->password, $this->_user->password_hash)) {
            $this->addError($this->password, 'Invalid login or password');
        }
    }

    /**
     * @todo lookup confirmation status of user
     * @param $attribute
     */
    public function validateConfirmation($attribute)
    {
        if ($this->_user !== null) {
            if (!$this->_user->getIsConfirmed()) {
                $this->addError($attribute, 'You need to confirm your email address');
            }
            if (!$this->_user->getIsEnabled()) {
                $this->addError($attribute, 'Your account has been disabled');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->getUser()->login($this->_user, $this->rememberMe ? $this->rememberMe : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->login);
        }

        return $this->_user;
    }

    /** @inheritdoc */
    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->_user = User::findByEmail($this->login);
            return true;
        } else {
            return false;
        }
    }
}
