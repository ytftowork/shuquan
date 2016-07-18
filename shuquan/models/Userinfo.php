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
            [['id','school', 'realname', 'phone', 'departmentid', 'departmentname'], 'required'],
            [['pickid', 'departmentid'], 'integer'],
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
            'nickname' => '昵称',
            'school' => '学校',
            'address' => '地址',
            'realname' => '真实姓名',
            'phone' => '电话',
            'pickid' => '取货点',
            'departmentid' => '院系类型',
            'departmentname' => '院系名称',
        ];
    }
	public function getpickinfo()
    {
        // 第一个参数为要关联的子表模型类名，
        // 第二个参数指定 通过子表的customer_id，关联主表的id字段
        return $this->hasMany(Pickinfo::className(), ['id' => 'pickid']);
    }
		public function getdepartment()
    {
        // 第一个参数为要关联的子表模型类名，
        // 第二个参数指定 通过子表的customer_id，关联主表的id字段
        return $this->hasMany(Department::className(), ['id' => 'departmentid']);
    }
}
