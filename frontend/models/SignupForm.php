<?php
namespace frontend\models;

use yii\base\Model;
use common\models\UserModel;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $rePassword;
    public $verifyCode;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username','match', 'pattern' => '/^[A-Za-z0-9_\x{4e00}-\x{9fa5}]+$/u','message'=> \Yii::t('common','The user name can only be composed of numbers, letters, Chinese characters and underlines, and can not contain special symbols.')],
            ['username', 'unique', 'targetClass' => '\common\models\UserModel', 'message' => \Yii::t('common','This username has already been taken.')],
            ['username', 'string', 'min' => 2, 'max' => 20],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\UserModel', 'message' => \Yii::t('common','This email address has already been taken.')],

            [['password', 'rePassword'], 'required'],
            [['password', 'rePassword'], 'string', 'min' => 6],

            ['rePassword','compare','compareAttribute'=>'password','message'=>\Yii::t('common','Two times the password is not consitent.')],

            ['verifyCode','captcha'],

        ];
    }

    public function attributeLabels()
    {
        return[
            'username' =>\Yii::t('common','Username'),
            'email' => \Yii::t('common','Email'),
            'password' => \Yii::t('common', 'Password'),
            'rePassword' => \Yii::t('common',"RePassword"),
            'verifyCode' => \Yii::t('common',"VerifyCode"),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new UserModel();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
