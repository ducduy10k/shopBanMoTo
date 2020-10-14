<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblFeature extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_feature', function (Blueprint $table) {
            $table->increments('feature_id');
            $table->integer('STT');
            $table->text('feature_name');
            $table->text('feature_desc');
            $table->string('feature_price');
            $table->integer('feature_status');
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
        Schema::dropIfExists('tbl_feature');
    }
}
