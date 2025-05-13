<?php
/**
 * Формирование расписания услуг на основании графика специалиста
 */
class generateSlotsForSchedule {
    // Приватные свойства для хранения данных
    private $serviceList;        // Список услуг
    private $serviceSchedules;   // Бронирование услуг

    // Конструктор класса: инициализирует все необходимые данные
    public function __construct($serviceList, $serviceSchedules, ) {
        $this->serviceList = $serviceList;
        $this->serviceSchedules = $serviceSchedules;
    }
    
    // Поиск услуги по названию в списке услуг
    private function findService($params) {
        if (is_string($params)) {
            foreach ($this->serviceList as $service) {
                if ($service["name"] === $params) {
                    return $service; // Возвращаем найденную услугу
                }
            }
            return null; // Если услуга не найдена
        }
        if (is_integer($params)) {
            foreach ($this->serviceList as $service) {
                if ($service["id"] === $params) {
                    return $service;
                }
            }
            return null;
        }

        return null;
    }

    // Генерация временных слотов для одного рабочего интервала
    public function get(array $schedule, int $startTime, int $duration, int $timeStep, int $employeeId, $name): array {
        // времяные ячеейки
        $slots = [];
        // расписание сотрудника
        $workStart = strtotime($schedule["start_datetime"]);
        $workEnd = strtotime($schedule["end_datetime"]) - $duration;
        // его обед
        $brunch = $schedule["breaks"];
        $arraySchedules = $this->arraySchedules($employeeId, $brunch);
        // Начинаем с максимума между текущим временем и началом рабочего интервала
        $current = max($startTime, $workStart);
        $slotStart = $current;
        $slotEnd = $slotStart + $duration;
        while ($current <= $workEnd) {
            // Проверяем занятость слота
            $occupiedService = $this->checkSlotOccupation($employeeId, $slotStart, $slotEnd, $arraySchedules);

            // Если слот занят, сдвигаем время начала на конец занятости
            if ($occupiedService !== null) {
                $slotStart = $occupiedService['end'];
                $slotEnd = $slotStart + $duration;
                $current += $timeStep;
                continue;
            } 
            $slotStarts = array_column($slots, 'slot_start');
            if (!in_array(date("Y-m-d H:i", $slotStart), $slotStarts) && $slotStart < $slotEnd) {
                
                // Добавляем слот в результат
                $slots[] = [
                    "start_datetime" => date("Y-m-d H:i", $slotStart),
                    "end_datetime" => date("Y-m-d H:i", $slotEnd),
                    "name" => $name,
                    "employee_id" => $employeeId
                ];
            }
            // Переходим к следующему слоту
            $current += $timeStep;
            $slotStart = $current;
            $slotEnd = $slotStart + $duration;
        }
        // Добавляем существующие записи из расписания
        foreach ($arraySchedules as $key) {
            $slots[] = [
                "start_datetime" => date("Y-m-d H:i", $key["start_datetime"]),
                "end_datetime" => date("Y-m-d H:i", $key["end_datetime"]),
                "name" => "занято ".$key["name"],
                "employee_id" => $key["employee_id"]
            ];
        }

        // Сортируем массив слотов по времени начала
        usort($slots, function($a, $b) {
            return strtotime($a['start_datetime']) <=> strtotime($b['start_datetime']);
        });

        return $slots = $this->removeDuplicates($slots);
    }


    private function removeDuplicates(array $slots): array {
        $unique = [];
        $result = [];
    
        foreach ($slots as $slot) {
            // Формируем уникальный ключ по времени начала и имени услуги
            $key = $slot['start_datetime'] . '|' . $slot['name'];
    
            if (!isset($unique[$key])) {
                $unique[$key] = true;
                $result[] = $slot;
            }
        }
    
        return $result;
    }
   
    private function arraySchedules(int $employeeId, $brunch){
        $arraySchedules = [];
        foreach ($this->serviceSchedules as $srv) {
            if ($srv["employee_id"] !== $employeeId) continue;
            $serviceStart = strtotime($srv["start_datetime"]);
            $serviceEnd = strtotime($srv["end_datetime"]);
            $servicename = $this->findService($srv["service_id"]);
            $arraySchedules[]= [
                "start_datetime" => $serviceStart,
                "end_datetime" => $serviceEnd,
                "name" => $servicename["name"],
                "employee_id" => $employeeId
            ];
        }
        foreach ($brunch as $break) {
            $breakStart = strtotime($break["start_datetime"]);
            $breakeEnd = strtotime($break["end_datetime"]);
            
            $arraySchedules[]= [
                "start_datetime" => $breakStart,
                "end_datetime" => $breakeEnd,
                "name" => "обед",
                "employee_id" => $employeeId
            ];
        }
        
        return $arraySchedules;
    }

    // Проверка занятости слота, возвращает данные о занятой услуге или null
    private function checkSlotOccupation(int $employeeId, int $slotStart, int $slotEnd, array $arraySchedules): ?array {
        foreach ($arraySchedules as $srv) {
            if ($srv["employee_id"] !== $employeeId) continue;
            $serviceStart = $srv["start_datetime"];
            $serviceEnd = $srv["end_datetime"];

            // Проверяем пересечение с занятыми услугами
            if ($serviceStart < $slotEnd && $serviceEnd > $slotStart) {
                // if ($service["plannedSchedule"] && $service["maxPeople"] < ++$service["maxPeople"]) {
                    return [
                        "name" => $srv["name"],
                        "start" => $serviceStart,
                        "end" => $serviceEnd,
                    ];
                // }
            }
        }
        return null;
    }
}