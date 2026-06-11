<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\EditorRequests $model */

$this->title = 'Create Editor Requests';

?>
<div class="editor-requests-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
