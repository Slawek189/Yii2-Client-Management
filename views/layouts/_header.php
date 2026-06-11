<?php

use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;

NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
]);


if (!Yii::$app->user->isGuest) {
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Klienci', 'url' => ['/client-list/index']],
            ['label' => 'Zgłoszenia', 'url' => ['/editor-requests/index'], 'visible' => Yii::$app->user->identity->role === 'admin'],
            ['label' => 'Użytkownicy', 'url' => ['/user-accounts/index'], 'visible' => Yii::$app->user->identity->role === 'admin'],
            '<li class="nav-item">'
                . Html::beginForm(['/site/logout'])
                . Html::submitButton(
                    'Wyloguj (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'nav-link btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
        ]
    ]);
}

NavBar::end();
?>