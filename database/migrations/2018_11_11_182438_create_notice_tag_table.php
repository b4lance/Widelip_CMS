<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_tag', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('notice_id')->unsigned();
            $table->integer('tag_id')->unsigned();


            $table->timestamps();

            //Relations
            
             $table->foreign('notice_id')->references('id')->on('notices')
             ->onDelete('cascade')
             ->onUpdate('cascade');
 
             $table->foreign('tag_id')->references('id')->on('tags')
             ->onDelete('cascade')
             ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notice_tag');
    }
}
