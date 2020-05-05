<?php namespace SebastianHalas\Likes\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSebastianhalasLikesLikeables2 extends Migration
{
    public function up()
    {
        Schema::table('sebastianhalas_likes_likeables', function($table)
        {
            $table->renameColumn('likeable_id', 'posts_id');
        });
    }
    
    public function down()
    {
        Schema::table('sebastianhalas_likes_likeables', function($table)
        {
            $table->renameColumn('posts_id', 'likeable_id');
        });
    }
}
