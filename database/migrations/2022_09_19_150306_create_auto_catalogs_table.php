<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutoCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_catalogs', function (Blueprint $table) {
            $table->id();
            $table->string('mark')->nullable();
            $table->string('model')->nullable();
            $table->string('generation')->nullable();
            $table->year('year')->nullable();
            $table->integer('run')->nullable();
            $table->string('color')->nullable();
            $table->string('body_type')->nullable();
            $table->string('engine_type')->nullable();
            $table->string('transmission')->nullable();
            $table->string('gear_type')->nullable();
            $table->integer('generation_id')->nullable();
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
        Schema::dropIfExists('auto_catalogs');
    }
}
