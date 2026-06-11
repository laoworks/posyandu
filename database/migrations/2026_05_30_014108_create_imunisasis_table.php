<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('imunisasi', function (Blueprint $table) {

            $table->id();

            $table->foreignId('bayi_balita_id')
                ->constrained('bayi_balita')
                ->cascadeOnDelete();

            $table->date('tanggal');

            $table->string('jenis_imunisasi');

            $table->string('dosis')->nullable();

            $table->text('keterangan')->nullable();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imunisasi');
    }
};
