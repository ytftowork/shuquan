<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property integer $id
 * @property string $bookname
 * @property string $author
 * @property string $publishing
 * @property string $publictime
 * @property string $printtime
 * @property string $printrun
 * @property string $binding
 * @property string $edition
 * @property string $booksize
 * @property string $pagenumber
 * @property string $wordnumber
 * @property string $isbn
 * @property string $info
 * @property string $price
 * @property string $deposit
 * @property string $oldprice
 * @property integer $schoolid
 * @property integer $isshow
 * @property integer $number
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['info'], 'string'],
            [['schoolid', 'isshow', 'number'], 'integer'],
            [['bookname', 'author', 'publishing', 'publictime', 'printtime', 'printrun', 'binding', 'edition', 'booksize', 'pagenumber', 'wordnumber', 'isbn'], 'string', 'max' => 255],
            [['price', 'deposit', 'oldprice'], 'string', 'max' => 11]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bookname' => '书名',
            'author' => '作者',
            'publishing' => '出版社',
            'publictime' => '出版时间',
            'printtime' => '印刷时间',
            'printrun' => '版次',
            'binding' => '装订',
            'edition' => '版次',
            'booksize' => '开本',
            'pagenumber' => '页数',
            'wordnumber' => '字数',
            'isbn' => 'Isbn',
            'info' => '简介',
            'price' => '租金',
            'deposit' => '押金',
            'oldprice' => '原价',
            'schoolid' => '学校',
            'isshow' => '是否显示',
            'number' => '库存',
        ];
    }
	public function getbookimg()
    {
        // 第一个参数为要关联的子表模型类名，
        // 第二个参数指定 通过子表的customer_id，关联主表的id字段
        return $this->hasOne(Bookimg::className(), ['bookid' => 'id']);
    }
	public function getschool()
    {
        // 第一个参数为要关联的子表模型类名，
        // 第二个参数指定 通过子表的customer_id，关联主表的id字段
        return $this->hasOne(School::className(), ['id' => 'schoolid']);
    }
}
