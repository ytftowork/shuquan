<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "package".
 *
 * @property integer $id
 * @property integer $userid
 * @property integer $bookid
 * @property integer $status
 * @property string $resdeposit
 * @property integer $time
 * @property integer $backtime
 * @property integer $deletekind
 */
class Package extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'package';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'bookid', 'status', 'deletekind'], 'required'],
            [['userid', 'bookid', 'status', 'time', 'backtime', 'deletekind'], 'integer'],
            [['resdeposit'], 'string', 'max' => 11]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => 'Userid',
            'bookid' => 'Bookid',
            'status' => 'Status',
            'resdeposit' => 'Resdeposit',
            'time' => 'Time',
            'backtime' => 'Backtime',
            'deletekind' => 'Deletekind',
        ];
    }
	public function getbook()
	{
		// 第一个参数为要关联的子表模型类名，
		// 第二个参数指定 通过子表的customer_id，关联主表的id字段
		return $this->hasOne(Book::className(), ['id' => 'bookid']);
	}
}
