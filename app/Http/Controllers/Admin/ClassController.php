<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Level;
use App\Models\ClassModel;

use App\Http\Requests\Admin\ClassRequest;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this -> authorize("view", ClassModel::class);

        $classes = ClassModel::query();
        $levels  = Level::pluck("name", "id") -> all();

        if ($request -> filled("level"))
            $classes -> where("level_id", $request -> input("level"));

        $classes = $classes -> paginate();

        return view("admin.class.index", compact("classes", "levels"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this -> authorize("create", ClassModel::class);

        $levels = Level::pluck("name", "id") -> all();

        return view("admin.class.create", compact("levels"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassRequest $request)
    {
        $this -> authorize("create", ClassModel::class);

        ClassModel::create($request -> all());

        return redirect()
            -> route("admin.class.index")
            -> with("success", "Class was added successfully!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassModel $class)
    {
        $this -> authorize("update", ClassModel::class);

        $levels = Level::pluck("name", "id") -> all();

        return view("admin.class.edit", compact("levels", "class"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClassRequest $request, ClassModel $class)
    {
        $this -> authorize("update", ClassModel::class);

        $class -> update($request -> all());

        return redirect()
            -> route("admin.class.edit", $class -> id)
            -> with("success", "Class was updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassModel $class)
    {
        $this -> authorize("delete", ClassModel::class);

        $class -> delete();

        return redirect()
            -> route("admin.class.index")
            -> with("success", "Class was deleted successfully!");
    }
}
