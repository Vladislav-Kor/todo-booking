<?php
$x = (int)date('d'); // текущий день месяца
$list = [];

$startDate = new DateTime(); // начальная дата (можно менять)
$interval = new DateInterval('P1D'); // интервал 1 день

for ($i = 0; $i < 30; $i++) {
    $currentDate = clone $startDate;
    $currentDate->add(new DateInterval("P{$i}D")); // прибавляем $i дней

    $dateStr = $currentDate->format('Y-m-d');

    $list[] = [
        "id" => 10,
        "employee_id" => 2,
        "start_datetime" => $dateStr . " 09:00:00",
        "breaks" => [
            [
                "start_datetime" => $dateStr . " 12:00:00",
                "end_datetime" => $dateStr . " 13:00:00"
            ]
        ],
        "end_datetime" => $dateStr . " 18:00:00"
    ];
}

return $list;
