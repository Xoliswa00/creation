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
        Schema::create('company_invitations', function (Blueprint $table) {
            $table->id();
                $table->foreignId('company_id')->constrained()->cascadeOnDelete();
    $table->string('email');

                 $table->enum('role', [
        'owner',
        'admin',
        'finance',
        'viewer'
    ])->default('viewer');    $table->string('token')->unique();
    $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_invitations');
    }
};
