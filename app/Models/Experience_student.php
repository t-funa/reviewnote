<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\Models\User;
use App\Models\Semester;
use App\Models\Experience;

class Experience_student extends Model
{
    protected $table ='experience_students';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function semester(){
        return $this->belongsTo(Semester::class);
    }

    public function experience(){
        return $this->hasMany(Experience::class);
    }

    use SoftDeletes;

}