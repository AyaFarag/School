<?php




//===============================================================
//
// AUTHENTICATION
//
//===============================================================

Route::redirect("/", "/admin/login", 301);
Route::get("/login", "LoginController@showLoginForm") -> name("admin.login");
Route::post("/login", "LoginController@login");




Route::group([
    "middleware" => "auth:admin",
    "as"         => "admin."
], function () {

    //===============================================================
    //
    // DASHBOARD
    //
    //===============================================================

    Route::get("/dashboard", "DashboardController@index") -> name("dashboard");





    //===============================================================
    //
    // MODERATORS
    //
    //===============================================================

    Route::resource("/moderator", "ModeratorController");





    //===============================================================
    //
    // SUBJECTS
    //
    //===============================================================

    Route::resource("/subject", "SubjectController");





    //===============================================================
    //
    // CLASS
    //
    //===============================================================

    Route::resource("/class", "ClassController");





    //===============================================================
    //
    // TEACHERS
    //
    //===============================================================

    Route::resource("/teacher", "TeacherController");





    //===============================================================
    //
    // TEACHERS
    //
    //===============================================================

    Route::resource("/parent", "ParentController");





    //===============================================================
    //
    // STUDENTS
    //
    //===============================================================

    Route::resource("/student", "StudentController");
    Route::get("/student/{student}/year/{year}", "Student\DataController@show")
        -> name("student.year.show");
    Route::get("/student/{student}/year/{year}/absence", "Student\AbsenceController@index")
        -> name("student.year.absence.index");
    Route::get("/student/{student}/year/{year}/point", "Student\PointController@index")
        -> name("student.year.point.index");
    Route::get("/student/{student}/year/{year}/student-of-day", "Student\StudentOfDayController@index")
        -> name("student.year.student-of-day.index");
    Route::get("/student/{student}/year/{year}/quiz-response", "Student\QuizResponseController@index")
        -> name("student.year.quiz-response.index");





    //===============================================================
    //
    // SEMESTER SESSIONS
    //
    //===============================================================

    Route::resource("/semester-session", "SemesterSessionController");
    Route::resource(
        "/semester-session/{semester_session}/schedule",
        "ScheduleController",
        ["as" => "semester-session"]
    );





    //===============================================================
    //
    // PROFILE
    //
    //===============================================================

    Route::get("/profile", "AdminController@showProfile") -> name("profile");
    Route::put("/profile", "AdminController@updateProfile");





    //===============================================================
    //
    // SETTING
    //
    //===============================================================

    Route::get("/setting", "SettingController@edit") -> name("setting.edit");
    Route::put("/setting", "SettingController@update");
    



    
    //===============================================================
    //
    // Videos
    //
    //===============================================================

    Route::resource("/video", "VideoController");
    
    



    //===============================================================
    //
    // Gallery
    //
    //===============================================================

    Route::resource("/gallery", "GalleryController");





    //===============================================================
    //
    // Level
    //
    //===============================================================

    Route::resource("/level", "LevelController");





    //===============================================================
    //
    // YEARS
    //
    //===============================================================

    Route::resource("/year", "YearController");





    //===============================================================
    //
    // Branches
    //
    //===============================================================

    Route::resource("/branch", "BranchController");
    
    


    
    //===============================================================
    //
    // LOGOUT
    //
    //===============================================================

    Route::get("/logout", "LoginController@logout") -> name("logout");

});