<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saved_places', function (Blueprint $table) {
            $table->id();

            $table->foreignId('destination_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('name');
            $table->text('description')->nullable();

            $table->string('address')->nullable();
            $table->string('website')->nullable();

            $table->string('category')->default('other');

            $table->boolean('is_visited')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saved_places');
    }
};
