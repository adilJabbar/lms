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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('video_url');
            $table->string('description');
            $table->string('notes');
            $table->integer('course_id');
            // $table->unsignedBigInteger('course_id')->index();
            // $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->timestamps();
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('chapters');
    }
};
