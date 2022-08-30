<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class Login extends Model
{
    /**
     * @var
     */
    public $email;

    /**
     * @var
     */
    public $password;

    /**
     * @var bool
     */
    public $rememberMe = true;

    /**
     * @var
     */
    public $status;

    /**
     * @var bool
     */
    private $_user = false;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required', 'on' => 'default'],
            ['email', 'email'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword']
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app', 'Почта'),
            'password' => Yii::t('app', 'Пароль'),
        ];
    }

    /**
     * Get user by Email
     *
     * @return bool|User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }

    /**
     * Checked user by validate
     *
     * @return bool
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return false;
    }

    /**
     * Checked password by validate
     *
     * @param $attribute
     * @return void
     */
    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if(!$user || !$user->validatePassword($this->password)){
                $this->addError($attribute, 'Неправильный email или пароль');
            }
        }
    }

}