<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutputitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outputitems', function (Blueprint $table) {
            $table->id();
            $table->boolean('vip_issueType');
            $table->boolean('vip_key');
            $table->boolean('vip_summary');
            $table->boolean('vip_assigner');
            $table->boolean('vip_status');
            $table->boolean('vip_priority');
            $table->boolean('vip_created');
            $table->boolean('vip_startDate');
            $table->boolean('vip_estimatedHours');
            $table->boolean('vip_updated');
            $table->boolean('vip_createdUser');
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
        Schema::dropIfExists('outputitems');
    }
}
