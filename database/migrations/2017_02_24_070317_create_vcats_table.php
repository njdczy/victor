<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVcatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vcats', function (Blueprint $table) {
            $table->SmallIncrements('id');
            $table->unsignedSmallInteger('parent_id')->default(0)->index();
            $table->string('title')->nullable();
            $table->SmallInteger('order')->default(0);
            $table->boolean('is_sign')->default(0)->index();
            $table->boolean('is_father')->default(0)->index();
            $table->index(['created_at']);
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
        Schema::dropIfExists('vcats');
    }
}
