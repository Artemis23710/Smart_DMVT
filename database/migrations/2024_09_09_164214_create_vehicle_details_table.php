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
        Schema::create('vehicle_details', function (Blueprint $table) {
            $table->id();
            $table->string('classofvehicle');
            $table->string('registration_No');
            $table->string('Chassisno');
            $table->date('register_date');
            $table->string('condition');
            $table->string('engineno');
            $table->string('capacity');
            $table->string('fueltype');
            $table->string('make');
            $table->string('origincountry');
            $table->string('manufactureyear');
            $table->string('color');
            $table->string('ownername');
            $table->string('ownernic');
            $table->string('owneraddress');
            $table->integer('status'); 
            $table->integer('created_by')->nullable();  
            $table->integer('updated_by')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_details');
    }
};
