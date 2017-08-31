<?php
namespace backend\models;

use yii\base\Model;
use common\models\Adminuser;
use yii\helpers\VarDumper;

/**
 * Signup form
 */
class ResetpwdForm extends Model
{	
	private $username;
    public $password;
    public $password_repeat;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['password','password_repeat'], 'required'],
            ['password', 'string', 'min' => 6],
        	['password_repeat','compare','compareAttribute'=>'password','message'=>'兩次輸入密碼要相同'],        	

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
    	return [
    			'password' => '密碼',
    			'password_repeat' => '重輸密碼',
    	];
    }
    
    public function setUsername($username)
    {
    	return $this->username=$username;
    }
    public function getUsername(){
    	return $this->username;
    }
        
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function resetPassword($id)
    {
        if (!$this->validate()) {
            return null;
        }
        $adminUser = Adminuser::findOne($id);
        $adminUser->setPassword($this->password);
        $adminUser->password = $adminUser->password_hash;

        //$user->save(); VarDumper::dump($user->errors);exit(0);
        
        return $adminUser->save() ? true : false;
    }
}
