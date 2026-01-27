<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();

            $table->string('name', 120);
            $table->string('email', 160);
            $table->text('message');

            // metadata útil
            $table->string('source', 50)->nullable(); // home/contacto/etc
            $table->string('utm_source', 100)->nullable();
            $table->string('utm_medium', 100)->nullable();
            $table->string('utm_campaign', 100)->nullable();

            $table->ipAddress('ip')->nullable();
            $table->text('user_agent')->nullable();

            // estado
            $table->string('status', 20)->default('new'); // new, contacted, qualified, closed, spam
            $table->timestamp('contacted_at')->nullable();

            $table->timestamps();

            $table->index(['email']);
            $table->index(['status']);
            $table->index(['created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
