<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string("website_name");
            $table->string("logo_url");
            $table->string("banner")->nullable();
            $table->boolean("is_active")->default(0);
            $table->boolean('is_test')->default(1);
            $table->string('footer');
            $table->text("about_us");
            $table->text("contact_us");
            $table->string("whatsapp")->nullable();
            $table->string("telegram")->nullable();
            $table->string("facebook")->nullable();
            $table->string("twitter")->nullable();
            $table->string("instagram")->nullable();
            $table->string('meta_keyword');
            $table->string('meta_description');
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
        Schema::dropIfExists('settings');
    }
}
