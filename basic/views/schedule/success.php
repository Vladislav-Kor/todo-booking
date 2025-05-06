<?php

use yii\helpers\Html;
?>
<div class="container">
    <h2>Вы успешно записались!</h2>
    <p><strong>Услуга:</strong> <?= Html::encode($service) ?></p>
    <p><strong>Специалист:</strong> <?= Html::encode($personal) ?></p>
    <p><strong>Время:</strong> <?= Html::encode($time) ?></p>
    <a href="<?= \yii\helpers\Url::to(['schedule/index']) ?>" class="btn btn-primary">Записаться ещё</a>
</div>
