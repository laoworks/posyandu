<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penimbangan', function (Blueprint $table) {

            $table->id();

            $table->foreignId('bayi_balita_id')
                ->constrained('bayi_balita')
                ->cascadeOnDelete();

            $table->date('tanggal');

            $table->decimal('berat_badan', 5, 2);

            $table->decimal('tinggi_badan', 5, 2);

            $table->decimal('lingkar_kepala', 5, 2)->nullable();

            $table->decimal('lingkar_lengan', 5, 2)->nullable();

            $table->text('catatan')->nullable();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penimbangan');
    }
};
