<?php
declare(strict_types=1);

namespace app\modules\admin;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Class AuthAssignmentSearch
 * @package app\modules\admin
 */
class AuthAssignmentSearch extends AuthAssignment
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['item_name', 'user_id'], 'safe'],
            [['created_at'], 'integer'],
        ];
    }

    /**
     * @return array
     */
    public function scenarios(): array
    {
        return Model::scenarios();
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params): ActiveDataProvider
    {
        $query = AuthAssignment::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name])
            ->andFilterWhere(['like', 'user_id', $this->user_id]);

        return $dataProvider;
    }
}
