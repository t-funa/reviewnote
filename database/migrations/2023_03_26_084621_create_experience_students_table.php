<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience_students', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->string('first_name');
            $table->string('last_name');
            $table->bigInteger('experience_id')->nullable()->unsigned();
            $table->foreign('experience_id')->references('id')->on('experiences');
            $table->bigInteger('semester_id')->nullable()->unsigned();
            $table->foreign('semester_id')->references('id')->on('semesters');
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experience_students');
    }
};
