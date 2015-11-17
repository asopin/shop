<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DeliveryMethods;

/**
 * DeliveryMethodsSearch represents the model behind the search form about `app\models\DeliveryMethods`.
 */
class DeliveryMethodsSearch extends DeliveryMethods
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['delivery_method_id', 'created_by', 'updated_by'], 'integer'],
            [['delivery_method_name', 'date_added', 'date_modified'], 'safe'],
            [['delivery_method_price'], 'number'],
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
        $query = DeliveryMethods::find();

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
            'delivery_method_id' => $this->delivery_method_id,
            'delivery_method_price' => $this->delivery_method_price,
            'date_added' => $this->date_added,
            'date_modified' => $this->date_modified,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'delivery_method_name', $this->delivery_method_name]);

        return $dataProvider;
    }
}
