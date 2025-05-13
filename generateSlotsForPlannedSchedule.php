<?php
class generateSlotsForPlannedSchedule {
    // Приватные свойства для хранения данных
    private $plannedSchedule;   // Расписания услуг

    // Конструктор класса: инициализирует все необходимые данные
    public function __construct($plannedSchedule) {
        $this->plannedSchedule = $plannedSchedule;
    }

    public function generateSlotsForPlannedSchedule($schedule, $startTime, $service) {
        $slots = [];
        // Начинаем с максимума между текущим временем и началом рабочего интервала
        $workStart = max($startTime, strtotime($schedule["start_datetime"]));
        $workEnd = strtotime($schedule["end_datetime"]);
        // Перебираем все запланированные слоты из общего расписания
        foreach ($this->plannedSchedule as $key) {
            // Проверяем, что услуга совпадает и слот попадает в рабочее время сотрудника
            if ($service["id"] == $key["service_id"]) {
                $slotStart = strtotime($key["start_datetime"]);
                $slotEnd = strtotime($key["end_datetime"]);
                // Проверяем, что слот находится в пределах рабочего времени
                if ($workEnd > $slotEnd && $slotStart < $workStart) { 
                    // Проверяем, что количество занятых мест не превышает максимум
                    $peopleCount = isset($key["people"]) ? (int)$key["people"] : 0;
                    $peopleDisplay = "";
                    if ($peopleCount > (int)$service["maxPeople"]) {
                        $peopleDisplay = $peopleCount; // достигнут максимум
                    }
                    $slotData = [
                        "start_datetime" => date("Y-m-d H:i", $slotStart),
                        "end_datetime" => date("Y-m-d H:i", $slotEnd),
                        "name" => $peopleDisplay.'',
                    ];
                    
                    if (!in_array($slotData, $slots)) {
                        $slots[] = $slotData;
                    }
                }
            }
        }
    
        return $slots;
    }

}