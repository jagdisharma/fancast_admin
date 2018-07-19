<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Tblusers;

/**
 * TblusersSearch represents the model behind the search form of `frontend\models\Tblusers`.
 */
class TblusersSearch extends Tblusers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'followers', 'following', 'earnings', 'created_at', 'updated_at'], 'integer'],
            [['username', 'first_name', 'last_name', 'email', 'password', 'image', 'broadcaster', 'description', 'ssn', 'paypal', 'bank_account_number', 'routingNumber', 'deviceToken', 'deviceType', 'version'], 'safe'],
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
        $query = Tblusers::find();

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
            'user_id' => $this->user_id,
            'followers' => $this->followers,
            'following' => $this->following,
            'earnings' => $this->earnings,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'broadcaster', $this->broadcaster])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'ssn', $this->ssn])
            ->andFilterWhere(['like', 'paypal', $this->paypal])
            ->andFilterWhere(['like', 'bank_account_number', $this->bank_account_number])
            ->andFilterWhere(['like', 'routingNumber', $this->routingNumber])
            ->andFilterWhere(['like', 'deviceToken', $this->deviceToken])
            ->andFilterWhere(['like', 'deviceType', $this->deviceType])
            ->andFilterWhere(['like', 'version', $this->version]);

        return $dataProvider;
    }
}
