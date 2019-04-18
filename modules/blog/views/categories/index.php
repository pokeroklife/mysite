<?php
declare(strict_types=1);

use \yii\helpers\Html;

foreach ($categories as $category) {
    $view = \yii\helpers\Html::a($category->name, ['/blog/categories/view', 'id' => $category->id]);
    if (Yii::$app->user->can('administration')) {
        $delete = Html::a('Delete', ['delete', 'id' => $category->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);
    }
    echo \yii\helpers\Html::tag('div', $view . $delete, ['class' => 'categories']);
}


