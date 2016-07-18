<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Package;

/**
 * PackageSearch represents the model behind the search form about `app\models\Package`.
 */
class PackageSearch extends Package
{
    /**
     * @inheritdoc
     */
	 public $isshow = null;
    public function rules()
    {
        return [
            [['id', 'userid', 'bookid', 'status', 'resdeposit', 'time', 'backtime','deletekind'], 'integer'],
			[['isshow'], 'safe'],
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
        $query = Package::find()->joinWith('book')->orderBy('id desc');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [
        				'pageSize' => 5,],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
			'book.isshow' =>$this->isshow,
            'userid' => $this->userid,
            'bookid' => $this->bookid,
            'status' => $this->status,
            'resdeposit' => $this->resdeposit,
            'time' => $this->time,
            'backtime' => $this->backtime,
			'deletekind' => $this->deletekind,
        ]);

        return $dataProvider;
    }
	
	public function search1($params)
    {
        $query = Package::find()->joinWith('book')->orderBy('backtime desc');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [
        				'pageSize' => 30,],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'userid' => $this->userid,
			'book.isshow' =>$this->isshow,
            'bookid' => $this->bookid,
            'status' => $this->status,
            'resdeposit' => $this->resdeposit,
            'time' => $this->time,
            'backtime' => $this->backtime,
			'deletekind' => $this->deletekind,
        ]);

        return $dataProvider;
    }
}
