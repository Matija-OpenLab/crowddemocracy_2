<?php namespace SebastianHalas\Posts\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSebastianhalasPosts9 extends Migration
{
    public function up()
    {
        Schema::table('sebastianhalas_posts_', function($table)
        {
            $table->date('finished_at')->nullable(false)->unsigned(false)->default('null')->change();
        });
    }
    
    public function down()
    {
        Schema::table('sebastianhalas_posts_', function($table)
        {
            $table->dateTime('finished_at')->nullable(false)->unsigned(false)->default('null')->change();
        });
    }
}
