<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->comment('Posted By User');
            $table->string('projecttitle', 255)->nullable(true);
            $table->text('projectdescription')->nullable(true);
            $table->string('documentfile', 255)->nullable(true);
            $table->text('selectedemployee')->nullable(true);
            $table->enum('status', ['0', '1','2'])->nullable()->comment('0: Pending, 1: Open, 2: Closed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
