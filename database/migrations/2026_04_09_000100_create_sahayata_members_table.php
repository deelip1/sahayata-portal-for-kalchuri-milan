<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sahayata_members', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('mobile', 20)->index();
            $table->string('email', 120)->nullable();
            $table->string('district', 120)->index();
            $table->string('occupation', 120)->nullable();
            $table->enum('status', ['active', 'inactive', 'blocked'])->default('active')->index();
            $table->date('joined_at')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['status', 'district']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sahayata_members');
    }
};
