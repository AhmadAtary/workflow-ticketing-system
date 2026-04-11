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
        Schema::create('system_settings', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('company_name');
            $table->string('logo_url')->nullable();
            $table->string('primary_color', 16)->nullable();
            $table->string('default_language', 8)->default('en');
            $table->string('email_host')->nullable();
            $table->unsignedInteger('email_port')->nullable();
            $table->string('email_from')->nullable();
            $table->string('email_user')->nullable();
            $table->text('email_password')->nullable();
            $table->boolean('email_enabled')->default(false);
            $table->boolean('allow_registration')->default(false);
            $table->boolean('require_email_verification')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
};
