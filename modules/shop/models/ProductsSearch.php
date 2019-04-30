<?php

namespace app\modules\shop\models;

use yii\data\ActiveDataProvider;

/**
 * ProductsSearch represents the model behind the search form of `app\modules\shop\models\Products`.
 */
class ProductsSearch extends Products
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params): ActiveDataProvider
    {
        $query = Products::find()->with('productDetail', 'categoryProducts', 'productAmount');


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

//        $query->andFilterWhere([
//            'id' => $this->id,
//            'category_id' => $this->category_id,
//            'image' => $this->image,
//        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
