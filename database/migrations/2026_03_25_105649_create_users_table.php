<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('religion_id')->nullable()->constrained()->onDelete('restrict');
            $table->foreignId('role_id')->constrained()->onDelete('restrict');
            $table->string('name');                    // Full name
            $table->string('email')->unique();
            $table->string('student_number')->unique(); // Used for Login
            $table->string('phone')->nullable();
            $table->string('region')->nullable();
            $table->string('course')->nullable();
            $table->integer('year_of_study')->nullable();
            $table->string('password');
            $table->boolean('is_active')->default(true);
            $table->boolean('password_changed')->default(false); // Force change password
            $table->rememberToken();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};