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
        Schema::create('custom_field_groups', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('title');
            $table->string('module_key')->nullable();
            $table->string('model_key')->nullable();
            $table->string('page_key')->nullable();
            $table->string('data_key')->nullable();
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
        Schema::dropIfExists('custom_field_groups');
    }
};
