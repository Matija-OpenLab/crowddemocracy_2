<?php namespace SebastianHalas\Communities\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSebastianhalasCommunitiesMain6 extends Migration
{
    public function up()
    {
        Schema::table('sebastianhalas_communities_main', function($table)
        {
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('sebastianhalas_communities_main', function($table)
        {
            $table->dropColumn('updated_at');
        });
    }
}
