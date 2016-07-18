<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Userinfo;

/**
 * UserinfoSearch represents the model behind the search form about `app\models\Userinfo`.
 */
class UserinfoSearch extends Userinfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pickid'], 'integer'],
            [['nickname', 'school', 'address', 'realname', 'phone'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Userinfo::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'pickid' => $this->pickid,
        ]);

        $query->andFilterWhere(['like', 'nickname', $this->nickname])
            ->andFilterWhere(['like', 'school', $this->school])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'realname', $this->realname])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
			public function getpickinfo()
	{
		// 第一个参数为要关联的子表模型类名，
		// 第二个参数指定 通过子表的customer_id，关联主表的id字段
		return $this->hasOne(Pickinfo::className(), ['id' => 'pickid']);
	}
}
