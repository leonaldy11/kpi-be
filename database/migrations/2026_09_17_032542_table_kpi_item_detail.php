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
        Schema::create('item_details',function(Blueprint $table){
            $table->string('id',26)->primary();
            $table->string('inspected_id', 26);
            $table->foreign('inspected_id',26)->references('id')->on('ttl_inspecteds')->cascadeOnDelete();
            $table->string('code');
            $table->string('name');
            $table->integer('qty');
            $table->float('persen',8);
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
        Schema::dropIfExists('item_details');
    }
};
