<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        $ratingTableName = (new \willvincent\Rateable\Rating)->getTable();
        $ratingDescriptionTableName = (new \willvincent\Rateable\RatingDescription)->getTable();


        Schema::create($ratingDescriptionTableName, function (Blueprint $table) use($ratingTableName) {
            $table->integer('rating_id', false, true)->unsigned();
            $table->string('lang', 2);
            $table->text('review');
            $table->foreign('rating_id')->references('id')->on($ratingTableName);
        });

        Schema::table($ratingTableName, function (Blueprint $table)
        {
            $table->unique(['rating_id', 'lang'], 'rating_id_lang');
        });

        Schema::table($ratingTableName, function (Blueprint $table)
        {
            $table->index(['rating_id'], 'rating_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $ratingDescriptionTableName = (new \willvincent\Rateable\RatingDescription)->getTable();

        Schema::drop($ratingDescriptionTableName);
    }
}
