<?php

use app\models\EditorRequests;
use yii\helpers\Html; // <--- TEGO BRAKOWAŁO!
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\EditorRequestsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

// Zmiana tytułu
$this->title = 'Zgłoszenia o uprawnienia';
?>
<div class="editor-requests-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-muted small mb-2">
        💡 <i>Wpisz tekst w puste pola pod nagłówkami, aby szybko przefiltrować tabelę.</i>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => 'Wyświetlanie <b>{begin}-{end}</b> z <b>{totalCount}</b> zgłoszeń.',
        'columns' => [

            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'user_id',
                'label' => 'Użytkownik',
                'value' => function($model) {
                    
                    return $model->user ? $model->user->username : 'Brak danych';
                }
            ],
            'request_date',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->getStatusLabel();
                },
                'filter' => \app\models\EditorRequests::getStatusLabels(),
            ],
            'admin_comment',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, EditorRequests $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
