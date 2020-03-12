<?php namespace SebastianHalas\Communities\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSebastianhalasCommunitiesMain7 extends Migration
{
    public function up()
    {
        Schema::table('sebastianhalas_communities_main', function($table)
        {
            $table->text('owner')->nullable();
            $table->integer('user_count')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('sebastianhalas_communities_main', function($table)
        {
            $table->dropColumn('owner');
            $table->dropColumn('user_count');
        });
    }
}
