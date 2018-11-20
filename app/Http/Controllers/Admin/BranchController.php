<?php

namespace App\Http\Controllers\Admin;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BranchRequest;

class BranchController extends Controller
{
    public function index(){
     
        $branch = Branch::paginate();
        return view('admin.branch.index',compact('branch'));
    }
    
    
    public function create(){

        return view('admin.branch.create',compact('branch'));

    }


    public function store(BranchRequest $request){

        Branch::create($request->all());
        return redirect()->route('admin.branch.index')->with('success','Done'); 
    }
    
    
    public function edit(Branch $branch){
        
        return view('admin.branch.edit', compact('branch'));
    }
    
    
    public function update(BranchRequest $request , Branch $branch){
        
        $branch->update($request->all());
        return redirect()->route('admin.branch.index')->with('success','Done');  
    }


    public function destroy(Branch $branch){

        $branch->delete();
        return back();
    }

}
