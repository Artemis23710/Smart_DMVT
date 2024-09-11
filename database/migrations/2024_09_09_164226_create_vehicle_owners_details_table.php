<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicle_owners_details', function (Blueprint $table) {
            $table->id();
            $table->integer('vehicle_ID'); 
            $table->string('name');
            $table->string('nic');
            $table->string('address');
            $table->date('date_of_register');
            $table->date('date_of_transfer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_owners_details');
    }
};
