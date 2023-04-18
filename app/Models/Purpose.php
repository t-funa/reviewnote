<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Unit;
use App\Models\Review;

class Purpose extends Model
{
    protected $table ='purposes';
    protected $fillable =['content'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function semester(){
        return $this->belongsTo(Semester::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    use SoftDeletes;

}
