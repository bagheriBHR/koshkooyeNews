<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('roo_titr')->nullable();
            $table->text('body');
            $table->text('summery')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('view_count')->default(0);
            $table->boolean('is_carousel')->default(0);
            $table->boolean('is_important')->default(0);
            $table->smallInteger('type')->default(0);
            $table->smallInteger('publish_status')->default(0);
            $table->string('reporter')->nullable();
            $table->string('photographer')->nullable();
            $table->string('media_source')->nullable();

            $table->string('video_url')->nullable();
            $table->string('image_url')->nullable();

            $table->dateTime('publish_date')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
