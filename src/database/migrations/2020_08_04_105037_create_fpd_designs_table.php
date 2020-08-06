<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFpdDesignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fpd_designs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned()->nullable()->default(0);
            $table->string('title')->nullable();
            $table->string('filename')->nullable();
            $table->string('original_filename')->nullable();
            $table->double('size', 10, 2)->nullable()->default(0.0);
            $table->string('mime')->nullable();
            $table->string('extension')->nullable();
            $table->text('parameters')->nullable();
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
        Schema::dropIfExists('fpd_designs');
    }
}
