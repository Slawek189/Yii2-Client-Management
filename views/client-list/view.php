<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\ClientList $model */

$this->title = 'Szczegóły klienta: ' . $model->first_name . ' ' . $model->last_name;
\yii\web\YiiAsset::register($this);
?>
<div class="client-list-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php 
       
        $rola = Yii::$app->user->identity->role ?? '';
        
        
        if ($rola === 'editor' || $rola === 'admin') {
            echo Html::a('Edytuj', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) . ' ';
        }
        
        if ($rola === 'admin') {
            echo Html::a('Usuń', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Czy na pewno chcesz usunąć tego klienta?',
                    'method' => 'post',
                ],
            ]);
        }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'email:email',
            'first_name',
            'last_name',
            'created_at:datetime', 
            'updated_at:datetime',
            [
                'label' => 'Dodał',
                'value' => $model->creator ? $model->creator->username : 'Nieznany',
            ],
            [
                'label' => 'Ostatnio edytował',
                'value' => $model->updater ? $model->updater->username : 'Brak edycji',
            ],
        ],
    ]) ?>

</div>