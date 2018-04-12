<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('data_id');
            $table->unsignedInteger('make_id');
            $table->unsignedInteger('model_id');
            $table->unsignedInteger('price')->nullable();
            $table->unsignedInteger('kilometrage')->nullable();
            $table->string('accident')->nullable();
            $table->unsignedSmallInteger('Year')->nullable();
            $table->string('body_type')->nullable();
            $table->unsignedTinyInteger('doors')->nullable();
            $table->string('color')->nullable();
            $table->string('fuel_type')->nullable();
            $table->unsignedTinyInteger('engine_size')->nullable();
            $table->unsignedSmallInteger('power')->nullable();
            $table->string('transmission')->nullable();
            $table->string('drive_type')->nullable();
            $table->string('wheel_type')->nullable();
            $table->string('power_steering')->nullable();
            $table->string('climate_control')->nullable();
            $table->string('interior')->nullable();
            $table->text('interior_options')->nullable();
            $table->text('heating')->nullable();
            $table->string('power_windows')->nullable();
            $table->text('electric_drive')->nullable();
            $table->text('memory_settings')->nullable();
            $table->text('driving_assistance')->nullable();
            $table->text('antitheft_system')->nullable();
            $table->text('airbags')->nullable();
            $table->text('active_safety')->nullable();
            $table->text('multimedia')->nullable();
            $table->unsignedTinyInteger('wheels')->nullable();
            $table->unsignedTinyInteger('owners')->nullable();
            $table->text('images')->nullable();
            $table->timestamps();

            $table->foreign('make_id')
                ->references('id')
                ->on('makes')
                ->onDelete('CASCADE');

            $table->foreign('model_id')
                ->references('id')
                ->on('models')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
