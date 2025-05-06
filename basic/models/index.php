<?php
include "addServiceToSchedule.php";
include "generateEmployeeTimeSlotsToDo.php";

$listPersonal = [
    0=>[
        "id"=>1,
        "name"=>"cityCrick",
        "position"=>"Масажист",
        "picture"=>"ico.jpg",
        "admin_id" => 0,
        "email" => "citi_crick@gmale.come",
        "serviciesList"=>[],
        "rightsAdmin"=>0,
        "description"=>"",
        "role" =>"Administrator",
    ],
    1=>[
        "id"=>2,
        "name"=>"Виктория",
        "position"=>"Масажист",
        "picture"=>"ico2.jpg",
        "admin_id" => 1,
        "email" => "citi_crick@gmale.come",
        "serviciesList"=>[
            1,
            2
        ],
        "rightsAdmin"=>1,
        "description"=>"Замечательный масажист который действительно знает свою професию на все 100%",
        "role" =>"Service provider",
    ],
    2=>[
        "id"=>3,
        "name"=>"Фекла",
        "position"=>"Масажист",
        "picture"=>"ico3.jpg",
        "admin_id" => 1,
        "email" => "citi_crick@gmale.come",
        "serviciesList"=>[
            1,2,3
        ],
        "rightsAdmin"=>2,
        "description"=>"Замечательный масажист который действительно знает свою професию на все 100%",
        "role" =>"Service provider",
    ],
];
$listGroopsRightsAdmin = [
    0 => [
        "id" => 1,
        "name"=>"Масажисты",
        "crudService" => 0,
        "crudTarif" => 0,
        "crudTovar" => 0,
        "todolist" => 1
    ],
    1 => [
        "id" => 2,
        "name"=>"Администратор Масажист",
        "crudService" => 1,
        "crudTarif" => 1,
        "crudTovar" => 1,
        "todolist" => 1
    ],
];

$listEmployeeSchedules = 
[
    [
        "id"=>10,
        "employee_id"=>2,
        "start_datetime"=>"2025-04-25 12:00:00",
        "breaks"=>[
        [
            "start_datetime"=>"2025-04-25 12:00:00",
            "end_datetime"=>"2025-04-25 13:00:00"
        ]
        ],
        "end_datetime"=>"2025-04-25 18:00:00"
    ],
    [
        "id"=>10,
        "employee_id"=>2,
        "start_datetime"=>"2025-04-29 09:00:00",
        "breaks"=>[
        [
            "start_datetime"=>"2025-04-29 12:00:00",
            "end_datetime"=>"2025-04-29 13:00:00"
        ]
        ],
        "end_datetime"=>"2025-04-29 18:00:00"
    ],
    [
        "id"=>10,
        "employee_id"=>2,
        "start_datetime"=>"2025-04-30 09:00:00",
        "breaks"=>[
        [
            "start_datetime"=>"2025-04-30 12:00:00",
            "end_datetime"=>"2025-04-27 13:00:00"
        ]
        ],
        "end_datetime"=>"2025-04-30 18:00:00"
    ],
    [
        "id"=>16,
        "employee_id"=>2,
        "start_datetime"=>"2025-05-01 12:00:00",
        "breaks"=>[
            [
                "start_datetime"=>"2025-05-01 12:00:00",
                "end_datetime"=>"2025-05-01 13:00:00"
            ]
        ],
        "end_datetime"=>"2025-05-01 18:00:00"
    ],
    [
        "id"=>17,
        "employee_id"=>2,
        "start_datetime"=>"2025-05-02 09:00:00",
        "breaks"=>[
        [
            "start_datetime"=>"2025-05-02 12:00:00",
            "end_datetime"=>"2025-05-02 13:00:00"
        ]
        ],
        "end_datetime"=>"2025-05-02 18:00:00"
    ],
    [
        "id"=>18,
        "employee_id"=>2,
        "start_datetime"=>"2025-05-03 09:00:00",
        "breaks"=>[
        [
            "start_datetime"=>"2025-05-03 12:00:00",
            "end_datetime"=>"2025-05-03 13:00:00"
        ]
        ],
        "end_datetime"=>"2025-05-03 18:00:00"
    ],
    [
        "id"=>19,
        "employee_id"=>2,
        "start_datetime"=>"2025-05-04 09:00:00",
        "breaks"=>[
        [
            "start_datetime"=>"2025-05-04 12:00:00",
            "end_datetime"=>"2025-05-04 13:00:00"
        ]
        ],
        "end_datetime"=>"2025-05-04 18:00:00"
    ],
    [
        "id"=>20,
        "employee_id"=>2,
        "start_datetime"=>"2025-05-05 09:00:00",
        "breaks"=>[
        [
            "start_datetime"=>"2025-05-05 12:00:00",
            "end_datetime"=>"2025-05-05 13:00:00"
        ]
        ],
        "end_datetime"=>"2025-05-05 18:00:00"
    ],
    [
        "id"=>21,
        "employee_id"=>2,
        "start_datetime"=>"2025-05-06 09:00:00",
        "breaks"=>[
        [
            "start_datetime"=>"2025-05-06 12:00:00",
            "end_datetime"=>"2025-05-06 13:00:00"
        ]
        ],
        "end_datetime"=>"2025-05-06 18:00:00"
    ],
    [
        "id"=>22,
        "employee_id"=>2,
        "start_datetime"=>"2025-05-07 09:00:00",
        "breaks"=>[
        [
            "start_datetime"=>"2025-05-07 12:00:00",
            "end_datetime"=>"2025-05-07 13:00:00"
        ]
        ],
        "end_datetime"=>"2025-05-07 18:00:00"
    ]      
];

$listService = [
    [
        "id"=>2,
        "name"=>"Масаж пяток",
        "date" => 80 * 60,
        "plannedSchedule" => false,
        "maxPeople" => 1
    ],
    [
        "id"=>1,
        "name"=>"Масаж Головы",
        "date" => 60 * 60,
        "plannedSchedule" => false,
        "maxPeople" => 1
    ],
    [
        "id"=>3,
        "name"=>"Масаж спины",
        "date" => 40 * 60,
        "plannedSchedule" => false,
        "maxPeople" => 1
    ],

    [
        "id"=>4,
        "name"=>"BODY Масаж",
        "date" => 20 * 60,
        "plannedSchedule" => false,
        "maxPeople" => 1
    ],
    [
        "id"=>5,
        "name"=>"Масаж шеи",
        "date" => 15 * 60,
        "plannedSchedule" => false,
        "maxPeople" => 1
    ],
    [
        "id"=>6,
        "name"=>"Фестиваль масажа",
        "date" => (60*3) * 60,
        "plannedSchedule" => true,
        "maxPeople" => 2
    ]
];

$plannedSchedule = [
    [
        "service_id"=>6,
        "start_datetime" => "2025-04-30 10:30",
        "end_datetime" => "2025-04-30 13:30",
        "people" => 2
    ],
    [
        "service_id"=>6,
        "start_datetime" => "2025-04-27 16:00",
        "end_datetime" => "2025-04-27 18:00",
        "people" => 2
    ],
    [
        "service_id"=>6,
        "start_datetime" => "2025-04-29 10:30",
        "end_datetime" => "2025-04-29 13:30",
        "people" => 2
    ],
    [
        "service_id"=>6,
        "start_datetime" => "2025-04-29 16:00",
        "end_datetime" => "2025-04-29 18:00",
        "people" => 2
    ],
    [
        "service_id"=>6,
        "start_datetime" => "2025-04-29 10:30",
        "end_datetime" => "2025-04-29 13:30",
        "people" => 2
    ],
    [
        "service_id"=>6,
        "start_datetime" => "2025-04-30 16:00",
        "end_datetime" => "2025-04-30 18:00",
        "people" => 2
    ]
];

$listServiceSchedules = [
    // 0 => 
    //     [
    //         "id" => 1,
    //         "employee_id" => 2,
    //         "service_id" => 2,
    //         "start_datetime" => "2025-04-27 10:45:00",
    //         "end_datetime" => "2025-04-27 11:30:00",
    //         "status" => "запланировано",
    //     ],
    // 1 => 
    //     [
    //         "id" => 2,
    //         "employee_id" => 2,
    //         "service_id" => 2,
    //         "start_datetime" => "2025-04-25 16:25:00",
    //         "end_datetime" => "2025-04-25 16:35:00",
    //         "status" => "запланировано",
    //     ]
];

$timeStep = 30 * 60;

class todoList {
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

    function splitEmployeeScheduleWithServices($employeeName)
    {
        $result = [];
        // Поиск сотрудника
        $employee = null;
        foreach ($this->listPersonal__construct as $person) {
            if ($person["name"] === $employeeName) {
                $employee = $person;
                break;
            }
        }
        if (!$employee) {
            return print_r("Сотрудник не найден");
        }
        foreach ($this->listemployeeSchedules__construct as $work) {
            if ($employee["id"] === $work["employee_id"]) {              
                $start = strtotime($work["start_datetime"]);
                $end = strtotime($work["end_datetime"]);

                while ($start < $end) {
                    $slotStart = $start;
                    $slotEnd = min($start + 30 * 60, $end); // 30 минут или до конца рабочего времени

                    // Найти услуги, которые пересекаются с этим слотом
                    $servicesInSlot = [];
                    $servicesInSlot = [];
                    foreach ($this->listServiceSchedules__construct as $srv) {
                        if ($srv["employee_id"] === $employee["id"]) {                    
                            $serviceStart = strtotime($srv["start_datetime"]);
                            $serviceEnd = strtotime($srv["end_datetime"]);
                            foreach ($this->listService__construct as $service) {
                                if ($service["id"] === $srv["service_id"]) {
                                    // Проверка на пересечение интервалов
                                    if ($serviceStart < $slotEnd && $serviceEnd > $slotStart) {
                                        $servicesInSlot[] = $service["name"];
                                    }
                                }
                                
                            }
                        }
                    }

                    $result[] = [
                        "slot_start" => date("Y-m-d H:i", $slotStart),
                        "slot_end" => date("Y-m-d H:i", $slotEnd),
                        "services" => $servicesInSlot
                    ];

                    $start += 30 * 60; // следующий слот
                }
            } 
        }

        print_r($result);

    }

    
}

$active = true;

while($active){
    $toDoList = new todoList($listEmployeeSchedules, $listPersonal, $listService, $listServiceSchedules);
    $toDoListadd = new addServiceToSchedule($listEmployeeSchedules, $listPersonal, $listService, $listServiceSchedules);
    $generateToDoList = new generateEmployeeTimeSlotsToDo($listEmployeeSchedules, $listPersonal, $listService, $listServiceSchedules, $plannedSchedule);

    // foreach ($listPersonal as $key) {
    //     print_r($key["name"]."\n");
    // }
    // echo "Введите имя Сотрудника: ";
    
    // $employeeName = trim(fgets(STDIN));
    // foreach ($listService as $key) {
    //     print_r($key["name"]." ".$key["date"]." минут \n");
    // }
    // echo "Введите оказываемую услугу: ";
    // $serviceName = trim(fgets(STDIN));
    // echo "График на когда можно записаться на услугу : $serviceName \nкоторый выполнит специалист: $employeeName \n" ;

    // Выводим список сотрудников с номерами
    foreach ($listPersonal as $index => $person) {
        echo ($index + 1) . ". " . $person["name"] . "\n";
    }
    echo "Введите номер сотрудника: ";
    $employeeIndex = (int)trim(fgets(STDIN)) - 1;
    $employeeName = $listPersonal[$employeeIndex]["name"] ?? null;

    if (!$employeeName) {
        echo "Некорректный выбор сотрудника\n";
        exit;
    }

    // Аналогично для услуг
    foreach ($listService as $index => $service) {
        echo ($index + 1) . ". " . $service["name"] . " " . ($service["date"] / 60) . " минут\n";
    }
    echo "Введите номер услуги: ";
    $serviceIndex = (int)trim(fgets(STDIN)) - 1;
    $serviceName = $listService[$serviceIndex]["name"] ?? null;

    if (!$serviceName) {
        echo "Некорректный выбор услуги\n";
        exit;
    }

    echo "Вы выбрали сотрудника: $employeeName\n";
    echo "а услугу вы выбрали: $serviceName\n";

    ### вывести график сотрудника со списком услуг
    // $result = $toDoList->splitEmployeeScheduleWithServices($employeeName);

    ### записаться на прием
    $generateToDoList->getTodoInDosty(trim($employeeName), trim($serviceName), (int)$timeStep);


    echo "\nВведите Выбранное время: ";
    $date = trim(fgets(STDIN));
    if ($date ==="") {
        break;
    }
    ### записаться на услугу к мастеру
    $listServiceSchedules = $toDoListadd->add($employeeName, $serviceName, $date);
    
    echo "\nЗаписаться еще раз : ";
    $active = trim(fgets(STDIN));
    switch ($active) {
        case "да":
            $active = true;
            break;
        case "д":
            $active = true;
            break;
        case "1":
            $active = true;
            break;
        case "2":
            $active = true;
            break;
        case "y":
            $active = true;
            break;
        case "н":
            $active = true;
            break;
        case "yes":
            $active = true;
            break;     
        default:
            $active = false;
            break;
    }
}

echo "И так\n";
echo "Вы записались на\n";
foreach ($listServiceSchedules as $index => $ServiceSchedules) {
    // $ServiceSchedules["start_datetime"]
    foreach ($listPersonal as $person) {
        if ($person["id"]=== $ServiceSchedules["employee_id"]) {
            $personName = $person["name"];
        }
    }
    foreach ($listService as $service) {
        if ($service["id"]=== $ServiceSchedules["service_id"]) {
            $serviceName = $service["name"];
        }
    }
    
    echo ($index + 1) . ". " . $serviceName . " C " .$ServiceSchedules["start_datetime"]. " К мастеру: " . $personName . "\n";
}



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

            // Проверяем занятость слота
            $occupiedService = $this->checkSlotOccupation($employeeId, $slotStart, $slotEnd, $brunch);

            // Если слот занят, сдвигаем время начала на конец занятости
            if ($occupiedService !== null) {
                $current = max($current, $occupiedService["end"]);
                continue;
            }

            // Добавляем слот в результат
            $slots[] = [
                "slot_start" => date("Y-m-d H:i", $slotStart),
                "slot_end" => date("Y-m-d H:i", $slotEnd),
                "services" => "",
            ];

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
                "name" => "Обед",
                "start" => $slotStart,
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
                if ($service["plannedSchedule"] && $service["maxPeople"] < ++$service["maxPeople"]) {
                    return [
                        "name" => $service["name"],
                        "start" => $serviceStart,
                        "end" => $serviceEnd,
                    ];
                }
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
            echo " C " . $slot["slot_start"] . " По " . $slot["slot_end"];
            if ($slot["services"] !== "") {
                echo " - занято - услугой: " . $slot["services"];
            } else {
                echo " - свободно";
            }
            echo "\n";
        }
    }
}



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

