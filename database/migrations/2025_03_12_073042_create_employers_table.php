<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('employers', function (Blueprint $table) {
            $table->id('employer_id');
            $table->string('company_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone');
            $table->text('address');
            $table->string('industry');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('employers');
    }
};