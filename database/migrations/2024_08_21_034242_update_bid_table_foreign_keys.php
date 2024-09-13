<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBidTableForeignKeys extends Migration
{
    public function up()
    {
        Schema::table('bid', function (Blueprint $table) {
            // Drop the existing foreign key constraint if it exists
            $table->dropForeign(['bidder_id']);
            $table->dropIndex(['bidder_id']);
            
            // Add a new foreign key constraint referencing 'agency_users'
            $table->foreign('bidder_id')->references('id')->on('agency_users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('bid', function (Blueprint $table) {
            // Reverse the changes made in the 'up' method

            // Drop the new foreign key constraint
            $table->dropForeign(['bidder_id']);
            
            // Add the previous foreign key constraint (assuming it referenced `users`)
            $table->foreign('bidder_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
}

