<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'additional_invoice';


   
    public function project(){
    	return $this->belongsToMany(Project::class);
    }
}
