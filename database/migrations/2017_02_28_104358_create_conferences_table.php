<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conferences', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            $table->string('name');
            $table->text('description');
            $table->text('should_vcat_ids')->nullable();//这个会议应到家数
            $table->text('sign_vcat_ids')->nullable();//这个会议实到家数
            $table->smallInteger('sign_count')->default(0);//这个会议实到人数
            $table->SmallInteger('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conferences');
    }
}
