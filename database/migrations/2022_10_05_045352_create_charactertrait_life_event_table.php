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
        Schema::create('character_trait_life_event', function (Blueprint $table) {
            $table->id();
            $table->foreignId('character_trait_id')->constrained('character_traits');
            $table->foreignId('life_event_id')->constrained('life_events');
            $table->smallInteger('traitLevel')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('character_trait_life_event');
    }
};
