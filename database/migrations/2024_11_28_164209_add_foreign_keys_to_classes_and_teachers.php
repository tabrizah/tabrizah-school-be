<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToClassesAndTeachers extends Migration
{
    public function up()
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
        });

        Schema::table('teachers', function (Blueprint $table) {
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->dropForeign(['teacher_id']);
        });

        Schema::table('teachers', function (Blueprint $table) {
            $table->dropForeign(['class_id']);
        });
    }
}