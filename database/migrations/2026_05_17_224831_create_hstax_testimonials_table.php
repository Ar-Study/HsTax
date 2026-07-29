<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hstax_testimonials', function (Blueprint $table) {
            $table->id();
            $table->integer('stars')->default(5);
            $table->text('text');
            $table->string('initial', 10)->nullable();
            $table->string('name');
            $table->string('role')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_approved')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hstax_testimonials');
    }
};
