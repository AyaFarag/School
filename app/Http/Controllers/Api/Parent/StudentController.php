<?php

namespace App\Http\Controllers\Api\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\StudentSnippetResource;

class StudentController extends Controller
{
    public function index() {
    	return StudentSnippetResource::collection(auth("parent-api") -> user() -> children);
    }
}
