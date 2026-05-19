<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('assistance_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jamaah_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('application_id')->constrained('assistance_applications')->cascadeOnDelete();
            $table->string('assistance_type', 100);
            $table->decimal('amount', 15, 2);
            $table->date('date');
            $table->enum('status', ['pending', 'approved', 'rejected', 'postponed', 'distributed']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('assistance_histories');
    }
};
