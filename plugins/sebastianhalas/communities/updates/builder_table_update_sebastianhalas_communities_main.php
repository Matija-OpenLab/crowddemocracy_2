<?php namespace SebastianHalas\Communities\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSebastianhalasCommunitiesMain extends Migration
{
    public function up()
    {
        Schema::table('sebastianhalas_communities_main', function($table)
        {
            $table->renameColumn('creation_date', 'created_at');
        });
    }
    
    public function down()
    {
        Schema::table('sebastianhalas_communities_main', function($table)
        {
            $table->renameColumn('created_at', 'creation_date');
        });
    }
}
