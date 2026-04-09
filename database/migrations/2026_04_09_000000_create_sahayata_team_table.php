<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sahayata_team', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('designation', 120)->index();
            $table->string('photo')->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('email', 120)->nullable();
            $table->string('district', 120)->index();
            $table->text('bio')->nullable();
            $table->date('joining_date')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active')->index();
            $table->boolean('contact_visible')->default(false);
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['designation', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sahayata_team');
    }
};
