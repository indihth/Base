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
            $table->bigInteger('actor_id')->unsigned();
            $table->bigInteger('tvshow_id')->unsigned();

            // add foreign keys - ids from users and roles table
            // onDelete('cascade') will delete the the row when one of the FKs gets deleted
            // allows TV Show to be deleted without needing to delete an Actor as well
            $table->foreign('actor_id')->references('id')->on('actors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tvshow_id')->references('id')->on('tvshows')->onUpdate('cascade')->onDelete('cascade');
            
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
