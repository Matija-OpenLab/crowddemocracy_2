<?php namespace SebastianHalas\Posts\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSebastianhalasPosts3 extends Migration
{
    public function up()
    {
        Schema::table('sebastianhalas_posts_', function($table)
        {
            $table->integer('total_votes')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('sebastianhalas_posts_', function($table)
        {
            $table->dropColumn('total_votes');
        });
    }
}
