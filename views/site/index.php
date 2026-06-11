<?php
/** @var yii\web\View $this */
use yii\helpers\Html;

$this->title = 'Pulpit Zarządzania';
?>
<div class="site-index">
    <?php if (Yii::$app->user->isGuest): ?>
        <div class="p-5 mb-4 bg-dark text-white rounded-3 text-center">
            <h1 class="display-4 fw-bold">Witaj w Systemie Zarządzania</h1>
            <p class="lead">Aby uzyskać dostęp do panelu klientów i zgłoszeń, musisz być zalogowany.</p>
            <div class="mt-4">
                <?= Html::a('Zaloguj się', ['/site/login'], ['class' => 'btn btn-primary btn-lg mx-2']) ?>
                <?= Html::a('Zarejestruj się', ['/site/signup'], ['class' => 'btn btn-outline-light btn-lg mx-2']) ?>
            </div>
        </div>
    <?php else: ?>
        <div class="p-5 mb-4 bg-dark text-white rounded-3">
            <h1 class="display-5 fw-bold">Witaj, <?= Html::encode(Yii::$app->user->identity->username) ?>!</h1>
            <p class="fs-4">To jest Twój główny pulpit. Wybierz jedną z poniższych operacji.</p>
        </div>

        <div class="body-content">
            <div class="row">
                <div class="col-lg-4 mb-3">
                    <h2>Klienci</h2>
                    <p>Przeglądaj, edytuj i zarządzaj bazą swoich klientów.</p>
                    <?= Html::a('Przejdź do listy &raquo;', ['/client-list/index'], ['class' => 'btn btn-primary btn-lg']) ?>
                </div>

                <?php if (Yii::$app->user->identity->role === 'viewer'): ?>
                    <div class="col-lg-4 mb-3">
                        <h2>Uprawnienia</h2>
                        <p>Masz status "Widz". Wyślij prośbę do administratora o nadanie roli Edytora.</p>
                        <?= Html::a('Wyślij prośbę', ['/site/request-editor'], [
                            'class' => 'btn btn-warning btn-lg',
                            'data' => [
                                'confirm' => 'Czy na pewno chcesz wysłać prośbę o wyższe uprawnienia?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </div>
                <?php endif; ?>
                
                <?php if (Yii::$app->user->identity->role === 'editor'): ?>
                    <div class="col-lg-4 mb-3">
                        <h2>Uprawnienia Edytora</h2>
                        <p>Posiadasz status "Edytor". Masz pełny dostęp do bazy klientów – możesz dodawać nowe wpisy i modyfikować istniejące.</p>
                    </div>
                <?php endif; ?>

                <?php if (Yii::$app->user->identity->role === 'admin'): ?>
                    <div class="col-lg-4 mb-3">
                        <h2>Zgłoszenia</h2>
                        <p>Sprawdź oczekujące prośby o zmianę uprawnień.</p>
                        <?= Html::a('Zobacz zgłoszenia &raquo;', ['/editor-requests/index'], ['class' => 'btn btn-primary btn-lg']) ?>
                    </div>
                    
                    <div class="col-lg-4 mb-3">
                        <h2>Użytkownicy</h2>
                        <p>Panel administracyjny: zarządzanie kontami.</p>
                        <?= Html::a('Zarządzaj &raquo;', ['/user-accounts/index'], ['class' => 'btn btn-primary btn-lg']) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>