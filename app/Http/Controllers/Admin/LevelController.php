<?php

namespace App\Http\Controllers\Admin;

use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LevelRequest;

class LevelController extends Controller
{
    
    public function index(){

        $level = Level::paginate();
        return view('admin.level.index',compact('level'));

    }


    public function create(){

        return view('admin.level.create',compact('level'));

    }
    
    
    public function store(LevelRequest $request){
        
        Level::create($request->all());
        return redirect()->route('admin.level.index')->with('success','Added');

    }
    
    
    public function edit(Level $level){

        return view('admin.level.edit',compact('level'));

    }
    
    
    public function update(LevelRequest $request, Level $level){
        
        $level->update($request->all());
        return redirect()->route('admin.level.index')->with('success','Updated');

    }
    
    
    public function destroy(Level $level){
        
        $level->delete();
        return back()->with('success','Deleted');

    }
}
