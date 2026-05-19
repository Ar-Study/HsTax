<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'jamaah'])->default('jamaah')->after('email');
            $table->string('phone', 20)->nullable()->after('password');
            $table->text('address')->nullable()->after('phone');
            $table->string('pekerjaan', 100)->nullable()->after('address');
            $table->enum('kondisi_ekonomi', ['rendah', 'menengah', 'tinggi'])->nullable()->after('pekerjaan');
            $table->integer('tanggungan')->default(0)->after('kondisi_ekonomi');
            $table->text('notes')->nullable()->after('tanggungan');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone', 'address', 'pekerjaan', 'kondisi_ekonomi', 'tanggungan', 'notes']);
        });
    }
};
