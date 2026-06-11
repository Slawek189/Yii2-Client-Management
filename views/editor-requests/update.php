<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\EditorRequests $model */


$this->title = 'Edytuj zgłoszenie nr: ' . $model->id;
?>
<div class="editor-requests-update">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
