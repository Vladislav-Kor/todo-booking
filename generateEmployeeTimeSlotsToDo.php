<?php

// Класс для генерации свободных временных слотов сотрудника с учётом расписания и занятости
include "generateSlotsForSchedule.php";
include "generateSlotsForSchedule.php";

class generateEmployeeTimeSlotsToDo {
    // Приватные свойства для хранения данных
    private $employeeSchedules; // Расписания сотрудников
    private $personalList;       // Список сотрудников
    private $serviceList;        // Список услуг
    private $serviceSchedules;   // Бронирование услуг
    private $plannedSchedule;   // Расписания услуг

    // Конструктор класса: инициализирует все необходимые данные
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
                $model = new generateSlotsForSchedule($this->serviceList, $this->serviceSchedules);
                $slots = $model->generateSlotsForSchedule(
                    $schedule, // график сотрудника
                    $roundedTimestamp, // текущий округленный временной шаг
                    $duration, // период исполнения услуги
                    $timeStep, // временной шаг
                    $employee["id"], // сотрудник
                    $service["name"]
                );
                $result = array_merge($result, $slots);
            } else {
                $model = new generateSlotsForPlannedSchedule($this->plannedSchedule);
                $slots = $model->generateSlotsForPlannedSchedule(
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

    // Вывод слотов в консоль
    private function printSlots(array $slots): void {
        foreach ($slots as $slot) {
            echo " C " . $slot["start_datetime"] . " По " . $slot["end_datetime"];
            if ($slot["name"] !== "") {
                echo " услугa: " . $slot["name"];
            } else {
                echo " - свободно";
            }
            echo "\n";
        }
    }
}
