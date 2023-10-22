<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Count;
use Illuminate\Http\Request;

class CountController extends Controller
{
    
    public function index()
    {
        
        return [
            "customers"=>Count::sum('customers'),
            "projects"=>Count::sum('projects'),
            "students"=>Count::sum('students'),
            "courses"=>Count::sum('courses'),
            "staff"=>Count::sum('staff'),
        ];
    }

    
}
