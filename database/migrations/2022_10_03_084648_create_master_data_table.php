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
        Schema::create('master_datas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('entity_id');
            $table->string('entity_type');
            $table->string('key');
            $table->json('value')->nullable();
            $table->timestamps();
            $table->index(['entity_id', 'entity_type', 'key']);
            $table->unique(['entity_id', 'entity_type', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_data');
    }
};
