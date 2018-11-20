<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Teacher;
use App\Models\Branch;

use App\Http\Requests\Admin\TeacherRequest;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this -> authorize("view", Teacher::class);

		$teachers = Teacher::with("branch");
		$branches = Branch::pluck("name", "id") -> all();

        if ($request -> filled("query"))
            $teachers -> search($request -> input("query"));
        if ($request -> filled("branch"))
            $teachers -> where("branch_id", $request -> input("branch"));

        $teachers = $teachers -> paginate();

        return view("admin.teacher.index", compact("teachers", "branches"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$this -> authorize("create", Teacher::class);

        $branches = Branch::pluck("name", "id") -> all();

        return view("admin.teacher.create", compact("branches"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherRequest $request)
    {
        $this -> authorize("create", Teacher::class);

        Teacher::create($request -> all());

        return redirect()
            -> route("admin.teacher.index")
            -> with("success", "Teacher was added successfully!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        $this -> authorize("update", Teacher::class);

        $branches = Branch::pluck("name", "id") -> all();

        return view("admin.teacher.edit", compact("branches", "teacher"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherRequest $request, Teacher $teacher)
    {
        $this -> authorize("update", Teacher::class);

        $teacher -> update($request -> all());

        return redirect()
            -> route("admin.teacher.edit", $teacher -> id)
            -> with("success", "Teacher was updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $this -> authorize("delete", Teacher::class);

        $teacher -> delete();

        return redirect()
            -> route("admin.teacher.index")
            -> with("success", "Teacher was added successfully!");
    }
}
