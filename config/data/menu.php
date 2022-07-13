<?php

return [
    (object)[
        "name" => "Master Data",
        "route" => "master.index",
        "prefix" => "master",
        "role" => "Admin"
    ],

    (object)[
        "name" => "Data Diri",
        "route" => "profile",
        "prefix" => "profile",
        "role" => "Lecturer"
    ],
    (object)[
        "name" => "Promosi",
        "route" => "promote.index",
        "prefix" => "promote",
        "role" => "Lecturer"
    ],
];
