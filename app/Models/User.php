<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Unit;
use App\Models\Purpose;
use App\Models\Review;
use App\Models\Student;
use App\Models\Experience;
use App\Models\Experience_student;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function semesters(){
        return $this->hasMany(Semester::class);
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

}
