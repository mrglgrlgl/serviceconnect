<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgencyServicesTable extends Migration
{
    public function up()
    {
        Schema::create('agency_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agency_id')->constrained()->onDelete('cascade'); // Links to agencies table
            $table->string('service_name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('created_by')->nullable(); // Make sure this matches the data type of agency_users.id
            $table->foreign('created_by')->references('id')->on('agency_users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agency_services');
    }
}
