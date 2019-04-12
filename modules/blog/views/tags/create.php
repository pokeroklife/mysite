<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'Создание нового тэга';
$this->params['breadcrumbs'][] = array(
    'label' => 'Создание статьи',
    'url' => \yii\helpers\Url::toRoute('/blog/news/create')
);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Пожалуйста заполните поля ниже для создания Тэга</p>
    <h3><?= Yii::$app->session->getFlash('success'); ?></h3>
    <div class="row">

        <div class="news_form">
            <?php $form = ActiveForm::begin([
                'id' => 'form-create',
                'method' => 'post',
            ]); ?>
            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'status')->radioList([
                1 => 'Да',
                0 => 'Нет, поместить в архив'
            ])->label('Сделать тэг активным?') ?>
            <!--            --><? //= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
            //                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            //            ]) ?>
            <div class="form-group">
                <?= Html::submitButton('News', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>