<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\SemesterSession;
use App\Models\Schedule;

use App\Http\Requests\Admin\ScheduleRequest;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, SemesterSession $semester_session)
    {
        $this -> authorize("view", Schedule::class);

		$schedules = $semester_session -> schedules;

        return view("admin.schedule.index", compact("semester_session", "schedules"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($semester_session)
    {
        $this -> authorize("create", Schedule::class);

        return view("admin.schedule.create", compact("semester_session"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleRequest $request, $semester_session)
    {
        $this -> authorize("create", Schedule::class);

        $schedule = new Schedule($request -> all());
        $schedule -> semester_session_id = $semester_session;
        $schedule -> save();

        return redirect()
            -> route("admin.semester-session.schedule.index", $semester_session)
            -> with("success", "Schedule was added successfully!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($semester_session, Schedule $schedule)
    {
        $this -> authorize("update", Schedule::class);
        return view("admin.schedule.edit", compact("schedule", "semester_session"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleRequest $request, $semester_session, Schedule $schedule)
    {
        $this -> authorize("update", Schedule::class);

        $schedule -> update($request -> all());

        return redirect()
            -> route("admin.semester-session.schedule.edit", [$semester_session, $schedule -> id])
            -> with("success", "Schedule was updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $this -> authorize("delete", Schedule::class);

        $schedule -> delete();

		return redirect()
            -> route("admin.semester-session.schedule.index")
            -> with("success", "Schedule was deleted successfully!");
    }
}
