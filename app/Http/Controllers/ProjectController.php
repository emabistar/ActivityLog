<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function __construct()
    {
     $this->middleware('auth');
    }
   
    public function show(int $projectID)
    {
       
        $project = Project::with('entries')->find($projectID);
        return view('projects.show', ['project' => $project]);
    }
    public function add(Request $request)
    {
        // return validated data as an array
        $validatedData = $request->validate([
            'name' => 'required|unique:projects,name'
        ]);
        Project::create(
            $validatedData
        );
        return response()->json(['message' => 'success !']); 
    }
    public function update(Request $request)
    {
        $project = Project::find($request->get('id'));
        $project->name = $request->get('name');
        $project->save();
        return response()->json(['status' => 'success']);
    }
    public function destroy($projectID){
       $projects =  Project::with('entries')->find($projectID)->delete();
       
       return response()->json(['status' => $projects]);
        // return['message'=>'User was deleted'];
       

    }
}
