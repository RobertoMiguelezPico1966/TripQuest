<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packing_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('trip_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('category')->default('other');

            $table->unsignedInteger('quantity')->default(1);

            $table->boolean('is_packed')->default(false);

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packing_items');
    }
};