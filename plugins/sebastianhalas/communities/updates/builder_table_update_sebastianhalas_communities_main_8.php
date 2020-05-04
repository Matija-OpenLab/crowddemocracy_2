<?php namespace SebastianHalas\Communities\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSebastianhalasCommunitiesMain8 extends Migration
{
    public function up()
    {
        Schema::table('sebastianhalas_communities_main', function($table)
        {
            $table->date('created_at')->nullable()->unsigned(false)->default(null)->change();
            $table->date('updated_at')->nullable()->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('sebastianhalas_communities_main', function($table)
        {
            $table->timestamp('created_at')->nullable()->unsigned(false)->default(null)->change();
            $table->timestamp('updated_at')->nullable()->unsigned(false)->default(null)->change();
        });
    }
}
