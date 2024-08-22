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
        Schema::create('driving_licenses', function (Blueprint $table) {
            $table->id();
            $table->string('surname');
            $table->string('othername');
            $table->date('date_of_birth');
            $table->date('date_of_issue');
            $table->date('date_of_expire');
            $table->string('nic');
            $table->string('license_no');
            $table->string('address');
            $table->string('sex');
            $table->string('height');
            $table->string('weight');
            $table->string('eyes');
            $table->string('classes');
            $table->string('photourl');
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
        Schema::dropIfExists('driving_licenses');
    }
};
