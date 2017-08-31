<?php
namespace backend\models;

use yii\base\Model;
use common\models\Adminuser;
use yii\helpers\VarDumper;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $nickname;
    public $password_repeat;
    public $profile;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\Adminuser', 'message' => '用戶名已存在'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Adminuser', 'message' => '郵件信箱已存在'],

        	[['password','password_repeat'], 'required'],
            ['password', 'string', 'min' => 6],
        	['password_repeat' , 'compare' , 'compareAttribute'=>'password','message'=>'兩次輸入密碼要相同'],
        	
        	['nickname' , 'required'],
        	['nickname' , 'string' , 'max'=>128],
        	
        	['profile','string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
    	return [    			
    			'username' => '帳號',
    			'nickname' => '用戶名',
    			'password' => '密碼',
    			'password_repeat' => '重輸密碼',
    			'email' => 'Email',
    			'profile' => 'Profile',
    			'auth_key' => 'Auth Key',
    			'password_hash' => 'Password Hash',
    			'password_reset_token' => 'Password Reset Token',
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
        
        $user = new Adminuser();
        $user->username = $this->username;
        $user->nickname = $this->nickname;
        $user->email = $this->email;
        $user->profile = $this->profile;
       
        $user->setPassword($this->password);
        $user->generateAuthKey();
		$user->password = $user->password_hash;
        //$user->save(); VarDumper::dump($user->errors);exit(0);
        
        return $user->save() ? $user : null;
    }
}
