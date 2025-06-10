<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFullNameToApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applicants', function (Blueprint $table) {
            // Menambahkan kolom 'full_name' setelah kolom 'name'
            // Defaultnya kita buat nullable agar tidak langsung error jika belum diisi
            // Anda bisa menghapus ->nullable() jika ingin mewajibkannya
            $table->string('full_name')->nullable()->after('name');
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
            // Menghapus kolom 'full_name' saat rollback
            $table->dropColumn('full_name');
        });
    }
}