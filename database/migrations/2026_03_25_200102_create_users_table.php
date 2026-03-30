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
            
            $table->foreignId('level_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('department_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('programme_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('region_id')->nullable()->constrained()->onDelete('set null');
            
            $table->string('name');
            $table->string('email')->unique();
            $table->string('student_number')->unique();
            $table->string('phone')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->tinyInteger('year_of_study')->nullable()->unsigned();
            
            $table->string('password');
            $table->boolean('is_active')->default(true);
            $table->boolean('password_changed')->default(false);
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