<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakePasswordNullableInApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applicants', function (Blueprint $table) {
            // Membuat kolom 'password' menjadi nullable
            // Pastikan tipe data sesuai (misalnya, string untuk password)
            $table->string('password')->nullable()->change();
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
            // Mengembalikan kolom 'password' menjadi NOT NULL
            // Perlu diperhatikan: Jika ada baris dengan nilai NULL di kolom ini
            // saat Anda melakukan rollback, akan terjadi error.
            // Anda mungkin perlu mengisi nilai default atau menghapus baris tersebut terlebih dahulu.
            $table->string('password')->nullable(false)->change();
        });
    }
}