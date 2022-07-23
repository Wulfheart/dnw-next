<?php

use App\Models\PhasePowerData;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remember_user_to_order_table', function (Blueprint $table) {
            $table->id();
            $table->foreignId('phase_power_data_id');
            $table->timestamps();


            // $table->foreign('phase_power_data_id')->references('id')->on('phase_power_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('remember_user_to_orders');
    }
};
