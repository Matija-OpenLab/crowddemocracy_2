<?php namespace SebastianHalas\Posts\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSebastianhalasPosts6 extends Migration
{
    public function up()
    {
        Schema::table('sebastianhalas_posts_', function($table)
        {
            $table->integer('total_votes')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('sebastianhalas_posts_', function($table)
        {
            $table->integer('total_votes')->nullable(false)->change();
        });
    }
}
