<?php namespace SebastianHalas\Communities\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSebastianhalasCommunitiesRoles extends Migration
{
    public function up()
    {
        Schema::create('sebastianhalas_communities_roles', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('user_id');
            $table->integer('community_id');
            $table->integer('role');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('sebastianhalas_communities_roles');
    }
}
