<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhasePowerDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('phase_power_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('phase_id')->constrained();
            $table->foreignId('power_id')->constrained();
            $table->unsignedInteger('home_center_count');
            $table->unsignedInteger('supply_center_count');
            $table->unsignedInteger('unit_count');
            $table->boolean('orders_needed');
            $table->boolean('ready_for_adjudication');
            $table->text('orders');
            $table->text('applied_orders');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phase_power_data');
    }
}
