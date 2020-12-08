<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommercialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commercials', function (Blueprint $table) {
            $table->id();
            $table->string('title');

            $table->string('url')->nullable();
            $table->unsignedBigInteger('banner');
            $table->foreign('banner')->references('id')->on('photos')->onDelete('cascade');
            $table->smallInteger('status')->default(0);
            $table->smallInteger('type');
            $table->integer('click_count')->nullable();
            $table->integer('total_click')->nullable();
            $table->date('start_date')->nullable();
            $table->date('finish_date')->nullable();
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
        Schema::dropIfExists('commercials');
    }
}
