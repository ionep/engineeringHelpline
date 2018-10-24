<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldAndAccessToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts',function($table){
            //should use enum maybe.. not sure so used hard inputs
            /*
            also which will be better? add a column named faculty or using user id to verify faculty
            during retrieval of posts?
            i think add a column because it limits db retrieval to once during viewing posts while
            adding one retrivel during creating posts, instead of two queries during viewing 
            */
            $table->string('faculty');
            // access control
            // values: 'field', 'all', 'none'
            $table->string('access');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function($table)
        {
            $table->dropColumn('faculty'); 
            $table->dropColumn('access'); 
        });
    }
}
