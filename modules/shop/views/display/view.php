<?php

use \yii\helpers\Html;

foreach ($model as $item): ?>

    <?= Html::img('/uploads/' . $item->detail->image,
        ['alt' => 'картинка', 'width' => '400px', 'height' => '300px']) ?>
    <?= Html::a(Html::button('Добавить в корзину', ['class' => 'cart',  'data-id' => $item->id]),
        ['cart/add', 'id' => $item->id])?>

    <?= Html::tag('h1', Html::encode($item->name), ['class' => 'product-title']) ?>

    <?= Html::tag('p', Html::encode($item->detail->description), ['class' => 'product-description']) ?>
    <?= Html::tag('p', Html::encode($item->detail->detail), ['class' => 'product-detail']) ?>
    <?= Html::tag('p', Html::encode($item->amount->amount), ['class' => 'amount']) ?>
    <?= Html::tag('p', Html::encode($item->amount->measure), ['class' => 'product-measure']) ?>
    <?= Html::tag('p', Html::encode($item->category->name), ['class' => 'product-category']) ?>
    <?= Html::tag('p', Html::encode($item->amount->price), ['class' => 'product-price']) ?>
    <?= Html::tag('p', Html::encode($item->amount->currency), ['class' => 'product-currency']) ?>
<?php endforeach; ?>