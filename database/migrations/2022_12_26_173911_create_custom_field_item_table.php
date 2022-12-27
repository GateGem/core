<?php

use GateGem\Core\Builder\Form\FieldBuilder;
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
        Schema::create('custom_field_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('group_id');
            $table->string('key');
            $table->string('title'); 
            $table->string('format')->nullable();
            $table->string('list_key')->nullable();
            $table->json('list_data')->nullable();
            $table->integer('type')->default(FieldBuilder::Text);
            $table->string('default')->nullable();
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
        Schema::dropIfExists('custom_field_items');
    }
};
