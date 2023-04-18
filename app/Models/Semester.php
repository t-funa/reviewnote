<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\Models\User;
use App\Models\Subject;
use App\Models\Unit;
use App\Models\Purpose;
use App\Models\Review;
use App\Models\Student;
use App\Models\Experience;
use App\Models\Experience_student;

class Semester extends Model
{
    protected $table ='semesters';
    protected $fillable =['name'];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function subjects(){
        return $this->hasMany(Subject::class);
    }

    public function units(){
        return $this->hasMany(Unit::class);
    }

    public function purposes(){
        return $this->hasMany(Purpose::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function students(){
        return $this->hasMany(Student::class);
    }

    public function experiences(){
        return $this->hasMany(Experience::class);
    }

    public function experience_students(){
        return $this->hasMany(Experience_student::class);
    }

    use SoftDeletes;

}