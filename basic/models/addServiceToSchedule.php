<?php

/**
 * Запись пользователя на услугу к мастеру
 * на определенное время 
 * в графике его расписания рабочего дня
 */
class addServiceToSchedule {
    private $listemployeeSchedules__construct;
    private $listPersonal__construct;
    private $listService__construct;
    private $listServiceSchedules__construct;

    public function __construct($employeeSchedules, $listPersonal, $listService, $listServiceSchedules) {
        $this->listemployeeSchedules__construct = $employeeSchedules;
        $this->listPersonal__construct = $listPersonal;
        $this->listService__construct = $listService;
        $this->listServiceSchedules__construct = $listServiceSchedules;
    }

    function add($employeeName, $serviceName, $startDateTime)
    {
        $success = true;
        
        // Поиск сотрудника
        $employee = null;
        foreach ($this->listPersonal__construct as $person) {
            if ($person["name"] === $employeeName) {
                $employee = $person;
                break;
            }
        }
        if (!$employee) {
            echo "Ошибка: сотредник не найден\n";
            $success = false;
        }
        // Поиск услуги
        $service = null;
        foreach ($this->listService__construct as $srv) {
            if ($srv["name"] === $serviceName) {
                $service = $srv;
                break;
            }
        }
        if (!$service) {
            echo "Ошибка: услуга не найдела\n";
            $success = false;
        }
        $startTimestamp = strtotime($startDateTime);
        if ($startTimestamp === false) {
            $success = false;
        }
        // Преобразуем длительность услуги в секунды
        $serviceDurationSeconds = (int)$service["date"];
        $endTimestamp = $startTimestamp + $serviceDurationSeconds;
        $endDateTime = date("Y-m-d H:i", $endTimestamp);

        foreach ($this->listemployeeSchedules__construct as $key) {
            if ($key["employee_id"] === $employee["id"]) {
                if (!empty($this->listServiceSchedules__construct)) {
                    foreach ($this->listServiceSchedules__construct as $serviceSchedules) {
                        if ($serviceSchedules["employee_id"] === $employee["id"]) {
                            if (strtotime($startTimestamp) === strtotime($serviceSchedules["start_datetime"]) 
                            || strtotime($endDateTime) === strtotime($serviceSchedules["end_datetime"]) 
                            || strtotime($endDateTime) === strtotime($serviceSchedules["start_datetime"])
                            || strtotime($startTimestamp) === strtotime($serviceSchedules["end_datetime"])
                            ) {
                                $success = false;
                            }
                        }
                    }
                }
            }
        }

        // Добавление записи в сервисное расписание
        if (!empty($this->listServiceSchedules__construct)) {
            $newId = count($this->listServiceSchedules__construct) + 1;
            $this->listServiceSchedules__construct[] = [
                "id" => $newId,
                "employee_id" => $employee["id"],
                "service_id" => $service["id"],
                "start_datetime" => date("Y-m-d H:i", $startTimestamp),
                "end_datetime" => $endDateTime,
                "status" => "запланировано",
            ];
        } else {
            $this->listServiceSchedules__construct[] = [
                "id" => 1,
                "employee_id" => $employee["id"],
                "service_id" => $service["id"],
                "start_datetime" => date("Y-m-d H:i", $startTimestamp),
                "end_datetime" => $endDateTime,
                "status" => "запланировано",
            ];
        }
        
        if ($success) {
            echo "График успешно обновлен!\n";
            print_r($this->listServiceSchedules__construct);
            return $this->listServiceSchedules__construct;
        } else {
            echo "Ошибка: сотрудник занят\n";
        }
        
    }
}

