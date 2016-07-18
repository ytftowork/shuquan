<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "userinfo".
 *
 * @property integer $id
 * @property string $nickname
 * @property string $school
 * @property string $address
 * @property string $realname
 * @property string $phone
 * @property integer $pickid
 * @property integer $departmentid
 * @property string $departmentname
 */
class Userinfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userinfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'school', 'realname', 'phone', 'departmentid', 'departmentname'], 'required'],
            [['id', 'pickid', 'departmentid'], 'integer'],
            [['nickname'], 'string', 'max' => 40],
            [['school', 'address', 'realname', 'phone', 'departmentname'], 'string', 'max' => 400]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nickname' => 'Nickname',
            'school' => 'School',
            'address' => 'Address',
            'realname' => 'Realname',
            'phone' => 'Phone',
            'pickid' => 'Pickid',
            'departmentid' => 'Departmentid',
            'departmentname' => 'Departmentname',
        ];
    }
		public function getpickinfo()
	{
		// 第一个参数为要关联的子表模型类名，
		// 第二个参数指定 通过子表的customer_id，关联主表的id字段
		return $this->hasOne(Pickinfo::className(), ['id' => 'pickid']);
	}
}
