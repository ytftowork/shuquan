<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orderpackage".
 *
 * @property integer $id
 * @property string $orderid
 * @property integer $packageid
 */
class Orderpackage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orderpackage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderid', 'packageid'], 'required'],
            [['packageid'], 'integer'],
            [['orderid'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orderid' => 'Orderid',
            'packageid' => 'Packageid',
        ];
    }
	public function getpackage()
    {
        // 第一个参数为要关联的子表模型类名，
        // 第二个参数指定 通过子表的customer_id，关联主表的id字段
        return $this->hasOne(Package::className(), ['id' => 'packageid']);
    }
}
