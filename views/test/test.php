<?php
$form = \yii\widgets\ActiveForm::begin(['id' => 'testForm', 'method' => 'POST']);
echo $form->field($user, 'email')->textarea();
echo $form->field($user, 'username')->textarea();
echo $form->field($user, 'status')->textInput();
echo \yii\helpers\Html::submitButton('send');


\yii\widgets\ActiveForm::end();

\app\widgets\myWidgets::begin([
    'message' => 'hi'
]);

\app\widgets\myWidgets::end();