<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class SignupForm extends Model
{
    public $name;
    public $password;
	public $password1;
    private $_user = false;


	public function rules()
	{
		 return [
			['name', 'filter', 'filter' => 'trim'],
			['name', 'required','message' => '用户名不能为空'],
			['name', 'unique', 'targetClass' => '\app\models\User', 'message' => '用户名已存在'],
			['name', 'string', 'min' => 2, 'max' => 255],
		

			['password', 'required','message' => '密码不能为空'],
			['password1', 'required','message' => '确认密码不能为空'],
			['password', 'chek','message' => '密码不能为空'],
		];
	}
	public function chek($attribute, $params)
    {
        if (!$this->hasErrors()) {
			if($this->password!=$this->password1)
			{
				 $this->addError($attribute, 'passwordneed');
			}
        }
    }
	//注意这个方法里user表的字段
	public function signup()
	{
		if ($this->validate()) {
			$user = new User();
			$user->name = $this->name;
			$user->authKey = 	$this->name."-"."authKey";	
			$user->accessToken = 	$this->name."-"."accessToken";
			$user->password = md5($this->password);          
			if ($user->save()) {
				return $user;
			}
		}

		return null;
	}
}
