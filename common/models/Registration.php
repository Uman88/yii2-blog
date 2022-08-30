<?php

namespace common\models;

Use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

/**
 * Registration form
 */
class Registration extends Model
{
    /**
     * @var
     */
    public $name;

    /**
     * @var
     */
    public $email;

    /**
     * @var
     */
    public $password;

    /**
     * @var
     */
    public $status;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'filter', 'filter' => 'trim'],
            [['name', 'email', 'password'], 'required'],
            ['email', 'email'],
            ['name', 'string', 'min' => 2, 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Эта почта уже занята'],
            ['password', 'string', 'min' => 6, 'max' => 255],
            ['status', 'default', 'value' => User::STATUS_ACTIVE, 'on' => 'default'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Имя'),
            'email' => Yii::t('app', 'Почта'),
            'password' => Yii::t('app', 'Пароль'),
        ];
    }

    /**
     * Registration user with roles user
     *
     * @return User|null
     */
    public function registration()
    {
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->status = $this->status;
        $user->role = User::ROLE_USER;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }
}