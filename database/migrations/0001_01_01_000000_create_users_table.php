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
        Schema::create('users', static function (Blueprint $table) {
            $table->id();

            $table->string('github_id')
                ->unique();
            $table->text('github_token');
            $table->text('github_refresh_token')
                ->nullable();

            $table->string('name');
            $table->string('email')
                ->unique();
            $table->string('avatar');

            $table->integer('points')
                ->default(0);

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
