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
        Schema::create('extensions', static function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\User::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->string('type')
                ->default('extension');

            $table->string('repository')
                ->unique();
            $table->string('slug')
                ->unique();
            $table->string('title');
            $table->text('description')
                ->nullable();
            $table->text('content')
                ->nullable();

            $table->boolean('use_readme')
                ->default(true);
            $table->boolean('published')
                ->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extensions');
    }
};
