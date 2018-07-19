<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Tblsoundeffects;

/**
 * TblsoundeffectsSearch represents the model behind the search form of `frontend\models\Tblsoundeffects`.
 */
class TblsoundeffectsSearch extends Tblsoundeffects
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sound_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'hexCode', 'url'], 'safe'],
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
        $query = Tblsoundeffects::find();

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
            'sound_id' => $this->sound_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'hexCode', $this->hexCode])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
