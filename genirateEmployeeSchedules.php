<?php
class genirateEmployeeSchedules {
    function get($day)
    {
        $list = [];

        $startDate = new DateTime(); // начальная дата (можно менять)

        for ($i = 0; $i < $day; $i++) {
            $currentDate = clone $startDate;
            $currentDate->add(new DateInterval("P{$i}D")); // прибавляем $i дней

            $dateStr = $currentDate->format('Y-m-d');

            $list[] = [
                "id" => $i++,
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

            $list[] = [
                "id" => $i++,
                "employee_id" => 3,
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
    }
}