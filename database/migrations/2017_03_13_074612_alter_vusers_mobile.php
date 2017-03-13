<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterVusersMobile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vusers', function (Blueprint $table) {
            $table->dropUnique('vusers_mobile_unique');
            $table->string('mobile', 50)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vusers', function (Blueprint $table) {
            $table->string('mobile', 11)->unique()->change();
        });
    }
}
