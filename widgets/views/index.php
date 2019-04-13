<?php

use yii\helpers\Html;

?>
<?php $form = \yii\widgets\ActiveForm::begin(
    [
        'id' => 'form-create',
        'method' => 'post',
        'action' => '../comment/create',
    ]
);
?>
<?= $form->field($commentForm, 'comment')->textInput(['autofocus' => true])->label($label); ?>
<?= Html::activeHiddenInput($commentForm, 'parentId', ['value' => $commentId]) ?>
    <div class="form-group">
        <?= Html::submitButton($buttonName, ['class' => 'answer_button', 'name' => 'answer-button']) ?>
    </div>
<?php \yii\widgets\ActiveForm::end() ?>