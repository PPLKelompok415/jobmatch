<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id('job_id');
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->decimal('salary', 10, 2);
            $table->string('job_type'); // Full-time, Part-time, etc.
            $table->string('status')->default('open'); // open, closed
            $table->timestamps();
            $table->foreignId('employer_id')->references('employer_id')->on('employers');
        });
    }

    public function down() {
        Schema::dropIfExists('jobs');
    }
};

