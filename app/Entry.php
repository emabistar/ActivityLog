<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;

class Entry extends Model
{
    protected $fillable = ['project_id','start','end'];
    /***
     * Get related project
     */
     public function project(){
         return $this->belongs(Project::class);
     }
     /**
      *  Get the running  entries
      */
    public function scopeRunning($query){
        return $query->whereNull('end');
    }

   
}
