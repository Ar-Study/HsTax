<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jamaah_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('type', ['donasi', 'infak', 'sedekah', 'sponsor']);
            $table->decimal('amount', 15, 2);
            $table->date('donation_date');
            $table->enum('payment_method', ['cash', 'transfer', 'other'])->default('cash');
            $table->text('description')->nullable();
            $table->string('proof_image')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('donations');
    }
};
