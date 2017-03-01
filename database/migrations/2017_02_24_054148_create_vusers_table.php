<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vusers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('vcat_id')->index();
            $table->unsignedSmallInteger('province_id');
            $table->string('name');
            $table->string('post');
            $table->string('mobile',11)->unique();
            $table->string('code',30);
            $table->string('company');
            $table->boolean('has_attend')->default(0);
            $table->unsignedSmallInteger('salesman_id');
            $table->unsignedSmallInteger('regional_manager_id');
            $table->boolean('is_need_sms')->default(1)->index();
            $table->boolean('has_sms')->default(0)->index();
            $table->boolean('is_enter')->default(0)->index();
            $table->string('hotel')->nullable();
            $table->string('gravatar')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('vusers');
    }
}
