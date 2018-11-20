<?php

return [
  "colors" => [
    "primary" => "#6a1b9a",
    "secondary" => "#00c853",
    "primary-name" => "purple darken-3",
    "secondary-name" => "green accent-4"
  ],
  "logo" => [
    "text"  => "R9 Admin Panel",
    "image" => "https://upload.wikimedia.org/wikipedia/commons/thumb/6/67/Firefox_Logo%2C_2017.svg/1200px-Firefox_Logo%2C_2017.svg.png"
  ],
  "links" => [
    "logout"  => "admin.logout",
    "profile" => "admin.profile"
  ],
  "items" => [
    [
      "label" => "Dashboard",
      "icon"  => "dashboard",
      "route" => "admin.dashboard"
    ],
    [
      "label" => "Moderators",
      "icon"  => "security",
      "route" => "admin.moderator.index",
      "can"   => "view",
      "model" => \App\Models\Admin::class
    ],
    [
      "label" => "Years",
      "icon"  => "calendar_today",
      "route" => "admin.year.index",
      "can"   => "view",
      "model" => \App\Models\Year::class
    ],
    [
      "label" => "Subjects",
      "icon"  => "subject",
      "route" => "admin.subject.index",
      "can"   => "view",
      "model" => \App\Models\Subject::class
    ],
    [
      "label" => "Classes",
      "icon"  => "class",
      "route" => "admin.class.index",
      "can"   => "view",
      "model" => \App\Models\ClassModel::class
    ],
    [
      "label" => "Teachers",
      "icon"  => "face",
      "route" => "admin.teacher.index",
      "can"   => "view",
      "model" => \App\Models\Teacher::class
    ],
    [
      "label" => "Students",
      "icon"  => "school",
      "route" => "admin.student.index",
      "can"   => "view",
      "model" => \App\Models\Teacher::class
    ],
    [
      "label" => "Semester Sessions",
      "icon"  => "donut_small",
      "route" => "admin.semester-session.index",
      "can"   => "view",
      "model" => \App\Models\SemesterSession::class
    ],
    [
      "label" => "Videos",
      "icon"  => "ondemand_video",
      "route" => "admin.video.index",
      "can"   => "view",
      "model" => \App\Models\Video::class
    ],
    [
      "label" => "Gallery",
      "icon"  => "photo",
      "route" => "admin.gallery.index",
      "can"   => "view",
      "model" => \App\Models\Gallery::class
    ],
    [
      "label" => "Branches",
      "icon"  => "call_split",
      "route" => "admin.branch.index",
      "can"   => "view",
      "model" => \App\Models\Branch::class
    ],
    [
      "label" => "Levels",
      "icon"  => "clear_all",
      "route" => "admin.level.index",
      "can"   => "update",
      "model" => \App\Models\Level::class
    ],
    [
      "label" => "Settings",
      "icon"  => "settings",
      "route" => "admin.setting.edit",
      "can"   => "update",
      "model" => \App\Models\Setting::class
    ]
  ]
];