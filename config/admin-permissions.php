<?php

return [
    "Super Admin" => [
        "admin" => "Super Admin"
    ],
    "Users" => [
        \App\Policies\Admin\UserPolicy::VIEW   => "View",
        \App\Policies\Admin\UserPolicy::CREATE => "Create",
        \App\Policies\Admin\UserPolicy::UPDATE => "Update",
        \App\Policies\Admin\UserPolicy::DELETE => "Delete"
    ],
    "Moderators" => [
        \App\Policies\Admin\ModeratorPolicy::VIEW   => "View",
        \App\Policies\Admin\ModeratorPolicy::CREATE => "Create",
        \App\Policies\Admin\ModeratorPolicy::UPDATE => "Update",
        \App\Policies\Admin\ModeratorPolicy::DELETE => "Delete"
    ],
    "Settings" => [
        \App\Policies\Admin\SettingPolicy::UPDATE => "Update"
    ]
];