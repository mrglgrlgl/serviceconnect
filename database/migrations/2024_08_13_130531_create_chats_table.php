<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('channel_id');
            $table->unsignedBigInteger('sender_id');
            $table->string('sender_name');  // Store the sender's name
            $table->text('message_text');
            $table->timestamps();

            // Indexes for fast querying
            $table->index(['channel_id', 'created_at']);

            // Foreign key constraints
            $table->foreign('channel_id')->references('id')->on('channel')->onDelete('cascade');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('chats');
    }
}
