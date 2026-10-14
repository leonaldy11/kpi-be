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
        Schema::create('ttl_inspecteds',function(Blueprint $table){
            $table->string('id',26)->primary();
            $table->string('kpi_id', 26);
            $table->foreign('kpi_id',26)->references('id')->on('kpis')->cascadeOnDelete();
            $table->integer('inspedted');
            $table->integer('dispacted_1');
            $table->float('persen_dispacted_1',8);
            $table->integer('dispacted_2');
            $table->float('persen_dispacted_2',8);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ttl_inspecteds');
    }
};
