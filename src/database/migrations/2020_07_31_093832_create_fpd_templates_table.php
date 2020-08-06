<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFpdTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fpd_templates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned()->nullable()->default(0);
            $table->string('name')->nullable()->default('Product Template');
            $table->string('thumbnail')->nullable();
            $table->text('options')->nullable();
            $table->text('elements')->nullable();
            $table->integer('stage_width')->unsigned()->default(0);
            $table->integer('stage_height')->unsigned()->default(0);
            $table->integer('deleted')->default(0);
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
        Schema::dropIfExists('fpd_templates');
    }
}
