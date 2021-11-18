<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name','user_id','entry_id'];

    public function entries(){
        return $this->hasMany(Entry::class);
    }

}
