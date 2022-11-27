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
            $table->foreign('actor_id')->references('id')->on('actors')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('tvshow_id')->references('id')->on('tvshows')->onUpdate('cascade')->onDelete('restrict');
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
        //
    }
};
