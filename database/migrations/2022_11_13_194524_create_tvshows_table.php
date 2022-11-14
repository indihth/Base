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
        Schema::create('tvshows', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('user_id')->constrained();

            // I had to rollback the tvshows migration and create
            // the networks table first in order to create the foreignID constraint 
            $table->foreignId('network_id')->constrained();
            $table->timestamps();
            $table->string('title');
            $table->longText('description');
            $table->date('release_date');
            $table->string('director');
            $table->string('rating');
            $table->string('difficulty');
            $table->string('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tvshows');
    }
};
