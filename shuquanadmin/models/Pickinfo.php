<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pickinfo".
 *
 * @property integer $id
 * @property string $pickaddress
 * @property string $pickpeople
 * @property integer $schoolid
 */
class Pickinfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pickinfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pickaddress', 'pickpeople', 'schoolid'], 'required'],
            [['schoolid'], 'integer'],
            [['pickaddress', 'pickpeople'], 'string', 'max' => 400]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pickaddress' => '取货地点',
            'pickpeople' => '联系人',
            'schoolid' => '学校',
        ];
    }
	public function getschool()
    {
        // 第一个参数为要关联的子表模型类名，
        // 第二个参数指定 通过子表的customer_id，关联主表的id字段
        return $this->hasOne(School::className(), ['id' => 'schoolid']);
    }
}
