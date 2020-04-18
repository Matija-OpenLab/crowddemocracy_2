<?php namespace SebastianHalas\Likes\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSebastianhalasLikesLikeables extends Migration
{
    public function up()
    {
        Schema::table('sebastianhalas_likes_likeables', function($table)
        {
            $table->integer('like_value')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('sebastianhalas_likes_likeables', function($table)
        {
            $table->dropColumn('like_value');
        });
    }
}
