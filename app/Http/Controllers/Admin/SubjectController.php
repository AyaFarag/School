<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Level;
use App\Models\Subject;

use App\Http\Requests\Admin\SubjectRequest;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this -> authorize("view", Subject::class);

        $subjects = Subject::query();

        if ($request -> filled("query"))
            $subjects -> search($request -> input("query"));

        $subjects = $subjects -> paginate();

        return view("admin.subject.index", compact("subjects"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this -> authorize("create", Subject::class);

        return view("admin.subject.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
        $this -> authorize("create", Subject::class);

        Subject::create($request -> all());

        return redirect()
            -> route("admin.subject.index")
            -> with("success", "Subject was added successfully!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        $this -> authorize("update", Subject::class);

        return view("admin.subject.edit", compact("subject"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectRequest $request, Subject $subject)
    {
        $this -> authorize("update", Subject::class);

        $subject -> update($request -> all());

        return redirect()
            -> route("admin.subject.edit", $subject -> id)
            -> with("success", "Subject was updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $this -> authorize("delete", Subject::class);

        $subject -> delete();

        return redirect()
            -> route("admin.subject.index")
            -> with("success", "Subject was deleted successfully!");
    }
}
