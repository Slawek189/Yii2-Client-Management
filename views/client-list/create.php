<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ClientList $model */

$this->title = 'Dodaj klienta';

?>
<div class="client-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
