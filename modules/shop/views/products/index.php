<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\shop\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Products', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => \yii\grid\SerialColumn::class],

            'name',

            [
                'value' => 'categoryProducts.name',
                'label' => 'Название категории'
            ],

            'productDetail.description',
            'productDetail.detail',
            'productAmount.amount',
            'productAmount.measure',
            'productAmount.price',
            'productAmount.currency',
            [
                'format' => 'html',
                'label' => 'Изображение',
                'value' => static function ($data) {

                    return Html::img($data->getImage(), ['width' => 200]);
                }
            ],

            ['class' => \yii\grid\ActionColumn::class],
        ],
    ]);
    ?>
</div>
