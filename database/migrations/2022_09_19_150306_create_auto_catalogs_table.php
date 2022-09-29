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
            $table->string('mark')->index('mark')->nullable();
            $table->string('model')->index('model')->nullable();
            $table->string('generation')->index('generation')->nullable();
            $table->year('year')->index('year')->nullable();
            $table->integer('run')->index('run')->nullable();
            $table->string('color')->index('color')->nullable();
            $table->string('body_type')->index('body_type')->nullable();
            $table->string('engine_type')->index('engine_type')->nullable();
            $table->string('transmission')->index('transmission')->nullable();
            $table->string('gear_type')->index('gear_type')->nullable();
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
