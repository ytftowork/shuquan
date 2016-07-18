<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pickinfo;

/**
 * PickinfoSearch represents the model behind the search form about `app\models\Pickinfo`.
 */
class PickinfoSearch extends Pickinfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'schoolid'], 'integer'],
            [['pickaddress', 'pickpeople'], 'safe'],
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
        $query = Pickinfo::find();

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
            'schoolid' => $this->schoolid,
        ]);

        $query->andFilterWhere(['like', 'pickaddress', $this->pickaddress])
            ->andFilterWhere(['like', 'pickpeople', $this->pickpeople]);

        return $dataProvider;
    }
}
