<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobApplicationsTable extends Migration
{
    public function up()
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_id')->constrained()->onDelete('cascade');
            $table->timestamp('applied_at')->nullable();
            $table->timestamps();

            $table->unique(['applicant_id', 'job_id']); // Biar tidak apply dua kali
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_applications');
    }
}

