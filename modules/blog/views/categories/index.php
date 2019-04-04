<?php

foreach ($categories as $category) {
    $category = \yii\helpers\Html::a($category->name, ['/blog/categories/view', 'id' => $category->id]);
    echo \yii\helpers\Html::tag('div', $category, ['class' => 'categories']);
}


