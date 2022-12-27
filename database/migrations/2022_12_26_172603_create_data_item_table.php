<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('list_id');
            $table->string('list_key')->nullable();
            $table->string('title')->nullable();
            $table->string('link')->nullable();
            $table->string('image')->nullable();
            $table->mediumText('content_short')->nullable();
            $table->longText('content')->nullable();
            $table->boolean('status')->nullable();
            $table->integer('sort')->default(0);
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
        Schema::dropIfExists('data_items');
    }
};
