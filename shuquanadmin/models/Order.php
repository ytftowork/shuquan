<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property string $id
 * @property integer $time
 * @property integer $userid
 * @property integer $overtime
 * @property integer $status
 * @property integer $paytime
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	 	 public $judge;
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'time', 'userid', 'overtime', 'status', 'paytime'], 'required'],
            [['time', 'userid', 'overtime', 'status', 'paytime'], 'integer'],
            [['id'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => 'Time',
            'userid' => 'Userid',
            'overtime' => 'Overtime',
            'status' => 'Status',
            'paytime' => 'Paytime',
        ];
    }
	public function getorderpackage()
    {
        // 第一个参数为要关联的子表模型类名，
        // 第二个参数指定 通过子表的customer_id，关联主表的id字段
        return $this->hasMany(Orderpackage::className(), ['orderid' => 'id']);
    }
	public function getuserinfo()
    {
        // 第一个参数为要关联的子表模型类名，
        // 第二个参数指定 通过子表的customer_id，关联主表的id字段
        return $this->hasOne(Userinfo::className(), ['id' => 'userid']);
    }
}
