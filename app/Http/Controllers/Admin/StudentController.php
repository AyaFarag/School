<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\ParentModel;
use App\Models\ClassModel;
use App\Models\Branch;
use App\Models\Level;
use App\Models\Year;

use App\Http\Requests\Admin\StudentRequest;

use Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this -> authorize("view", Teacher::class);

		$levels   = Level::pluck("name", "id") -> all();
		$branches = Branch::selectOptions();
		$parents  = ParentModel::selectOptions();

		$students = Student::with("classes.level", "studentOfDayCount")
			-> filter($request -> all())
			-> paginate();

        return view("admin.student.index", compact("students", "levels", "branches", "parents"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$this -> authorize("create", Student::class);

        $branches = Branch::selectOptions();
        $parents  = ParentModel::selectOptions();
        $classes  = ClassModel::selectOptions();
        $years    = Year::selectOptions();

        return view("admin.student.create", compact("branches", "parents", "classes", "years"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $this -> authorize("create", Student::class);

        $student = new Student($request -> all());
        $student -> password = Hash::make("qwe123");
        $student -> save();
        $student -> classes() -> attach(
            $request -> input("class_id"),
            ["year_id" => $request -> input("year_id"), "seat_number" => $request -> input("seat_number")]
        );

        return redirect()
            -> route("admin.student.index")
            -> with("success", "Student was added successfully!");
    }


    public function show(Student $student) {
        return view("admin.student.show", compact("student"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $this -> authorize("update", Student::class);

        $branches = Branch::selectOptions();
        $parents  = ParentModel::selectOptions();
        $classes  = ClassModel::selectOptions();
        $years    = Year::selectOptions();

        return view("admin.student.edit", compact("student", "branches", "classes", "parents", "years"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, Student $student)
    {
        $this -> authorize("update", Student::class);

        $student -> update($request -> all());
        $pivot = $student -> classes() -> latest() -> first() -> pivot;
        $pivot -> update($request -> only("class_id", "year_id", "seat_number"));

        return redirect()
            -> route("admin.student.edit", $student -> id)
            -> with("success", "Student was updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $this -> authorize("delete", Student::class);

        $student -> delete();

        return redirect()
            -> route("admin.student.index")
            -> with("success", "Student was added successfully!");
    }
}
