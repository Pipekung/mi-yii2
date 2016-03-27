<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Repair;

/**
 * RepairSearch represents the model behind the search form about `app\models\Repair`.
 */
class RepairSearch extends Repair
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'divice_id', 'user_id', 'status_id', 'receiver_user_id', 'return_user_id'], 'integer'],
            [['code', 'date', 'comment', 'return_date'], 'safe'],
            [['cost'], 'number'],
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
        $query = Repair::find();

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
            'divice_id' => $this->divice_id,
            'user_id' => $this->user_id,
            'date' => $this->date,
            'cost' => $this->cost,
            'status_id' => $this->status_id,
            'receiver_user_id' => $this->receiver_user_id,
            'return_user_id' => $this->return_user_id,
            'return_date' => $this->return_date,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
