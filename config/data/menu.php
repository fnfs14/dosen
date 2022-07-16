<?php

return [
    (object)[
        "name" => "Dashboard",
        "route" => "dashboard",
        "prefix" => "dashboard",
        "role" => "Admin"
    ],
    (object)[
        "name" => "Promosi",
        "route" => "promote.list",
        "prefix" => "promote.list",
        "role" => "Admin"
    ],
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
