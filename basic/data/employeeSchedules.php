<?php
$x = (int)date('d');
$list = [];
for ($i=$x-1; $i < ($x+30); $i++) { 
    if ($i<10) {
        $list[] = [
            "id"=>10,
            "employee_id"=>2,
            "start_datetime"=>"2025-0$i-25 09:00:00",
            "breaks"=>[
            [
                "start_datetime"=>"2025-0$i-25 12:00:00",
                "end_datetime"=>"2025-0$i-25 13:00:00"
            ]
            ],
            "end_datetime"=>"2025-0$i-25 18:00:00"
        ];
    }else{
        $list[] = [
            "id"=>10,
            "employee_id"=>2,
            "start_datetime"=>"2025-$i-25 12:00:00",
            "breaks"=>[
            [
                "start_datetime"=>"2025-$i-25 12:00:00",
                "end_datetime"=>"2025-$i-25 13:00:00"
            ]
            ],
            "end_datetime"=>"2025-$i-25 18:00:00"
        ];
    }
}
return $list;
// [
//     [
//         "id"=>10,
//         "employee_id"=>2,
//         "start_datetime"=>"2025-$x-25 12:00:00",
//         "breaks"=>[
//         [
//             "start_datetime"=>"2025-$x-25 12:00:00",
//             "end_datetime"=>"2025-$x-25 13:00:00"
//         ]
//         ],
//         "end_datetime"=>"2025-$x-25 18:00:00"
//     ],
//     [
//         "id"=>10,
//         "employee_id"=>2,
//         "start_datetime"=>"2025-$x-29 09:00:00",
//         "breaks"=>[
//         [
//             "start_datetime"=>"2025-$x-29 12:00:00",
//             "end_datetime"=>"2025-$x-29 13:00:00"
//         ]
//         ],
//         "end_datetime"=>"2025-$x-29 18:00:00"
//     ],
//     [
//         "id"=>10,
//         "employee_id"=>2,
//         "start_datetime"=>"2025-$x-30 09:00:00",
//         "breaks"=>[
//         [
//             "start_datetime"=>"2025-$x-30 12:00:00",
//             "end_datetime"=>"2025-$x-27 13:00:00"
//         ]
//         ],
//         "end_datetime"=>"2025-$x-30 18:00:00"
//     ],
//     [
//         "id"=>16,
//         "employee_id"=>2,
//         "start_datetime"=>"2025-05-01 12:00:00",
//         "breaks"=>[
//             [
//                 "start_datetime"=>"2025-05-01 12:00:00",
//                 "end_datetime"=>"2025-05-01 13:00:00"
//             ]
//         ],
//         "end_datetime"=>"2025-05-01 18:00:00"
//     ],
//     [
//         "id"=>17,
//         "employee_id"=>2,
//         "start_datetime"=>"2025-05-02 09:00:00",
//         "breaks"=>[
//         [
//             "start_datetime"=>"2025-05-02 12:00:00",
//             "end_datetime"=>"2025-05-02 13:00:00"
//         ]
//         ],
//         "end_datetime"=>"2025-05-02 18:00:00"
//     ],
//     [
//         "id"=>18,
//         "employee_id"=>2,
//         "start_datetime"=>"2025-05-03 09:00:00",
//         "breaks"=>[
//         [
//             "start_datetime"=>"2025-05-03 12:00:00",
//             "end_datetime"=>"2025-05-03 13:00:00"
//         ]
//         ],
//         "end_datetime"=>"2025-05-03 18:00:00"
//     ],
//     [
//         "id"=>19,
//         "employee_id"=>2,
//         "start_datetime"=>"2025-05-04 09:00:00",
//         "breaks"=>[
//         [
//             "start_datetime"=>"2025-05-04 12:00:00",
//             "end_datetime"=>"2025-05-04 13:00:00"
//         ]
//         ],
//         "end_datetime"=>"2025-05-04 18:00:00"
//     ],
//     [
//         "id"=>20,
//         "employee_id"=>2,
//         "start_datetime"=>"2025-05-05 09:00:00",
//         "breaks"=>[
//         [
//             "start_datetime"=>"2025-05-05 12:00:00",
//             "end_datetime"=>"2025-05-05 13:00:00"
//         ]
//         ],
//         "end_datetime"=>"2025-05-05 18:00:00"
//     ],
//     [
//         "id"=>21,
//         "employee_id"=>2,
//         "start_datetime"=>"2025-05-06 09:00:00",
//         "breaks"=>[
//         [
//             "start_datetime"=>"2025-05-06 12:00:00",
//             "end_datetime"=>"2025-05-06 13:00:00"
//         ]
//         ],
//         "end_datetime"=>"2025-05-06 18:00:00"
//     ],
//     [
//         "id"=>22,
//         "employee_id"=>2,
//         "start_datetime"=>"2025-05-07 09:00:00",
//         "breaks"=>[
//         [
//             "start_datetime"=>"2025-05-07 12:00:00",
//             "end_datetime"=>"2025-05-07 13:00:00"
//         ]
//         ],
//         "end_datetime"=>"2025-05-07 18:00:00"
//     ]      
//     ,[
//         "id"=>10,
//         "employee_id"=>3,
//         "start_datetime"=>"2025-$x-25 12:00:00",
//         "breaks"=>[
//         [
//             "start_datetime"=>"2025-$x-25 12:00:00",
//             "end_datetime"=>"2025-$x-25 13:00:00"
//         ]
//         ],
//         "end_datetime"=>"2025-$x-25 18:00:00"
//     ],
//     [
//         "id"=>10,
//         "employee_id"=>3,
//         "start_datetime"=>"2025-$x-29 09:00:00",
//         "breaks"=>[
//         [
//             "start_datetime"=>"2025-$x-29 12:00:00",
//             "end_datetime"=>"2025-$x-29 13:00:00"
//         ]
//         ],
//         "end_datetime"=>"2025-$x-29 18:00:00"
//     ],
//     [
//         "id"=>10,
//         "employee_id"=>3,
//         "start_datetime"=>"2025-$x-30 09:00:00",
//         "breaks"=>[
//         [
//             "start_datetime"=>"2025-$x-30 12:00:00",
//             "end_datetime"=>"2025-$x-27 13:00:00"
//         ]
//         ],
//         "end_datetime"=>"2025-$x-30 18:00:00"
//     ],
//     [
//         "id"=>16,
//         "employee_id"=>3,
//         "start_datetime"=>"2025-05-01 12:00:00",
//         "breaks"=>[
//             [
//                 "start_datetime"=>"2025-05-01 12:00:00",
//                 "end_datetime"=>"2025-05-01 13:00:00"
//             ]
//         ],
//         "end_datetime"=>"2025-05-01 18:00:00"
//     ],
//     [
//         "id"=>17,
//         "employee_id"=>3,
//         "start_datetime"=>"2025-05-02 09:00:00",
//         "breaks"=>[
//         [
//             "start_datetime"=>"2025-05-02 12:00:00",
//             "end_datetime"=>"2025-05-02 13:00:00"
//         ]
//         ],
//         "end_datetime"=>"2025-05-02 18:00:00"
//     ],
//     [
//         "id"=>18,
//         "employee_id"=>3,
//         "start_datetime"=>"2025-05-03 09:00:00",
//         "breaks"=>[
//         [
//             "start_datetime"=>"2025-05-03 12:00:00",
//             "end_datetime"=>"2025-05-03 13:00:00"
//         ]
//         ],
//         "end_datetime"=>"2025-05-03 18:00:00"
//     ],
//     [
//         "id"=>19,
//         "employee_id"=>3,
//         "start_datetime"=>"2025-05-04 09:00:00",
//         "breaks"=>[
//         [
//             "start_datetime"=>"2025-05-04 12:00:00",
//             "end_datetime"=>"2025-05-04 13:00:00"
//         ]
//         ],
//         "end_datetime"=>"2025-05-04 18:00:00"
//     ],
//     [
//         "id"=>20,
//         "employee_id"=>3,
//         "start_datetime"=>"2025-05-05 09:00:00",
//         "breaks"=>[
//         [
//             "start_datetime"=>"2025-05-05 12:00:00",
//             "end_datetime"=>"2025-05-05 13:00:00"
//         ]
//         ],
//         "end_datetime"=>"2025-05-05 18:00:00"
//     ],
//     [
//         "id"=>21,
//         "employee_id"=>3,
//         "start_datetime"=>"2025-05-06 09:00:00",
//         "breaks"=>[
//         [
//             "start_datetime"=>"2025-05-06 12:00:00",
//             "end_datetime"=>"2025-05-06 13:00:00"
//         ]
//         ],
//         "end_datetime"=>"2025-05-06 18:00:00"
//     ],
//     [
//         "id"=>22,
//         "employee_id"=>3,
//         "start_datetime"=>"2025-05-07 09:00:00",
//         "breaks"=>[
//         [
//             "start_datetime"=>"2025-05-07 12:00:00",
//             "end_datetime"=>"2025-05-07 13:00:00"
//         ]
//         ],
//         "end_datetime"=>"2025-05-07 18:00:00"
//     ]      
// ];