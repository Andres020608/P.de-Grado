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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('primary_contact');
            $table->string('contact_email')->unique();
            $table->string('material_specialty');
            $table->string('location');
            $table->boolean('rjc_certified')->default(false);
            $table->boolean('carbon_neutral')->default(false);
            $table->boolean('heritage_craft')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
