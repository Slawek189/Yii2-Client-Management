<?php
use yii\helpers\Html;

$this->title = 'Odzyskiwanie hasła';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($error): ?>
        <div class="alert alert-danger">
            <?= Html::encode($error) ?>
        </div>
    <?php endif; ?>

    <?php if (!$user): ?>
        <p>Podaj swoją nazwę użytkownika. Jeśli istnieje w naszej bazie, zadamy Ci pytanie pomocnicze.</p>
        
        <div class="row">
            <div class="col-lg-5">
                <?= Html::beginForm(['site/reset-password'], 'post') ?>
                    <div class="form-group mb-3">
                        <?= Html::label('Nazwa użytkownika', 'username', ['class' => 'control-label']) ?>
                        <?= Html::textInput('username', '', ['class' => 'form-control', 'required' => true, 'autofocus' => true]) ?>
                    </div>
                    <div class="form-group">
                        <?= Html::submitButton('Dalej', ['class' => 'btn btn-primary']) ?>
                    </div>
                <?= Html::endForm() ?>
            </div>
        </div>

    <?php else: ?>
        <p>Znaleźliśmy Twoje konto! Odpowiedz na poniższe pytanie, aby ustawić nowe hasło.</p>
        
        <div class="row">
            <div class="col-lg-5">
                <?= Html::beginForm(['site/reset-password'], 'post') ?>
                    <?= Html::hiddenInput('username', $user->username) ?>
                    
                    <div class="form-group mb-3">
                        <label class="control-label text-muted">Twoje pytanie pomocnicze:</label>
                        <input type="text" class="form-control" value="<?= Html::encode($user->security_question) ?>" disabled>
                    </div>

                    <div class="form-group mb-3">
                        <?= Html::label('Odpowiedź', 'answer', ['class' => 'control-label']) ?>
                        <?= Html::passwordInput('answer', '', ['class' => 'form-control', 'required' => true, 'autofocus' => true]) ?>
                    </div>

                    <div class="form-group mb-4">
                        <?= Html::label('Nowe hasło', 'new_password', ['class' => 'control-label']) ?>
                        <?= Html::passwordInput('new_password', '', ['class' => 'form-control', 'required' => true]) ?>
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('Zmień hasło', ['class' => 'btn btn-success']) ?>
                    </div>
                <?= Html::endForm() ?>
            </div>
        </div>
    <?php endif; ?>
</div>