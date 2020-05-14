<?php namespace SebastianHalas\Likes\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSebastianhalasLikesLikeables3 extends Migration
{
    public function up()
    {
        Schema::table('sebastianhalas_likes_likeables', function($table)
        {
            $table->integer('like_value')->default(0)->change();
        });
    }
    
    public function down()
    {
        Schema::table('sebastianhalas_likes_likeables', function($table)
        {
            $table->integer('like_value')->default(null)->change();
        });
    }
}
