<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\Models\User;
use App\Models\Semester;
use App\Models\Experience_student;

class Experience extends Model
{
    protected $table ='experiences';
    protected $fillable =['name'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function semester(){
        return $this->belongsTo(Semester::class);
    }

    public function experience_students(){
        return $this->hasMany(Experience_student::class);
    }

    use SoftDeletes;

}