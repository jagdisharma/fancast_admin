<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Tblgames;

/**
 * TblgamesSearch represents the model behind the search form of `frontend\models\Tblgames`.
 */
class TblgamesSearch extends Tblgames
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['game_id', 'time', 'created_at', 'updated_at'], 'integer'],
            [['team1', 'team2', 'image', 'category'], 'safe'],
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
        $query = Tblgames::find();

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
            'game_id' => $this->game_id,
            'time' => $this->time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'team1', $this->team1])
            ->andFilterWhere(['like', 'team2', $this->team2])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'category', $this->category]);

        return $dataProvider;
    }
}
