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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('type', ['SA', 'CA', 'E', 'C'])->default('C')->comment('Super Admin,Employee,Company Admin,Employee');
            $table->unsignedBigInteger('company_id')->nullable(); // Allow null for non-company users
            $table->text('address')->nullable(); 
            $table->string('city')->nullable(); 
            $table->date('date_of_birth')->nullable();
            $table->rememberToken();
            $table->timestamps();

            // Foreign key constraint referencing the companies table
            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade'); 
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};