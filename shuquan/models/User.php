<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "User".
 *
 * @property integer $id
 * @property string $name
 * @property string $school
 * @property string $address
 * @property string $password
 * @property string $realname
 * @property integer $phone
 * @property integer $pickid
 * @property string $authKey
 * @property string $accessToken
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'User';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'password', 'authKey', 'accessToken'], 'required'],
            [[ 'pickid'], 'integer'],
            [['phone','name', 'school', 'address', 'password', 'realname', 'authKey', 'accessToken','nickname'], 'string', 'max' => 400]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
			'nickname' => '昵称',
            'school' => 'School',
            'address' => 'Address',
            'password' => 'Password',
            'realname' => 'Realname',
            'phone' => 'Phone',
            'pickid' => 'Pickid',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
        ];
    }
	/**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
        /*foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;*/
    }

    /**
     * Finds user by username
     *
     * @param  string      $name
     * @return static|null
     */
    public static function findByname($name)
    {
          $user = User::find()
            ->where(['name' => $name])
            ->asArray()
            ->one();

            if($user){
            return new static($user);
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }
	public function getpickinfo()
    {
        // 第一个参数为要关联的子表模型类名，
        // 第二个参数指定 通过子表的customer_id，关联主表的id字段
        return $this->hasMany(Pickinfo::className(), ['id' => 'pickid']);
    }
}
