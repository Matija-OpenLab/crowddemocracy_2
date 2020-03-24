<?php namespace SebastianHalas\Posts\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSebastianhalasPosts extends Migration
{
    public function up()
    {
        Schema::create('sebastianhalas_posts_', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->text('content');
            $table->integer('vote_yes')->default(0);
            $table->integer('vote_no')->default(0);
            $table->dateTime('create_date');
            $table->primary(['id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('sebastianhalas_posts_');
    }
}
