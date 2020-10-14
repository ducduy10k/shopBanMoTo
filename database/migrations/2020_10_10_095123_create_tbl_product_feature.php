<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProductFeature extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product_feature', function (Blueprint $table) {
            $table->increments('product_feature_id');
            $table->integer('feature_id');
            $table->integer('product_id');
            $table->text('product_feature_name');
            $table->text('product_feature_value');
            $table->string('product_image');
            $table->string('product_price');
            $table->integer('status');
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
        Schema::dropIfExists('tbl_product_feature');
    }
}
