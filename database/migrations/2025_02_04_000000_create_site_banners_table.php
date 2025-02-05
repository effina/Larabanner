<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('larabanners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('contents');
            $table->json('display_days')->nullable();
            $table->timestamp('display_start_date');
            $table->timestamp('display_stop_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('larabanners');
    }
};

