<?php

use app\models\ClientList;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ClientListSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
// 1. Zmiana tytułu strony
$this->title = 'Lista klientów';
?>
<div class="client-list-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php 
    $rola = Yii::$app->user->identity->role ?? '';
    $login = Yii::$app->user->identity->username ?? '';
    
    if ($rola === 'editor' || $rola === 'admin'): 
    ?>
        <p>
            <?= Html::a('Dodaj klienta', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <p class="text-muted small mb-2">
        💡 <i>Wpisz tekst w puste pola pod nagłówkami, aby szybko przefiltrować tabelę.</i>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => 'Wyświetlanie <b>{begin}-{end}</b> z <b>{totalCount}</b> klientów.',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'email:email',
            'first_name',
            'last_name',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ClientList $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                                  'visibleButtons' => [
                     'update' => function ($model, $key, $index) {
                         $role = Yii::$app->user->identity->role;
                         $username = Yii::$app->user->identity->username;
                         return $role === 'editor' || $role === 'admin';
                     },
                     'delete' => function ($model, $key, $index) {
                         return Yii::$app->user->identity->role === 'admin';
                     },
                 ],
            ],
            ],
    ]); ?>


</div>
