<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ClientList $model */

$this->title = 'Edytuj klienta: ' . $model->first_name . ' ' . $model->last_name;

?>
<div class="client-list-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
