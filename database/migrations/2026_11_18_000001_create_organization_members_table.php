<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organization_members', function (Blueprint $table) {
            $table->id();
            $table->string('jabatan');         // e.g. DIREKTUR
            $table->string('nama');            // e.g. Yudhiani Mirdhatillah
            $table->integer('urutan')->default(0); // display order
            $table->unsignedBigInteger('parent_id')->nullable(); // null = top-level
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('organization_members')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organization_members');
    }
};
