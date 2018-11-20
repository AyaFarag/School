<?php

namespace App\Supports;
use Illuminate\Http\Request;
use App\Models\Pages;
use App\Supports\ApiDocumentationTrait;

use App\Models\ClassModel;
use App\Models\Quiz;
use App\Models\QuizResponse;
use App\Models\Student;
use App\Models\ParentModel;

use App\Http\Resources\ScheduleResource;
use App\Http\Resources\QuizResource;
use App\Http\Resources\QuizResponseResource;
use App\Http\Resources\StudentResource;

use App\Http\Requests\Api\Teacher\Session\SessionStartRequest;
use App\Http\Requests\Api\Teacher\Session\SessionRequest;
use App\Http\Requests\Api\Teacher\QuizRequest;
use App\Http\Requests\Api\Teacher\QuizResponseAwardRequest;

class ApiDocumentation {
  use ApiDocumentationTrait;

  const DEFAULT_HEADERS = [
    "Content-Type" => "application/json",
    "Accept"       => "application/json"
  ];
  const AUTHENTICATED_HEADERS = ["Authorization" => "Bearer {token}"];

  const CATEGORIES = [
    "students",
    "parents",
    "teachers"
  ];

  public function all($categories = null) {
    $endpoints = [];
    if ($categories) {
      foreach ($categories as $category) {
        $endpoints = array_merge($endpoints, $this -> {$category}());
      }
      return $endpoints;
    }

    foreach (self::CATEGORIES as $category) {
      $endpoints = array_merge($endpoints, $this -> {$category}());
    }
    return $endpoints;
  }

  public function get($route, $method) {
    foreach (self::CATEGORIES as $category) {
      foreach ($this -> {$category}() as $endpoint) {
        if ($endpoint["url"] === $route && $endpoint["method"] === $method) {
          return $endpoint;
        }
      }
    }
    return [];
  }

  public function students() {
    return [
      [
        "name"        => "Get daily schedule",
        "headers"     => array_merge(self::AUTHENTICATED_HEADERS, self::DEFAULT_HEADERS),
        "url"         => "/api/student/schedule",
        "method"      => "get",
        "description" => "Get the daily schedule for the logged in student",
        "parameters"  => function () { return []; },
        "responses"   => function () {
          return [
            [
              "code" => 200,
              "data" => [
                "data" => (new ScheduleResource(ClassModel::first() -> semesterSessions)) -> toArray(request())
              ]
            ]
          ];
        }
      ]
    ];
  }

  public function parents() {
    return [
      [
        "name"        => "List all students (children)",
        "headers"     => array_merge(self::AUTHENTICATED_HEADERS, self::DEFAULT_HEADERS),
        "url"         => "/api/parent/children",
        "method"      => "get",
        "description" => "List all the children (students) for the logged in parent.",
        "parameters"  => function () { return []; },
        "responses"   => function () {
          return [
            [
              "code" => 200,
              "data" => [
                "data" => StudentResource::collection(ParentModel::first() -> children) -> toArray(request())
              ]
            ],
            [
              "code" => 400,
              "data" => []
            ]
          ];
        }
      ],
      [
        "name"        => "Get the weekly schedule of a student",
        "headers"     => array_merge(self::AUTHENTICATED_HEADERS, self::DEFAULT_HEADERS),
        "url"         => "/api/parent/{studentId}/schedule",
        "method"      => "get",
        "description" => "Get the weekly schedule for a student",
        "parameters"  => function () {
          return $this -> getParameters("studentId");
        },
        "responses"   => function () {
          return [
            [
              "code" => 200,
              "data" => [
                "data" => (new ScheduleResource(ClassModel::first() -> semesterSessions)) -> toArray(request())
              ]
            ],
            [
              "code" => 400,
              "data" => []
            ]
          ];
        }
      ]
    ];
  }

  public function teachers() {
    return [
      [
        "name"        => "Get the daily schedule",
        "headers"     => array_merge(self::AUTHENTICATED_HEADERS, self::DEFAULT_HEADERS),
        "url"         => "/api/teacher/schedule",
        "method"      => "get",
        "description" => "Get the daily schedule for the logged in teacher",
        "parameters"  => function () { return []; },
        "responses"   => function () {
          return [
            [
              "code" => 200,
              "data" => [
                "data" => (new ScheduleResource(ClassModel::first() -> semesterSessions)) -> toArray(request())
              ]
            ]
          ];
        }
      ],
      [
        "name"        => "Start teaching session",
        "headers"     => array_merge(self::AUTHENTICATED_HEADERS, self::DEFAULT_HEADERS),
        "url"         => "/api/teacher/session",
        "method"      => "post",
        "description" => "Start the teaching session",
        "parameters"  => function () {
          return $this -> postParameters(new SessionStartRequest());
        },
        "responses"   => function () {
          return [
            [
              "code" => 200,
              "data" => [
                "message" => trans("api.session_started"),
                "data" => [
                  "id" => 3
                ]
              ]
            ]
          ];
        }
      ],
      [
        "name"        => "Update teaching session",
        "headers"     => array_merge(self::AUTHENTICATED_HEADERS, self::DEFAULT_HEADERS),
        "url"         => "/api/teacher/session/{session}",
        "method"      => "put",
        "description" => "Update the teaching session | Set absence/student of day",
        "parameters"  => function () {
          return array_merge(
            $this -> postParameters(new SessionRequest()),
            $this -> getParameters("session")
          );
        },
        "responses"   => function () {
          return [
            [
              "code" => 200,
              "data" => [
                "message" => trans("api.updated_successfully")
              ]
            ]
          ];
        }
      ],
      [
        "name"        => "Create a quiz",
        "headers"     => array_merge(self::AUTHENTICATED_HEADERS, self::DEFAULT_HEADERS),
        "url"         => "/api/teacher/quiz",
        "method"      => "post",
        "description" => "Create a new quiz",
        "parameters"  => function () {
          return $this -> postParameters(new QuizRequest());
        },
        "responses"   => function () {
          return [
            [
              "code" => 200,
              "data" => [
                "data" => (new QuizResource(Quiz::first())) -> toArray(request())
              ]
            ]
          ];
        }
      ],
      [
        "name"        => "Get a quiz",
        "headers"     => array_merge(self::AUTHENTICATED_HEADERS, self::DEFAULT_HEADERS),
        "url"         => "/api/teacher/quiz/{quiz}",
        "method"      => "get",
        "description" => "Get a specific quiz by id",
        "parameters"  => function () {
          return $this -> getParameters("quiz");
        },
        "responses"   => function () {
          return [
            [
              "code" => 200,
              "data" => [
                "data" => (new QuizResource(Quiz::first())) -> toArray(request())
              ]
            ]
          ];
        }
      ],
      [
        "name"        => "Update a quiz",
        "headers"     => array_merge(self::AUTHENTICATED_HEADERS, self::DEFAULT_HEADERS),
        "url"         => "/api/teacher/quiz/{quiz}",
        "method"      => "put",
        "description" => "Update a specific quiz by id",
        "parameters"  => function () {
          return array_merge(
            $this -> postParameters(new QuizRequest()),
            $this -> getParameters("quiz")
          );
        },
        "responses"   => function () {
          return [
            [
              "code" => 200,
              "data" => [
                "data" => (new QuizResource(Quiz::first())) -> toArray(request())
              ]
            ]
          ];
        }
      ],
      [
        "name"        => "Delete a quiz",
        "headers"     => array_merge(self::AUTHENTICATED_HEADERS, self::DEFAULT_HEADERS),
        "url"         => "/api/teacher/quiz/{quiz}",
        "method"      => "delete",
        "description" => "Delete a specific quiz by id",
        "parameters"  => function () {
          return $this -> getParameters("quiz");
        },
        "responses"   => function () {
          return [
            [
              "code" => 200,
              "data" => [
                "message" => trans("api.deleted_successfully")
              ]
            ]
          ];
        }
      ],
      [
        "name"        => "Get quiz responses",
        "headers"     => array_merge(self::AUTHENTICATED_HEADERS, self::DEFAULT_HEADERS),
        "url"         => "/api/teacher/quiz/{quiz}/response",
        "method"      => "get",
        "description" => "Get all the responses for a specific quiz",
        "parameters"  => function () {
          return $this -> getParameters("quiz");
        },
        "responses"   => function () {
          return [
            [
              "code" => 200,
              "data" => [
                "data" => QuizResponseResource::collection(QuizResponse::paginate()) -> toArray(request())
              ]
            ]
          ];
        }
      ],
      [
        "name"        => "Give points to a quiz responsee",
        "headers"     => array_merge(self::AUTHENTICATED_HEADERS, self::DEFAULT_HEADERS),
        "url"         => "/api/teacher/quiz/{quiz}/response/{quiz_response}",
        "method"      => "post",
        "description" => "Give points to a specific quiz response",
        "parameters"  => function () {
          return array_merge(
            $this -> getParameters("quiz", "quiz_response"),
            [
              [
                "name"       => "points",
                "type"       => "post",
                "validation" => "required|numeric|min:1|max:quiz's grade"
              ]
            ]
          );
        },
        "responses"   => function () {
          return [
            [
              "code" => 200,
              "data" => [
                "message" => trans("api.awarded_successfully")
              ]
            ]
          ];
        }
      ],
      [
        "name"        => "Delete a quiz response",
        "headers"     => array_merge(self::AUTHENTICATED_HEADERS, self::DEFAULT_HEADERS),
        "url"         => "/api/teacher/quiz/{quiz}/response/{quiz_response}",
        "method"      => "delete",
        "description" => "Delete a quiz response",
        "parameters"  => function () {
          return array_merge(
            $this -> getParameters("quiz", "quiz_response"),
            [
              [
                "name"       => "points",
                "type"       => "post",
                "validation" => "required|numeric|min:1|max:quiz's grade"
              ]
            ]
          );
        },
        "responses"   => function () {
          return [
            [
              "code" => 200,
              "data" => [
                "message" => trans("api.awarded_successfully")
              ]
            ]
          ];
        }
      ]
    ];
  }
}