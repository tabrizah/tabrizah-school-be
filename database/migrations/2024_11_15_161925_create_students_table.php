<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nisn');
            $table->string('name');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('user_id');
            
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade'); // Relasi ke tabel classes
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade'); // Relasi ke tabel teachers
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('student');
    }
}