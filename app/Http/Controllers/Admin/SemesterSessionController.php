<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\SemesterSession;
use App\Models\Level;
use App\Models\Subject;
use App\Models\ClassModel;
use App\Models\Teacher;
use App\Models\Year;

use App\Http\Requests\Admin\SemesterSessionRequest;

class SemesterSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this -> authorize("view", SemesterSession::class);

		$semesterSessions = SemesterSession::with("class.level", "teacher", "subject");
		$subjects         = Subject::pluck("name", "id") -> all();
		$teachers         = Teacher::selectOptions();
        $classes          = ClassModel::selectOptions();
        $years            = Year::selectOptions();

		$semesterSessions -> filter($request -> all());

        $semesterSessions = $semesterSessions -> orderBy("class_id") -> paginate();

        return view("admin.semester-session.index", compact("semesterSessions", "subjects", "classes", "teachers", "years"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this -> authorize("create", SemesterSession::class);

        $subjects = Subject::pluck("name", "id") -> all();
        $teachers = Teacher::selectOptions();
        $classes  = ClassModel::selectOptions();
        $years    = Year::selectOptions();

        return view("admin.semester-session.create", compact("subjects", "classes", "teachers", "years"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SemesterSessionRequest $request)
    {
        $this -> authorize("create", SemesterSession::class);

        SemesterSession::create($request -> all());

        return redirect()
            -> route("admin.semester-session.index")
            -> with("success", "Semester Session was added successfully!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SemesterSession $semester_session)
    {
        $this -> authorize("update", SemesterSession::class);

        $subjects = Subject::pluck("name", "id") -> all();
        $teachers = Teacher::selectOptions();
        $classes  = ClassModel::selectOptions();
        $years    = Year::selectOptions();

        return view("admin.semester-session.edit", compact("subjects", "classes", "teachers", "semester_session", "years"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SemesterSessionRequest $request, SemesterSession $semester_session)
    {
        $this -> authorize("update", SemesterSession::class);

        $semester_session -> update($request -> all());

        return redirect()
            -> route("admin.semester-session.edit", $semester_session -> id)
            -> with("success", "Semester Session was updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SemesterSession $semester_session)
    {
        $this -> authorize("delete", SemesterSession::class);

        $semester_session -> delete();

		return redirect()
            -> route("admin.semester-session.index")
            -> with("success", "Semester Session was deleted successfully!");
    }
}
