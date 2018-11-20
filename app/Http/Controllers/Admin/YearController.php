<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Year;

use App\Http\Requests\Admin\YearRequest;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this -> authorize("view", Year::class);

        $years = Year::latest() -> paginate();

        return view("admin.year.index", compact("years"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$this -> authorize("create", Year::class);

        return view("admin.year.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(YearRequest $request)
    {
        $this -> authorize("create", Year::class);

        Year::create($request -> all());

        return redirect()
            -> route("admin.year.index")
            -> with("success", "Year was added successfully!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Year $year)
    {
        $this -> authorize("update", Year::class);

        return view("admin.year.edit", compact("year"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(YearRequest $request, Year $year)
    {
        $this -> authorize("update", Year::class);

        $year -> update($request -> all());

        return redirect()
            -> route("admin.year.edit", $year -> id)
            -> with("success", "Year was updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Year $year)
    {
        $this -> authorize("delete", Year::class);

        $year -> delete();

        return redirect()
            -> route("admin.year.index")
            -> with("success", "Year was added successfully!");
    }
}
