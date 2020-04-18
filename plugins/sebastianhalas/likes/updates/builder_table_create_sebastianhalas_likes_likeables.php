<?php namespace SebastianHalas\Likes\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSebastianhalasLikesLikeables extends Migration
{
    public function up()
    {
        Schema::create('sebastianhalas_likes_likeables', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('likeable_id')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('sebastianhalas_likes_likeables');
    }
}
