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
        Schema::create('kpis', function(Blueprint $table) {
            $table->string('id', 26)->primary();
            $table->string('line');
            $table->string('style');
            $table->integer('year');
            $table->integer('month');
            $table->integer('week');
            $table->integer('day');
            $table->date('start_date');
            $table->date('end_date');
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpis');
    }
};
