<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bayi_balita', function (Blueprint $table) {

            $table->id();

            $table->string('nik', 20)->unique();

            $table->string('nama');

            $table->enum('jenis_kelamin', [
                'L',
                'P'
            ]);

            $table->string('tempat_lahir');

            $table->date('tanggal_lahir');

            $table->decimal('berat_lahir', 5, 2)->nullable();

            $table->decimal('tinggi_lahir', 5, 2)->nullable();

            $table->string('foto')->nullable();

            $table->string('nama_ayah');

            $table->string('nama_ibu');

            $table->string('no_hp_ortu')->nullable();

            $table->text('alamat');

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bayi_balita');
    }
};
