<?php

use App\Models\Semestre;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('diciplines_classes', function (Blueprint $table) {
            $table->foreignIdFor(Semestre::class)->constrained()->cascadeOnDelete();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('disciplines_classes', function (Blueprint $table) {
            //
        });
    }
};
