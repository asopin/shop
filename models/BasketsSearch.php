<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Baskets;

/**
 * BasketsSearch represents the model behind the search form about `app\models\Baskets`.
 */
class BasketsSearch extends Baskets
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'item_id', 'quantity'], 'integer'],
            [['date_added', 'date_modified'], 'safe'],
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
        $query = Baskets::find();

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
            'user_id' => $this->user_id,
            'item_id' => $this->item_id,
            'quantity' => $this->quantity,
            'date_added' => $this->date_added,
            'date_modified' => $this->date_modified,
        ]);

        return $dataProvider;
    }
}
