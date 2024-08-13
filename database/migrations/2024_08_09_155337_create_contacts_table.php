<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id(); // id: Integer, Primary Key
            $table->string('name'); // name: String, Required
            $table->string('email')->unique(); // email: String, Required, Unique
            $table->string('phone')->nullable(); // phone: String, Optional
            $table->string('address')->nullable(); // address: String, Optional
            $table->timestamps(); // created_at: Timestamp, updated_at: Timestamp
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
