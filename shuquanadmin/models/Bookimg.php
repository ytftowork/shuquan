<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bookimg".
 *
 * @property integer $id
 * @property integer $bookid
 * @property string $realurl
 * @property string $localurl
 */
class Bookimg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bookimg';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bookid',  'localurl'], 'required'],
            [['bookid'], 'integer'],
            [['realurl', 'localurl'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bookid' => 'Bookid',
            'realurl' => 'Realurl',
            'localurl' => 'Localurl',
        ];
    }
}
