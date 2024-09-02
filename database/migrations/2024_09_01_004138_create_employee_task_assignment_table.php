<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTaskAssignmentTable extends Migration
{
    public function up()
    {
        Schema::create('employee_task_assignment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agency_id')->constrained()->onDelete('cascade');
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            // Use unsignedBigInteger to match the channel table's id type
            $table->unsignedBigInteger('channel_id'); 
            $table->enum('status', ['assigned', 'completed', 'replaced']);
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->unsignedBigInteger('assigned_by'); // Agency user ID who assigned
            $table->timestamps();

            // Correct foreign key reference
            $table->foreign('channel_id')->references('id')->on('channel')->onDelete('cascade');
            $table->foreign('assigned_by')->references('id')->on('agency_users')->onDelete('cascade');
            
            // Optional: Ensure that an employee cannot be assigned to the same channel more than once
            $table->unique(['employee_id', 'channel_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_task_assignment');
    }
}
