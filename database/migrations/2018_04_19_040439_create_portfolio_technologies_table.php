<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioTechnologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_technologies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('portfolio_id');
            $table->integer('technology_id');

            $table->timestamps();
             $table->foreign('portfolio_id')->references('id')->on('portfolio')->onDelete('cascade');
            $table->foreign('technology_id')->references('id')->on('technology')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portfolio_technologies');
    }
}
