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
        Schema::create('tier_rows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tier_list_template_id')->constrained()->onDelete('cascade');
            $table->string('label');
            $table->integer('order');
            $table->string('color')->default('#ef4444');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tier_rows');
    }
};
