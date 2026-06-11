<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Rejestracja';
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Wypełnij poniższe pola, aby założyć nowe konto:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Twój Login') ?>
                
                <?= $form->field($model, 'password')->passwordInput()->label('Twoje Hasło') ?>

                <?= $form->field($model, 'security_question')->textInput()->label('Pytanie pomocnicze (np. Nazwisko panieńskie matki?)') ?>

                <?= $form->field($model, 'security_answer')->passwordInput()->label('Odpowiedź na pytanie') ?>

                <div class="form-group mt-4">
                    <?= Html::submitButton('Zarejestruj się', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>