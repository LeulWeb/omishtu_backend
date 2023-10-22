<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Story::all();
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Story::find($id);
        
    }

   

 
}
