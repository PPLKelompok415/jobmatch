<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('applications', function (Blueprint $table) {
            $table->id('application_id');
            $table->string('status')->default('pending'); // pending, accepted, rejected
            $table->timestamp('applied_at')->useCurrent();
            $table->foreignId('job_id')->references('job_id')->on('jobs');
            $table->foreignId('candidate_id')->references('candidate_id')->on('candidates');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('applications');
    }
};
