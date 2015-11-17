<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrderStatuses;

/**
 * OrderStatusesSearch represents the model behind the search form about `app\models\OrderStatuses`.
 */
class OrderStatusesSearch extends OrderStatuses
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_status_id', 'created_by', 'updated_by'], 'integer'],
            [['order_status_name', 'order_status_description', 'date_added', 'date_modified'], 'safe'],
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
        $query = OrderStatuses::find();

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
            'order_status_id' => $this->order_status_id,
            'date_added' => $this->date_added,
            'date_modified' => $this->date_modified,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'order_status_name', $this->order_status_name])
            ->andFilterWhere(['like', 'order_status_description', $this->order_status_description]);

        return $dataProvider;
    }
}
