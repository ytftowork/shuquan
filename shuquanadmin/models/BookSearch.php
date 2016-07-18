<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Book;

/**
 * BookSearch represents the model behind the search form about `app\models\Book`.
 */
class BookSearch extends Book
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'schoolid', 'isshow', 'number'], 'integer'],
            [['bookname', 'author', 'publishing', 'publictime', 'printtime', 'printrun', 'binding', 'edition', 'booksize', 'pagenumber', 'wordnumber', 'isbn', 'info', 'price', 'deposit', 'oldprice'], 'safe'],
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
        $query = Book::find()->orderby('isshow desc');

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
            'isshow' => $this->isshow,
            'number' => $this->number,
        ]);

        $query->andFilterWhere(['like', 'bookname', $this->bookname])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'publishing', $this->publishing])
            ->andFilterWhere(['like', 'publictime', $this->publictime])
            ->andFilterWhere(['like', 'printtime', $this->printtime])
            ->andFilterWhere(['like', 'printrun', $this->printrun])
            ->andFilterWhere(['like', 'binding', $this->binding])
            ->andFilterWhere(['like', 'edition', $this->edition])
            ->andFilterWhere(['like', 'booksize', $this->booksize])
            ->andFilterWhere(['like', 'pagenumber', $this->pagenumber])
            ->andFilterWhere(['like', 'wordnumber', $this->wordnumber])
            ->andFilterWhere(['like', 'isbn', $this->isbn])
            ->andFilterWhere(['like', 'info', $this->info])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'deposit', $this->deposit])
            ->andFilterWhere(['like', 'oldprice', $this->oldprice]);

        return $dataProvider;
    }
}
