<?php
include "addServiceToSchedule.php";
include "generateEmployeeTimeSlotsToDo.php";

$listPersonal = [
    // 0=>[
    //     "id"=>1,
    //     "name"=>"cityCrick",
    //     "position"=>"Масажист",
    //     "picture"=>"ico.jpg",
    //     "admin_id" => 0,
    //     "email" => "citi_crick@gmale.come",
    //     "serviciesList"=>[],
    //     "rightsAdmin"=>0,
    //     "description"=>"",
    //     "role" =>"Administrator",
    // ],
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
        'specPrice' => [
            1,2,
            3,4,5,6
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
        'specPrice' => [
            1,2,
            3,4,5,6
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
    // [
    //     "id"=>10,
    //     "employee_id"=>2,
    //     "start_datetime"=>"2025-04-25 12:00:00",
    //     "breaks"=>[
    //     [
    //         "start_datetime"=>"2025-04-25 12:00:00",
    //         "end_datetime"=>"2025-04-25 13:00:00"
    //     ]
    //     ],
    //     "end_datetime"=>"2025-04-25 18:00:00"
    // ],
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
        "maxPeople" => 1,
        'defaltPrice' => 1600,
        'specPrice' => [
            [
                'id'=>2,
                'price' => 1800
            ],
            [
                'id'=>3,
                'price' => 1400
            ]
        ]
    ],
    [
        "id"=>1,
        "name"=>"Масаж Головы",
        "date" => 60 * 60,
        "plannedSchedule" => false,
        "maxPeople" => 1,
        'defaltPrice' => 1600,
        'specPrice' => []
    ],
    [
        "id"=>3,
        "name"=>"Масаж спины",
        "date" => 40 * 60,
        "plannedSchedule" => false,
        "maxPeople" => 1,
        'defaltPrice' => 1600,
        'specPrice' => [
            [
                'id'=>2,
                'price' => 1800
            ],
            [
                'id'=>3,
                'price' => 1400
            ]
        ]
    ],

    [
        "id"=>4,
        "name"=>"BODY Масаж",
        "date" => 20 * 60,
        "plannedSchedule" => false,
        "maxPeople" => 1,
        'defaltPrice' => 1600,
        'specPrice' => [
            [
                'id'=>2,
                'price' => 1800
            ],
            [
                'id'=>3,
                'price' => 1400
            ]
        ]
    ],
    [
        "id"=>5,
        "name"=>"Масаж шеи",
        "date" => 15 * 60,
        "plannedSchedule" => false,
        "maxPeople" => 1,
        'defaltPrice' => 1600,
        'specPrice' => []
    ],
    [
        "id"=>6,
        "name"=>"Фестиваль масажа",
        "date" => (60*3) * 60,
        "plannedSchedule" => true,
        "maxPeople" => 2,
        'defaltPrice' => 1600,
        'specPrice' => [
            [
                'id'=>2,
                'price' => 1800
            ],
            [
                'id'=>3,
                'price' => 1400
            ]
        ]
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