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
            'bookname' => 'Bookname',
            'author' => 'Author',
            'publishing' => 'Publishing',
            'publictime' => 'Publictime',
            'printtime' => 'Printtime',
            'printrun' => 'Printrun',
            'binding' => 'Binding',
            'edition' => 'Edition',
            'booksize' => 'Booksize',
            'pagenumber' => 'Pagenumber',
            'wordnumber' => 'Wordnumber',
            'isbn' => 'Isbn',
            'info' => 'Info',
            'price' => 'Price',
            'deposit' => 'Deposit',
            'oldprice' => 'Oldprice',
            'schoolid' => 'Schoolid',
            'isshow' => 'Isshow',
            'number' => 'Number',
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
