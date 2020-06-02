<?php namespace SebastianHalas\Communities\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSebastianhalasCommunitiesMain9 extends Migration
{
    public function up()
    {
        Schema::table('sebastianhalas_communities_main', function($table)
        {
            $table->integer('icon_id')->nullable()->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('sebastianhalas_communities_main', function($table)
        {
            $table->dropColumn('icon_id');
        });
    }
}
