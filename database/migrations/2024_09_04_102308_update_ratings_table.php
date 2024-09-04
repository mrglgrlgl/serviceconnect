<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRatingsTable extends Migration
{
    public function up()
    {
        Schema::table('ratings', function (Blueprint $table) {
            // Remove the existing 'role' column if it exists
            if (Schema::hasColumn('ratings', 'role')) {
                $table->dropColumn('role');
            }

            // Add new columns if they don't exist
            if (!Schema::hasColumn('ratings', 'agency_id')) {
                $table->unsignedBigInteger('agency_id');
            }

            if (!Schema::hasColumn('ratings', 'employee_id')) {
                $table->unsignedBigInteger('employee_id');
            }

            if (!Schema::hasColumn('ratings', 'seeker_id')) {
                $table->unsignedBigInteger('seeker_id');
            }

            // Rename columns only if they exist
            if (Schema::hasColumn('ratings', 'rated_by_id') && !Schema::hasColumn('ratings', 'seeker_id')) {
                $table->renameColumn('rated_by_id', 'seeker_id');
            }

            if (Schema::hasColumn('ratings', 'rated_for_id') && !Schema::hasColumn('ratings', 'employee_id')) {
                $table->renameColumn('rated_for_id', 'employee_id');
            }

            // Ensure foreign keys are set up
            $table->foreign('agency_id')->references('id')->on('agencies')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('seeker_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('ratings', function (Blueprint $table) {
            // Reverse changes
            $table->dropForeign(['agency_id']);
            $table->dropForeign(['employee_id']);
            $table->dropForeign(['seeker_id']);

            $table->dropColumn(['agency_id', 'employee_id', 'seeker_id']);
            if (Schema::hasColumn('ratings', 'seeker_id')) {
                $table->renameColumn('seeker_id', 'rated_by_id');
            }
            if (Schema::hasColumn('ratings', 'employee_id')) {
                $table->renameColumn('employee_id', 'rated_for_id');
            }
        });
    }
}
