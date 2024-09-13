<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateReportsTable extends Migration
{
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            // Drop the column only if it exists
            if (Schema::hasColumn('reports', 'reported_user_id')) {
                $table->dropForeign(['reported_user_id']);
                $table->dropIndex(['reported_user_id']);
                $table->dropColumn('reported_user_id');
            }

            // Add the new column if it does not already exist
            if (!Schema::hasColumn('reports', 'agency_id')) {
                $table->unsignedBigInteger('agency_id')->nullable()->after('reported_by');
            }
        });
    }

    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            // Drop the agency_id column if it exists
            if (Schema::hasColumn('reports', 'agency_id')) {
                $table->dropColumn('agency_id');
            }

            // Add back the reported_user_id column
            if (!Schema::hasColumn('reports', 'reported_user_id')) {
                $table->unsignedBigInteger('reported_user_id')->nullable();
                // Optionally, re-add the index and foreign key constraint here
            }
        });
    }
}
