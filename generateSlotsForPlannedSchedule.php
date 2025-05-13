<?php
/**
 * Формирование услуг с четким расписанием
 */
class generateSlotsForPlannedSchedule {
    // Приватные свойства для хранения данных
    private $plannedSchedule;    // Расписания услуг
    private $serviceSchedules;   // Бронирование услуг

    // Конструктор класса: инициализирует все необходимые данные
    public function __construct($plannedSchedule, $serviceSchedules ) {
        $this->plannedSchedule = $plannedSchedule;
        $this->serviceSchedules = $serviceSchedules;
    }

    // список за одни рабочий день сотрудника
    public function get(array  $schedule, int $startTime, array $service, int $guestCount): array {
        $slots = [];
        // Начинаем с максимума между текущим временем и началом рабочего интервала
        $workStart = max($startTime, strtotime($schedule["start_datetime"]));
        $workEnd = strtotime($schedule["end_datetime"]);
        // Перебираем все запланированные слоты из общего расписания
        foreach ($this->plannedSchedule as $key) {
            try {
                $x = $this->getOnli($service, $key, $workStart, $workEnd, $guestCount);
                if (!empty($x)) {
                    $slots[] = $x;
                }
            } catch (\Exception $error) {
                // echo $error->getMessage();
                continue;
            }
        }
        return $slots;
    }

    
    private function getOnli(array $service, array $plannedSchedule, int $workStart, int $workEnd, int $guestCount): array 
    {       
        // Проверяем, что услуга совпадает и слот попадает в рабочее время сотрудника
        if ($service["id"] === $plannedSchedule["service_id"]) {
            $slotStart = strtotime($plannedSchedule["start_datetime"]);
            $slotEnd = strtotime($plannedSchedule["end_datetime"]);
            // колличество свободных мест
            $peopleCount = (int)$service["maxPeople"] - $this->peopleCount($service["id"], $plannedSchedule["start_datetime"], $plannedSchedule["end_datetime"]);// получаем колличество записей
            if ($peopleCount < $guestCount) {
                throw new Exception("Невозможно выбрать эту дату; Колличество брони превышает колличество мест\n");
            }
            // Проверяем, что слот находится в пределах рабочего времени
            if ($workEnd > $slotEnd && $slotStart < $workStart) {
                return [
                    "start_datetime" => date("Y-m-d H:i", $slotStart),
                    "end_datetime" => date("Y-m-d H:i", $slotEnd),
                    "name" => $service["name"],
                    "people" => $guestCount
                ];
            }
        }
        return [];
    }

    // Проверка занятости слота (учитывает service_id и пересечение временных интервалов)
    private function peopleCount(int $id, string $slotStart, string $slotEnd): int {
        $array = array_filter($this->serviceSchedules, function($item) use ($id, $slotStart, $slotEnd) {
            // Проверяем обязательные поля
            if (!isset($item['service_id'], $item['start_datetime'], $item['end_datetime'])) {
                return false;
            }

            // Проверяем совпадение service_id
            if ($item['service_id'] !== $id) {
                return false;
            }

            try {
                // Преобразуем даты в объекты для сравнения
                $itemStart = new DateTime($item['start_datetime']);
                $itemEnd = new DateTime($item['end_datetime']);
                $slotStartDt = new DateTime($slotStart);
                $slotEndDt = new DateTime($slotEnd);
            } catch (Exception $e) {
                return false; // Если даты некорректные
            }

            // Проверяем пересечение интервалов
            return ($itemStart < $slotEndDt) && ($itemEnd > $slotStartDt);
        });
        if(!empty($array)){
            // Суммируем значения peopleCount
            return array_sum(array_column($array, 'peopleCount'));
        }
        return 0;
    }
}