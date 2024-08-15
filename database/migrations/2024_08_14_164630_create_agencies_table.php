<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgenciesTable extends Migration
{
    public function up()
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Agency name
            $table->string('email')->unique(); // Contact email for the agency
            $table->string('phone')->nullable(); // Contact phone number
            $table->string('address')->nullable(); // Physical address
            $table->enum('status', ['active', 'inactive', 'pending'])->default('pending'); // Status of the agency
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agencies');
    }
}
