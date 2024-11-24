<?php

// database/migrations/{timestamp}_add_foreign_key_to_class_id_in_teachers_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToClassIdInTeachersTable extends Migration
{
    public function up()
    {
        Schema::table('teachers', function (Blueprint $table) {
            // Menambahkan foreign key ke kolom class_id yang sudah ada
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('set null'); // Atau 'cascade' jika sesuai
        });
    }

    public function down()
    {
        Schema::table('teachers', function (Blueprint $table) {
            // Menghapus foreign key dari class_id
            $table->dropForeign(['class_id']);
        });
    }
}