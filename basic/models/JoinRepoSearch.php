<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JoinRepo;

/**
 * JoinRepoSearch represents the model behind the search form about `app\models\JoinRepo`.
 */
class JoinRepoSearch extends JoinRepo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'repoid'], 'integer'],
            [['IsApproved', 'JoinDate'], 'safe'],
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
        $query = JoinRepo::find();

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
            'uid' => $this->uid,
            'repoid' => $this->repoid,
            'JoinDate' => $this->JoinDate,
        ]);

        $query->andFilterWhere(['like', 'IsApproved', $this->IsApproved]);

        return $dataProvider;
    }
}
