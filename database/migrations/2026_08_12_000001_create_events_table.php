<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->date('date');
            $table->time('time');
            $table->string('place')->nullable();
            $table->string('responsible')->nullable();
            $table->string('group')->nullable();
            $table->string('status')->default('Planejado');
            $table->string('priority')->default('Média');
            $table->boolean('needs_publicity')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
