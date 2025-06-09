<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeRoleNullableInApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applicants', function (Blueprint $table) {
            // Membuat kolom 'role' menjadi nullable
            // Sesuaikan tipe data string jika role disimpan sebagai teks
            $table->string('role')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applicants', function (Blueprint $table) {
            // Mengembalikan kolom 'role' menjadi NOT NULL
            // PERHATIAN: Jika ada baris dengan nilai NULL di kolom ini
            // saat Anda melakukan rollback, akan terjadi error.
            // Anda mungkin perlu mengisi nilai default atau menghapus baris tersebut terlebih dahulu
            // sebelum menjalankan php artisan migrate:rollback
            $table->string('role')->nullable(false)->change();
        });
    }
}