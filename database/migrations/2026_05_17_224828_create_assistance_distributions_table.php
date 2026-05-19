<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('assistance_distributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('assistance_applications')->cascadeOnDelete();
            $table->decimal('amount', 15, 2);
            $table->date('distribution_date');
            $table->enum('method', ['cash', 'transfer', 'goods', 'other'])->default('cash');
            $table->text('notes')->nullable();
            $table->string('proof_image')->nullable();
            $table->foreignId('distributed_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('assistance_distributions');
    }
};
