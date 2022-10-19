<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_life_event', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('child_id')->constrained('children');
            $table->foreignId('life_event_id')->constrained('life_events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('child_life_event');
    }
};
