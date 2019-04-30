<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\shop\models\Products */
/* @var $categories app\modules\shop\models\Products */
/* @var $description app\modules\shop\models\Products */
/* @var $amount app\modules\shop\models\Products */

$this->title = 'Create Products';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'description' => $description,
        'amount' => $amount
    ]) ?>

</div>
