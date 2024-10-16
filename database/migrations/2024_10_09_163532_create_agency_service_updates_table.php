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
    Schema::create('agency_service_updates', function (Blueprint $table) {
        $table->id();
        $table->foreignId('agency_id')->constrained();
        $table->foreignId('service_id')->nullable();  // For updates or deletes
        $table->string('service_name');
        $table->text('description')->nullable();
        $table->string('action');  // 'create', 'update', 'delete'
        $table->foreignId('submitted_by')->constrained('agency_users');
        $table->foreignId('reviewed_by')->nullable()->constrained('admin_users');
        $table->string('status')->default('pending');  // 'pending', 'approved', 'rejected'
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agency_service_updates');
    }
};
