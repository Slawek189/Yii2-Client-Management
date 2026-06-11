<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserAccounts $model */

$this->title = 'Edytuj użytkownika: ' . $model->username;

?>
<div class="user-accounts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
