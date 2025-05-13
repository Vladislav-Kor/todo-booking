<?php

/**
 * Запись пользователя на услугу к мастеру
 * на определенное время 
 * в графике его расписания рабочего дня
 */
class addServiceToSchedule {
    private $listemployeeSchedules__construct; // Расписание сотрудников
    private $listPersonal__construct;          // Список сотрудников
    private $listService__construct;           // Список услуг
    private $listServiceSchedules__construct;  // Существующие записи

    public function __construct(
        $employeeSchedules,  // График работы сотрудников
        $listPersonal,       // Профили мастеров
        $listService,        // Услуги салона
        $listServiceSchedules // Активные записи
    ) {
        $this->listemployeeSchedules__construct = $employeeSchedules;
        $this->listPersonal__construct = $listPersonal;
        $this->listService__construct = $listService;
        $this->listServiceSchedules__construct = $listServiceSchedules;
    }

    /**
     * Метод для добавления записи пользователя на услугу к мастеру
     * 
     * @param string $employeeName - имя сотрудника (мастера)
     * @param string $serviceName - название услуги
     * @param string $startDateTime - дата и время начала услуги (формат "Y-m-d H:i")
     * @param int $peopleCount - количество человек (например, для групповых услуг)
     * 
     * @return array - обновлённый список записей на услуги
     */
    function add($employeeName, $serviceName, $startDateTime, $peopleCount)
    {
        $success = true; // Флаг успешности операции

        // 1. Поиск сотрудника по имени в списке персонала
        $employee = null;
        foreach ($this->listPersonal__construct as $person) {
            if ($person["name"] === $employeeName) {
                $employee = $person;
                break;
            }
        }
        if (!$employee) {
            // Если сотрудник не найден - выводим ошибку и помечаем неуспех
            echo "Ошибка: сотрудник не найден\n";
            $success = false;
        }

        // 2. Поиск услуги по названию в списке услуг
        $service = null;
        foreach ($this->listService__construct as $srv) {
            if ($srv["name"] === $serviceName) {
                $service = $srv;
                break;
            }
        }
        if (!$service) {
            // Если услуга не найдена - выводим ошибку и помечаем неуспех
            echo "Ошибка: услуга не найдена\n";
            $success = false;
        }

        // 3. Преобразование даты и времени начала в timestamp
        $startTimestamp = strtotime($startDateTime);
        if ($startTimestamp === false) {
            // Если дата некорректна - помечаем ошибку
            echo "Ошибка: неверный формат даты и времени\n";
            $success = false;
        }

        // 4. Получение длительности услуги в секундах
        $serviceDuration = (int)$service["duration"]; 

        // Вычисляем время окончания услуги
        $endTimestamp = $startTimestamp + $serviceDuration;
        $endDateTime = date("Y-m-d H:i", $endTimestamp);

        // 5. Проверка занятости сотрудника на выбранное время
        // Перебираем расписание сотрудника (график работы)
        foreach ($this->listemployeeSchedules__construct as $key) {
            if ($key["employee_id"] === $employee["id"]) {
                // Если есть уже существующие записи на услуги у этого сотрудника
                if (!empty($this->listServiceSchedules__construct)) {
                    foreach ($this->listServiceSchedules__construct as $serviceSchedules) {
                        if ($serviceSchedules["employee_id"] === $employee["id"]) {
                            // Проверяем, не пересекается ли новое время с уже существующими записями

                            // Если услуга не запланирована заранее (plannedSchedule == false)
                            if (!$service["plannedSchedule"]) {
                                // Проверяем точные совпадения начала и конца
                                if (
                                    strtotime($startDateTime) === strtotime($serviceSchedules["start_datetime"]) ||
                                    strtotime($endDateTime) === strtotime($serviceSchedules["end_datetime"]) ||
                                    strtotime($endDateTime) === strtotime($serviceSchedules["start_datetime"]) ||
                                    strtotime($startDateTime) === strtotime($serviceSchedules["end_datetime"])
                                ) {
                                    // Если время совпадает - помечаем ошибку
                                    $success = false;
                                }
                            } else {
                                // Если услуга запланирована заранее, проверяем максимальное количество людей
                                if ($service["maxPeople"] < $peopleCount) {
                                    $success = false;
                                }
                            }
                        }
                    }
                }
            }
        }

        // 6. Если проверка прошла успешно - добавляем запись в расписание услуг
        if ($success) {
            // Генерация ID для новой записи
            $id = empty($this->listServiceSchedules__construct) ? 1 : count($this->listServiceSchedules__construct) + 1;

            // Добавляем новую запись в массив расписания услуг
            $this->listServiceSchedules__construct[] = [
                "id" => $id,
                "employee_id" => $employee["id"],
                "service_id" => $service["id"],
                "start_datetime" => date("Y-m-d H:i", $startTimestamp),
                "end_datetime" => $endDateTime,
                "status" => "запланировано",
                "peopleCount" => $peopleCount
            ];

            echo "График успешно обновлен!\n";
            print_r($this->listServiceSchedules__construct);
            return $this->listServiceSchedules__construct;

        } else {
            // Если сотрудник занят или возникла другая ошибка
            echo "Ошибка: сотрудник занят или данные некорректны\n";
            return $this->listServiceSchedules__construct;
        }
    }
}