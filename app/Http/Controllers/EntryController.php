<?php

namespace App\Http\Controllers;
use App\Entry;
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function start(Request $request)
    {
        $id = $request->id;
        $entry = Project::findOrFail($id)->entries()->save(
            new Entry([
                'start'=>$request->start,
                'end'=>$request->end,
                'project_id'=>$id
            ])
            );
        return response($entry);
     // TODO: Implement starting new entry  
    }
    public function stop(Request $request)
    {
         // TODO: Implement stopping entry
        $id = Entry::latest()->first()->id;
        $entryData = Entry::find($id);
        $entryData->end = $request->end;
        $entryData->save();
        return response()->json(['message','updated successfully']);

    }
    public function add(Request $request){
          //$entryData = $request->all();
          $entryData= Entry::create([
             'start'=>$request->start,
             'end'=>$request->end,
             'project_id'=> $request->id,
          ]);
         return response()->json(['message',  $entryData]);
    }
}
