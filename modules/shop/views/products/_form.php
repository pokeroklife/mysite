<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\shop\models\Products */
/* @var $form yii\widgets\ActiveForm */
/* @var $categories app\modules\shop\models\Products */
/* @var $description app\modules\shop\models\Products */
/* @var $amount app\modules\shop\models\Products */
?>

<div class="products-form">
    <?php $form = ActiveForm::begin([
        'id' => 'form-create',
        'method' => 'post',
        'options' =>
            [
                'enctype' => 'multipart/form-data'
            ]
    ]); ?>
    <?= $form->field($model, 'category_id')
        ->widget(Select2::class, [
            'data' => \yii\helpers\ArrayHelper::map($categories, 'id', 'name'),
            'options' => ['placeholder' => 'категория'],
            'pluginOptions' => [
                'tags' => true,
                'tokenSeparators' => [',', ' '],
                'maximumInputLength' => 10
            ],
        ]) ?>
    <!--    --><? //= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($description, 'description')->textInput(['maxlength' => true]) ?>
    <?= $form->field($description, 'detail')->textInput(['maxlength' => true]) ?>
    <?= $form->field($amount, 'amount')->textInput(['maxlength' => true]) ?>
    <?= $form->field($amount, 'measure')->textInput(['maxlength' => true]) ?>
    <?= $form->field($amount, 'price')->textInput(['maxlength' => true]) ?>
    <?= $form->field($amount, 'currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($description, 'image')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
