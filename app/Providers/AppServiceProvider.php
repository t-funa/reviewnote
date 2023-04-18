<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Unit;
use App\Models\Purpose;
use App\Models\Review;
use App\Models\Student;
use App\Models\Experience;
use App\Models\Experience_student;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {

            $user = \Auth::user();

            $semesterModel = new Semester();
            $semesters = $semesterModel->where('user_id', \Auth::id())->get();

            $view->with('user', $user)->with('semesters',$semesters);
        });
    }
}
