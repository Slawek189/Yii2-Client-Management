<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserAccounts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-accounts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role')->dropDownList(
        \app\models\UserAccounts::optsRole(),
        ['prompt' => 'Wybierz rolę...']
    ) ?>

    <?php if ($model->isNewRecord): ?>
        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'security_question')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'security_answer')->textInput(['maxlength' => true]) ?>
    <?php else: ?>
        <?= Html::activeHiddenInput($model, 'password') ?>
        <?= Html::activeHiddenInput($model, 'security_question') ?>
        <?= Html::activeHiddenInput($model, 'security_answer') ?>
    <?php endif; ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('Zapisz', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>