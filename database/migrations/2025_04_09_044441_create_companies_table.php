<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            // Company Data
            $table->string('logo')->nullable(); // Logo perusahaan
            $table->string('company_name'); // Nama perusahaan
            $table->text('company_address'); // Alamat perusahaan
            $table->string('website_address'); // Website perusahaan
            $table->string('company_email'); // Email perusahaan
            $table->string('company_phone_number'); // Nomor telepon perusahaan

            // Job Vacancy
            $table->string('position'); // Posisi pekerjaan
            $table->string('type_of_work'); // Jenis pekerjaan
            $table->string('location'); // Lokasi pekerjaan
            $table->integer('salary_min'); // Gaji minimum
            $table->integer('salary_max'); // Gaji maksimum
            $table->date('deadline'); // Deadline pekerjaan
            $table->text('job_description'); // Deskripsi pekerjaan

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
