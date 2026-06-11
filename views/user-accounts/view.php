<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\UserAccounts $model */

$this->title = 'Szczegóły użytkownika: ' . $model->username;
\yii\web\YiiAsset::register($this);
?>
<div class="user-accounts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Edytuj', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Usuń', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Czy na pewno chcesz usunąć tego użytkownika?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
           
            [
                'attribute' => 'role',
                'value' => function ($model) {
                    return $model->displayRole(); 
                },
            ],
            'security_question',
            'registration_date',
        ],
    ]) ?>

</div>