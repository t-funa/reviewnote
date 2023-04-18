<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\Models\User;
use App\Models\Semester;
use App\Models\Unit;
use App\Models\Purpose;
use App\Models\Review;
use App\Models\Student;

class Subject extends Model
{
    protected $table ='subjects';
    protected $fillable =['name'];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function semester(){
        return $this->belongsTo(Semester::class);
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

    use SoftDeletes;

}