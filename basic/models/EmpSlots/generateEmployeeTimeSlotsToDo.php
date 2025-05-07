<?php
namespace app\models\EmpSlots;
// Класс для генерации свободных временных слотов сотрудника с учётом расписания и занятости

class generateEmployeeTimeSlotsToDo {
    
    private $employeeSchedules; // Расписания сотрудников
    private $personalList;       // Список сотрудников
    private $serviceList;        // Список услуг
    private $serviceSchedules;   // Бронирование услуг
    private $plannedSchedule;   // Расписания услуг

    
    public function __construct($employeeSchedules, $personalList, $serviceList, $serviceSchedules, $plannedSchedule) {
        $this->employeeSchedules = $employeeSchedules;
        $this->personalList = $personalList;
        $this->serviceList = $serviceList;
        $this->serviceSchedules = $serviceSchedules;
        $this->plannedSchedule = $plannedSchedule;
    }

    // Поиск сотрудника по имени в списке персонала
    private function findEmployeeByName($name) {
        foreach ($this->personalList as $person) {
            if ($person["name"] === $name) {
                return $person; // Возвращаем найденного сотрудника
            }
        }
        return null; // Если сотрудник не найден
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
    
    /**
     *  генерации свободных временных слотов сотрудника с учётом расписания и занятости    
     *
     * @param $employeeName $employeeName [сотрудник]
     * @param $serviceName $serviceName [услуга]
     * @param int $timeStep [определенный шаг]
     *
     * @return void
     */
    public function getTodoInDosty($employeeName, $serviceName, int $timeStep) {
        // 1. Поиск сотрудника и услуги
        $employee = $this->findEmployeeByName($employeeName);
        if (!$employee) {
            echo "Сотрудник не найден\n";
            return "Сотрудник не найден";}
    
        $service = $this->findService($serviceName);
        if (!$service) {
            echo "Услуга не найдена\n";
            return "Услуга не найдена";}
    
        // 2. Получаем текущий округленный timestamp
        $roundedTimestamp = $this->getRoundedCurrentTimestamp($timeStep);
    
        // 3. Получаем длительность услуги в секундах
        $duration = (int)$service["date"];
    
        // 4. Получаем расписание сотрудника
        $employeeSchedules = $this->getEmployeeSchedules($employee["id"]);
                
        // 5. Генерируем слоты по каждому интервалу рабочего времени
        $result = [];
        foreach ($employeeSchedules as $schedule) {
            if (!$service["plannedSchedule"]) {
                $slots = $this->generateSlotsForSchedule(
                    $schedule, // график сотрудника
                    $roundedTimestamp, // текущий округленный временной шаг
                    $duration, // период исполнения услуги
                    $timeStep, // временной шаг
                    $employee["id"] // сотрудник
                );
                $result = array_merge($result, $slots);
            } else {
                $slots = $this->generateSlotsForPlannedSchedule(
                    $schedule, // график сотрудника
                    $roundedTimestamp, // текущий округленный временной шаг
                    $service // услуга
                );
                
                $result = array_merge($result, $slots);
            }
        } 
        
        // 6. Выводим результат
        $this->printSlots($result);
    }
    

    // Округление текущего времени до ближайшего шага
    private function getRoundedCurrentTimestamp(int $timeStep): int {
        $timestamp = time();
        return (int)(ceil($timestamp / $timeStep) * $timeStep);
    }

    private function generateSlotsForPlannedSchedule($schedule, $startTime, $service) {
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
                        "slot_start" => date("Y-m-d H:i", $slotStart),
                        "slot_end" => date("Y-m-d H:i", $slotEnd),
                        "services" => $peopleDisplay.'',
                    ];
                    
                    if (!in_array($slotData, $slots)) {
                        $slots[] = $slotData;
                    }
                }
            }
        }
    
        return $slots;
    }
    

    // Получение расписания сотрудника по ID
    private function getEmployeeSchedules(int $employeeId): array {
        $schedules = [];
        foreach ($this->employeeSchedules as $schedule) {
            if ($schedule["employee_id"] === $employeeId) {
                $schedules[] = $schedule;
            }
        }
        return $schedules;
    }

    // Генерация временных слотов для одного рабочего интервала
    private function generateSlotsForSchedule(array $schedule, int $startTime, int $duration, int $timeStep, int $employeeId): array {
        // времяные ячеейки
        $slots = [];
        // расписание сотрудника
        $workStart = strtotime($schedule["start_datetime"]);
        $workEnd = strtotime($schedule["end_datetime"]) - $duration;
        // его обед
        $brunch = $schedule["breaks"];
        
        // Начинаем с максимума между текущим временем и началом рабочего интервала
        $current = max($startTime, $workStart);
        
        while ($current <= $workEnd) {
            $slotStart = $current;
            $slotEnd = $slotStart + $duration;
            $servicesStatus = '';
            // Проверяем занятость слота
            $occupiedService = $this->checkSlotOccupation($employeeId, $slotStart, $slotEnd, $brunch);
            
            // Если слот занят, сдвигаем время начала на конец занятости
            if ($occupiedService !== null) {
                $slotStart = max($current, $occupiedService['end']);
                // $servicesStatus = $occupiedService['name'];
                // $current += $timeStep;
                // continue;
            }
            $slotStarts = array_column($slots, 'slot_start');
            if (!in_array(date("Y-m-d H:i", $slotStart), $slotStarts)) {
                // Добавляем слот в результат
                $slots[] = [
                    "slot_start" => date("Y-m-d H:i", $slotStart),
                    "slot_end" => date("Y-m-d H:i", $slotEnd),
                    "services" => $servicesStatus,
                ];
            }
            // Переходим к следующему слоту
            $current += $timeStep;
        }

        return $slots;
    }

    // Проверка занятости слота, возвращает данные о занятой услуге или null
    private function checkSlotOccupation(int $employeeId, int $slotStart, int $slotEnd, array $brunch): ?array {
        // Сначала проверяем, не попадает ли слот в обед
        if ($brunchEnd = $this->isSlotInBrunch($slotStart, $slotEnd, $brunch)) {
            return [
                "name" => 'обед',
                "end" => $brunchEnd,
            ];
        }

        foreach ($this->serviceSchedules as $srv) {
            if ($srv["employee_id"] !== $employeeId) continue;
            $serviceStart = strtotime($srv["start_datetime"]);
            $serviceEnd = strtotime($srv["end_datetime"]);

            // Проверяем пересечение с занятыми услугами
            if ($serviceStart < $slotEnd && $serviceEnd > $slotStart) {
                $service = $this->findService($srv["service_id"]);
                // if ($service["plannedSchedule"] && $service["maxPeople"] < ++$service["maxPeople"]) {
                    return [
                        "name" => $service["name"],
                        "start" => $serviceStart,
                        "end" => $serviceEnd,
                    ];
                // }
            }
        }
        return null;
    }

    private function isSlotInBrunch(int $slotStart, int $slotEnd, array $brunch) {
        if (empty($brunch)) {
            return false;
        }
        foreach ($brunch as $break) {
            $brunchStart = strtotime($break["start_datetime"]);
            $brunchEnd = strtotime($break["end_datetime"]);
            // Если есть пересечение с обедом - слот попадает в обед
            if ($slotStart < $brunchEnd && $slotEnd > $brunchStart) {
                return $brunchEnd;
            }
        }
        return false;
    }

    // Вывод слотов в консоль
    private function printSlots(array $slots): void {
        foreach ($slots as $slot) {
            echo " C " . $slot["slot_start"] /*. " По " . $slot["slot_end"]*/;
            if ($slot["services"] !== "") {
                echo " - занято - услугой: " . $slot["services"];
            } else {
                echo " - свободно";
            }
            echo "\n";
        }
    }

    public function getFreeSlotsByDay($employeeName, $serviceName, $timeStep = 1800) {
        $employee = $this->findEmployeeByName($employeeName);
        if (!$employee) return [];
        $service = $this->findService($serviceName);
        if (!$service) return [];
        $roundedTimestamp = $this->getRoundedCurrentTimestamp($timeStep);
        $duration = (int)$service["date"];
        $employeeSchedules = $this->getEmployeeSchedules($employee["id"]);
        $result = [];
    
        foreach ($employeeSchedules as $schedule) {
            if (!$service["plannedSchedule"]) {
                $slots = $this->generateSlotsForSchedule(
                    $schedule, $roundedTimestamp, $duration, $timeStep, $employee["id"]
                );
            } else {
                $slots = $this->generateSlotsForPlannedSchedule(
                    $schedule, $roundedTimestamp, $service
                );
            }
            foreach ($slots as $slot) {
                $date = substr($slot['slot_start'], 0, 10); // 'YYYY-MM-DD'
                $result[$date][] = $slot;
            }
        }
        ksort($result);
        return $result; // ['2025-05-05' => [...], ...]
    }

    public function getSlotsArray($employeeName, $serviceName, int $timeStep) {
        $employee = $this->findEmployeeByName($employeeName);
        if (!$employee) return [];
        $service = $this->findService($serviceName);
        if (!$service) return [];
        $roundedTimestamp = $this->getRoundedCurrentTimestamp($timeStep);
        $duration = (int)$service["date"];
        $employeeSchedules = $this->getEmployeeSchedules($employee["id"]);
        $result = [];
        foreach ($employeeSchedules as $schedule) {
            if (!$service["plannedSchedule"]) {
                $slots = $this->generateSlotsForSchedule(
                    $schedule, $roundedTimestamp, $duration, $timeStep, $employee["id"]
                );
                $result = array_merge($result, $slots);
            } else {
                $slots = $this->generateSlotsForPlannedSchedule(
                    $schedule, $roundedTimestamp, $service
                );
                $result = array_merge($result, $slots);
            }
        }
        return $result;
    }
}
