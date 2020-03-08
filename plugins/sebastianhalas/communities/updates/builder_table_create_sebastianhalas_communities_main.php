<?php namespace SebastianHalas\Communities\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSebastianhalasCommunitiesMain extends Migration
{
    public function up()
    {
        Schema::create('sebastianhalas_communities_main', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 50);
            $table->text('description');
            $table->dateTime('creation_date');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('sebastianhalas_communities_main');
    }
}
