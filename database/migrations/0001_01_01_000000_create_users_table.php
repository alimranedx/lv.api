<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED AUTO_INCREMENT

            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->timestamp('email_verified_at')->nullable();

            $table->string('password');

            $table->enum('role', ['0', '1', '9999'])
                ->default('0')
                ->comment('0 - user, 1 - admin, 9999 - super admin');

            $table->tinyInteger('is_admin_approved')
                ->default(0)
                ->comment('0 - not approved, 1 - approved');

            $table->rememberToken(); // VARCHAR(100) NULL

            $table->timestamps(); // created_at & updated_at (nullable)

            $table->string('otp')->nullable();
            $table->timestamp('otp_expires_at')->nullable();

            // Indexes
            $table->unique('email');
            $table->unique('phone');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
