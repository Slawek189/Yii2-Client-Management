<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\EditorRequests $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="editor-requests-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'request_date')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(
        \app\models\EditorRequests::getStatusLabels(),
        ['prompt' => 'Wybierz status...']
    ) ?>

    <?= $form->field($model, 'admin_comment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Zapisz', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
