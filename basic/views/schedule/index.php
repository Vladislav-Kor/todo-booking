<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Выбор услуги';
$actionsList = [
    [
        "name"=>"Услуги",
        "key"=>"service"
    ],
    [
        "name"=>"Специалисты",
        "key"=>"personal"
    ],
    [
        "name"=>"Дата/Время",
        "key"=>"date"
    ],
];
?>

<div class="container">
    <p>Выберите вариант действий</p>
</div>

<?php $form = ActiveForm::begin([
    'action' => ['schedule/schedule'],
    'method' => 'post',
]); ?>

<div class="container">
    <?php foreach ($actionsList as $key): ?>
        <div class="form-check">
            <?= Html::radio('actions[]', false, [
                'value' => $key['key'],
                'id' => 'action_' . $key['key'],
                'class' => 'form-check-input'
            ]) ?>
            <?= Html::label($key["name"], 'action_' . $key['key'], ['class' => 'form-check-label']) ?>
        </div>
    <?php endforeach; ?>
</div>

<div class="container mt-3">
    <?= Html::submitButton('Продолжить', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
