<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('archived_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event_title');
            $table->text('event_description');
            $table->string('location')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();
            $table->date('event_date')->nullable();
            $table->time('event_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archived_events');
    }
};
