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
        Schema::create('character_trait_child', function (Blueprint $table) {
            $table->id();
            $table->foreignId('character_trait_id')->constrained('character_traits');
            $table->foreignId('child_id')->constrained('children');
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
        Schema::dropIfExists('character_trait_child');
    }
};
