<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\news\models\Categories;

$this->title = 'Создание новой новости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Пожалуйста заполните поля ниже для создания новости</p>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-create']); ?>
            <?= $form->field($model, 'categories')->dropDownList(ArrayHelper::map(Categories::getCategoryName(), 'id',
                'name')) ?>
            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'newsDescription')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'newsText')->textarea(['autofocus' => true]) ?>
            <?= $form->field($model, 'newsStatus')->radioList([
                1 => 'Да',
                0 => 'Нет, поместить в архив'
            ])->label('Разместить статью на сайте?') ?>
            <!--            --><? //= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
            //                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            //            ]) ?>
            <div class="form-group">
                <?= Html::submitButton('NewsCreate', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>