<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAttendancesTable extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->mediumInteger('card_uid');    
            $table->date('date')->default(DB::raw('CURRENT_DATE')); // Tanggal otomatis
            $table->timestamp('time')->useCurrent();    
            $table->enum('status', ['present', 'absent', 'late']);
            $table->foreign('card_uid')->references('card_uid')->on('cards')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}