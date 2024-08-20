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
        Schema::table('agencies', function (Blueprint $table) {
            $table->string('logo_path')->nullable()->after('address');
        });
    }
    
    public function down()
    {
        Schema::table('agencies', function (Blueprint $table) {
            $table->dropColumn('logo_path');
        });
    }
    
};
