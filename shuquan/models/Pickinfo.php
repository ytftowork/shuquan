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
            [['pickaddress', 'pickpeople','nickname'], 'string', 'max' => 400]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pickaddress' => 'Pickaddress',
            'pickpeople' => 'Pickpeople',
            'schoolid' => 'Schoolid',
        ];
    }
}
