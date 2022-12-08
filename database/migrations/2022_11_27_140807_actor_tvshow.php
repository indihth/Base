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
        Schema::create('actor_tvshow', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('actor_id')->unsigned()->nullable();
            $table->bigInteger('tvshow_id')->unsigned()->nullable();

            // add foreign keys - ids from users and roles table
            $table->foreign('actor_id')->references('id')->on('actors')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('tvshow_id')->references('id')->on('tvshows')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('actor_tvshow');
    }
};
