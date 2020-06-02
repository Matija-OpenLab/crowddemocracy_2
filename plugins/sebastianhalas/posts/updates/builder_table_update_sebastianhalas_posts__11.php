<?php namespace SebastianHalas\Posts\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSebastianhalasPosts11 extends Migration
{
    public function up()
    {
        Schema::table('sebastianhalas_posts_', function($table)
        {
            $table->date('finished_at')->nullable();
            $table->boolean('is_finished')->default(false)->change();
        });
    }
    
    public function down()
    {
        Schema::table('sebastianhalas_posts_', function($table)
        {
            $table->dropColumn('finished_at');
            $table->boolean('is_finished')->default(0)->change();
        });
    }
}
