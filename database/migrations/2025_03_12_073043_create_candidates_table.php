<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id('candidate_id');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone');
            $table->string('resume_link')->nullable();
            $table->text('skills')->nullable();
            $table->integer('experience')->default(0);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('candidates');
    }
};
