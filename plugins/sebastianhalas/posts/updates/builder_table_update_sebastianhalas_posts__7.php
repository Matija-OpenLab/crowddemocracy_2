<?php namespace SebastianHalas\Posts\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSebastianhalasPosts7 extends Migration
{
    public function up()
    {
        Schema::table('sebastianhalas_posts_', function($table)
        {
            $table->integer('vote_yes')->nullable()->change();
            $table->integer('vote_no')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('sebastianhalas_posts_', function($table)
        {
            $table->integer('vote_yes')->nullable(false)->change();
            $table->integer('vote_no')->nullable(false)->change();
        });
    }
}
