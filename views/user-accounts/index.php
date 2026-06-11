<?php

use app\models\UserAccounts;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\UserAccountsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */


$this->title = 'Użytkownicy';
?>
<div class="user-accounts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Dodaj użytkownika', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <p class="text-muted small mb-2">
        💡 <i>Wpisz tekst w puste pola pod nagłówkami, aby szybko przefiltrować tabelę.</i>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => 'Wyświetlanie <b>{begin}-{end}</b> z <b>{totalCount}</b> użytkowników.',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            
            [
                'attribute' => 'role',
                'value' => function ($model) {
                    return $model->displayRole();
                },
                'filter' => \app\models\UserAccounts::optsRole(),
            ],
            'security_question',
            
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, UserAccounts $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

</div>