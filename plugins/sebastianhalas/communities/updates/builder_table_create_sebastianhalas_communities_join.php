<?php namespace SebastianHalas\Communities\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSebastianhalasCommunitiesJoin extends Migration
{
    public function up()
    {
        Schema::create('sebastianhalas_communities_join', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('communities_id');
            $table->integer('user_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('sebastianhalas_communities_join');
    }
}
