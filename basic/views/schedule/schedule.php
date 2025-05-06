<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

// Этап 1: выбор услуги
if ($stage === 'service'): ?>
    <h2>Выберите услугу</h2>
    <?php $form = ActiveForm::begin(); ?>
    <?php foreach ($serviceList as $service): ?>
        <div>
            <?= Html::radio('service', false, ['value' => $service['name'], 'id' => 'service_'.$service['id']]) ?>
            <?= Html::label($service['name'], 'service_'.$service['id']) ?>
        </div>
    <?php endforeach; ?>
    <?= Html::hiddenInput('stage', 'service') ?>
    <div><?= Html::submitButton('Далее', ['class' => 'btn btn-success']) ?></div>
    <?php ActiveForm::end(); ?>

<?php
// Этап 2: выбор специалиста
elseif ($stage === 'personal'): ?>
    <h2>Выберите специалиста</h2>
    <?php $form = ActiveForm::begin(); ?>
    <?php foreach ($personalList as $person): ?>
        <div>
            <?= Html::radio('personal', false, ['value' => $person['name'], 'id' => 'personal_'.$person['id']]) ?>
            <?= Html::label($person['name'], 'personal_'.$person['id']) ?>
        </div>
    <?php endforeach; ?>
    <?= Html::hiddenInput('service', $selectedService) ?>
    <?= Html::hiddenInput('stage', 'personal') ?>
    <div><?= Html::submitButton('Далее', ['class' => 'btn btn-success']) ?></div>
    <?php ActiveForm::end(); ?>

<?php
// Этап 3: выбор даты и времени
elseif ($stage === 'time'):
    // --- Подготовка данных для календаря ---
    // $slotsByDay: ['YYYY-MM-DD' => [слоты...], ...]
    // $selectedDate: выбранная дата (YYYY-MM-DD)
    $monthStart = new DateTime(date('Y-m-01'));
    $monthEnd = (clone $monthStart)->modify('last day of this month');
    $today = date('Y-m-d');
    $availableDates = array_keys($slotsByDay);
    ?>

    <div class="container">
        <h2>Выберите дату</h2>
        <div id="calendar" style="display:grid;grid-template-columns:repeat(7,40px);gap:4px;">
            <?php
            // Дни недели
            $daysOfWeek = ['Пн','Вт','Ср','Чт','Пт','Сб','Вс'];
            foreach ($daysOfWeek as $d) {
                echo "<div style='font-weight:bold;text-align:center;'>$d</div>";
            }
            // Пустые клетки до первого дня месяца
            $firstDayOfWeek = (int)$monthStart->format('N');
            for ($i = 1; $i < $firstDayOfWeek; $i++) {
                echo "<div></div>";
            }
            // Дни месяца
            for ($d = 1; $d <= (int)$monthEnd->format('j'); $d++) {
                $dateStr = $monthStart->format('Y-m-') . str_pad($d, 2, '0', STR_PAD_LEFT);
                $isAvailable = in_array($dateStr, $availableDates);
                $isToday = $dateStr === $today;
                $style = $isAvailable ? 'background:#dfffcf;cursor:pointer;' : 'background:#eee;color:#aaa;';
                if ($isToday) $style .= 'border:2px solid #ff8888;';
                echo Html::beginForm('', 'post', ['style'=>'display:inline']);
                echo Html::hiddenInput('stage', 'time');
                echo Html::hiddenInput('service', $selectedService);
                echo Html::hiddenInput('personal', $selectedPersonal);
                echo Html::hiddenInput('date', $dateStr);
                echo Html::submitButton($d, [
                    'class'=>'btn btn-sm',
                    'style'=>"width:38px;height:38px;$style",
                    'disabled'=>!$isAvailable
                ]);
                echo Html::endForm();
            }
            ?>
        </div>
    </div>

    <?php
    // --- "Шахматка" времени ---
    if (!empty($slotsForSelectedDate)): ?>
        <div class="container" style="margin-top:2em;">
            <h3>Выберите время для <?= Html::encode($selectedDate) ?></h3>
            <?php $form = ActiveForm::begin(); ?>
            <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:8px;">
                <?php foreach ($slotsForSelectedDate as $slot): ?>
                    <div>
                        <?= Html::radio('time', false, [
                            'value' => $slot['slot_start'],
                            'id' => 'slot_' . md5($slot['slot_start'])
                        ]) ?>
                        <?= Html::label(
                            date('H:i', strtotime($slot['slot_start'])) . ' - ' . date('H:i', strtotime($slot['slot_end'])),
                            'slot_' . md5($slot['slot_start'])
                        ) ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <?= Html::hiddenInput('service', $selectedService) ?>
            <?= Html::hiddenInput('personal', $selectedPersonal) ?>
            <?= Html::hiddenInput('stage', 'time') ?>
            <?= Html::hiddenInput('date', $selectedDate) ?>
            <div style="margin-top:1em;"><?= Html::submitButton('Записаться', ['class' => 'btn btn-success']) ?></div>
            <?php ActiveForm::end(); ?>
        </div>
    <?php elseif ($selectedDate): ?>
        <div class="container" style="margin-top:2em;">
            <div class="alert alert-warning">Нет доступных слотов на выбранную дату.</div>
        </div>
    <?php endif; ?>
<?php endif; ?>


<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial, 'Segoe UI';
}
#calendar {
  display: grid;
  grid-template-columns: repeat(7, auto);
}
.block {
  height: 3.125em;
  margin: .125em;
  display: grid;
  background-color: rgb(221, 255, 204);
  align-items: center;
  justify-content: center;
  cursor: pointer;
  user-select: none;
  -webkit-user-select: none;
}
.name, .block {
  text-align: center;
}

.name {
  font-weight: 700;
}

.empty {
  background-color: rgb(247, 247, 247);
}

.active {
  background-color: rgb(255, 192, 189);
}
.time {
    display: inline-block;
    background: #01afa2;
    width: 135px;
    padding: 9px;
    border-radius: 8px;
    margin: 10px auto;
    cursor: pointer;
}
</style>