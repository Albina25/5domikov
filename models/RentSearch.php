<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rent;

/**
 * RentSearch represents the model behind the search form of `app\models\Rent`.
 */
class RentSearch extends Rent
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'house_id', 'price_total', 'status', 'payment_status', 'guests', 'created_at'], 'integer'],
            [['comment', 'name', 'email', 'phone', 'date_start', 'date_end'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Rent::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'house_id' => $this->house_id,
            'price_total' => $this->price_total,
            'status' => $this->status,
            'payment_status' => $this->payment_status,
            'guests' => $this->guests,
            'created_at' => $this->created_at,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
        ]);

        $query->andFilterWhere(['ilike', 'comment', $this->comment])
            ->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'email', $this->email])
            ->andFilterWhere(['ilike', 'phone', $this->phone]);

        return $dataProvider;
    }
}
