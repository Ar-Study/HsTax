<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('assistance_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jamaah_id')->constrained('users')->cascadeOnDelete();
            $table->string('assistance_type', 100);
            $table->decimal('amount_requested', 15, 2);
            $table->decimal('amount_approved', 15, 2)->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'postponed'])->default('pending');
            $table->text('admin_note')->nullable();
            $table->date('application_date');
            $table->date('verification_date')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('assistance_applications');
    }
};
