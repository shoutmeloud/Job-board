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
        Schema::table('users', function (Blueprint $table) {
            $table->string('firstname', 255)->after('id');            
            $table->string('lastname', 255)->after('firstname');
            $table->string('phone', 255)->after('email');
            // $table->string('lastname', 255)->after('firstname');
            $table->integer('usertype')->after('phone')->nullable(false);

        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
           
        });
    }
};
