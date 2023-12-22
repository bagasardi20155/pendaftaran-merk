<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_status', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_brand')->unsigned();
            $table->enum('status', ['waiting', 'revision', 'revised', 'rejected', 'accepted']);
            $table->timestamps();

            $table->foreign('id_brand')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brand_status');
    }
};
