<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    protected $webNamespace        = "App\Http\Controllers";
    protected $apiNamespace        = "App\Http\Controllers\Api";
    protected $studentApiNamespace = "App\Http\Controllers\Api\Student";
    protected $teacherApiNamespace = "App\Http\Controllers\Api\Teacher";
    protected $parentApiNamespace  = "App\Http\Controllers\Api\Parent";
    protected $adminNamespace      = "App\Http\Controllers\Admin";

    public function boot()
    {
        parent::boot();

        Route::bind("child", function ($student_id) {
            $parent = auth("parent-api") -> user();
            return $parent -> children() -> whereId($student_id) -> firstOrFail();
        });
    }

    public function map()
    {
        $this -> mapApiRoutes();

        $this -> mapStudentApiRoutes();

        $this -> mapParentApiRoutes();

        $this -> mapTeacherApiRoutes();

        $this -> mapWebRoutes();

        $this -> mapAdminRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::middleware("web")
            -> namespace($this -> webNamespace)
            -> group(base_path("routes/web.php"));
    }

    protected function mapApiRoutes()
    {
        Route::prefix("api")
            -> middleware("api")
            -> namespace($this -> apiNamespace)
            -> group(base_path("routes/api.php"));
    }

    protected function mapStudentApiRoutes()
    {
        Route::prefix("api/student")
            -> middleware("api")
            -> namespace($this -> studentApiNamespace)
            -> group(base_path("routes/student-api.php"));
    }
    protected function mapParentApiRoutes()
    {
        Route::prefix("api/parent")
            -> middleware("api")
            -> namespace($this -> parentApiNamespace)
            -> group(base_path("routes/parent-api.php"));
    }
    protected function mapTeacherApiRoutes()
    {
        Route::prefix("api/teacher")
            -> middleware("api")
            -> namespace($this -> teacherApiNamespace)
            -> group(base_path("routes/teacher-api.php"));
    }

    protected function mapAdminRoutes() {
        Route::prefix("admin")
            -> middleware("web")
            -> namespace($this -> adminNamespace)
            -> group(base_path("routes/admin.php"));
    }
}
